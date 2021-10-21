<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Http\Controllers\MailController;
use Cassandra\Exception\TruncateException;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\countOf;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:8', 'max:8'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:16', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function manualRegister(Request $request)
    {
        $input = $request->all();

        $validator = $this -> validator($input);
        if ($validator -> fails()){
            return redirect('/register') -> withErrors($validator) -> withInput();
        }

        $this -> create($input);

        $userID = DB::table('users') -> select('id') -> where('email', $input['email']) -> get();
        $userID = $userID[0] -> id;

        $token = $this->createToken();
        DB::table('user_info') -> insert([
            'user_id' => $userID,
            'admin_check' => 0,
            'email_verified' => 0,
            'email_verify_token' => $token,
        ]);

        $email_verify_sender = app('App\Http\Controllers\MailController')->register_token($input['name'], $input['email'], $token);

        $digit = $this->createAccountID();
        DB::table('account') -> insert([
            'user_id' => $userID,
            'point' => 0,
            'account_id' => $digit,
        ]);

        return view('auth.verify');
    }

    public function createAccountID()
    {
        $accounts = DB::table('account')
            ->select('account_id')
            ->get();
        $accounts -> transform(function($i) {
            return (array)$i;
        });
        $array = $accounts -> toArray();
        $digit_number = rand(100000, 999999);
        while (!$this->checkDigitNumber($digit_number, $array))
        {
            $digit_number = rand(100000, 999999);
        }
        return $digit_number;
    }

    public function checkDigitNumber($digit_number, $db_array)
    {
        $check_val = 0;
        for ($i = 0; $i < count($db_array); $i ++)
        {
            if ($digit_number == $db_array[$i]['account_id'])
            {
                $check_val = 1;
                break;
            }
        }
        if ($check_val == 0)
        {
            return True;
        }
        else
        {
            return False;
        }
    }

    public function createToken($length = 20)
    {
        $tokens = DB::table('user_info')
            ->select('email_verify_token')
            ->get();
        $tokens -> transform(function($i) {
            return (array)$i;
        });
        $array = $tokens -> toArray();
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        while (!$this->checkToken($randomString, $array))
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
        }
        return $randomString;
    }

    public function checkToken($token_str, $db_array)
    {
        $check_val = 0;
        for ($i = 0; $i < count($db_array); $i ++)
        {
            if ($token_str == $db_array[$i]['email_verify_token'])
            {
                $check_val = 1;
                break;
            }
        }
        if ($check_val == 0)
        {
            return True;
        }
        else
        {
            return False;
        }
    }

    public function verifyEmail($token)
    {
        $tokens = DB::table('user_info')
            ->select('email_verify_token', 'user_id')
            ->get();
        $tokens -> transform(function($i) {
            return (array)$i;
        });
        $array = $tokens -> toArray();
        $user_id = 0;
        for ($i = 0; $i < count($array); $i ++)
        {
            if ($token == $array[$i]['email_verify_token'])
            {
                $user_id = $array[$i]['user_id'];
                break;
            }
        }
        DB::table('user_info')
            ->where('user_id', $user_id)
            ->update([
                'email_verified' => 1,
            ]);
        return redirect('verify');
    }

    public function verifyEmailSuccess()
    {
        return view('auth.register_success');
    }
}
