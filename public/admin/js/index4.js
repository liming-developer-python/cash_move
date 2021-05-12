( function ( $ ) {
    "use strict";
	
    //line chart
    var ctx = document.getElementById( "lineChart" );
    ctx.height = 100;
    var myChart = new Chart( ctx, {
        type: 'line',
        data: {
            labels: [ "January", "February", "March", "April", "May", "June", "July" ],
            datasets: [
                {
                    label: "My First dataset",
                    borderColor: "rgba(255, 92, 117,.9)",
                    borderWidth: "1",
                    backgroundColor: "rgb(255, 92, 117, .17)",
                    data: [ 22, 44, 67, 43, 76, 45, 12 ]
                            },
                {
                    label: "My Second dataset",
                    borderColor: "rgba(115, 108, 199, 0.9)",
                    borderWidth: "1",
                    backgroundColor: "rgba(115, 108, 199, 0.5)",
                    pointHighlightStroke: "rgba(26,179,148,1)",
                    data: [ 16, 32, 18, 26, 42, 33, 44 ]
                            }
                        ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false,
				
            },
			tooltips: {
				  
				},
            hover: {
                mode: 'nearest',
                intersect: true
            }

        }
    } );
	 

} )( jQuery );