/*----canvas-chart1----*/

var chart = new CanvasJS.Chart("canvas-chart1",
    {
        animationEnabled: true,
        title: {
            text: ""
        },
        axisX: {
            interval: 10,
			lineColor: " #d7e7ff",
			labelFontColor: "#5e7cac",
        },
		axisY: {
			gridThickness: 1,
			gridColor: " #d7e7ff",
			lineColor: " #d7e7ff",
			labelFontColor: "#5e7cac",
        },
		toolTip: {
			borderColor: "rgba(255,12,32,.3)"   //change color 
		  },
        data: [
        {
            type: "splineArea",
            color: "rgba(255,12,32,.3)",
            bordercolor: "rgba(255,12,32,.3)",
            type: "splineArea",
            dataPoints: [
                { x: new Date(1992, 0), y: 250 },
                { x: new Date(1993, 0), y: 480 },
                { x: new Date(1994, 0), y: 480},
                { x: new Date(1995, 0), y: 700 },
                { x: new Date(1996, 0), y: 550 },
                { x: new Date(1997, 0), y: 520 },
                { x: new Date(1998, 0), y: 480 },
                { x: new Date(1999, 0), y: 580 },
                { x: new Date(2000, 0), y: 800 },
                { x: new Date(2001, 0), y: 600},
                { x: new Date(2002, 0), y: 560 },
                { x: new Date(2003, 0), y: 480 },
                { x: new Date(2004, 0), y: 500 },
                { x: new Date(2005, 0), y: 163 },
                { x: new Date(2006, 0), y: 282 }
            ]
        },
        ]
    });
chart.render();

/*----canvas-chart2----*/
var chart = new CanvasJS.Chart("canvas-chart2",
    {
        animationEnabled: true,
        title: {
            text: "",
        },
		
        data: [
        {
            type: "pie",
            showInLegend: true,
			labelFontColor: "#5e7cac",
            dataPoints: [
                { y: 960, legendText: "sales", indexLabel: "sales" },
                { y: 200, legendText: "profit", indexLabel: "profit" },
                { y: 80, legendText: "growth", indexLabel: "growth" },
                { y: 400, legendText: "Employes", indexLabel: "Employes" }
            ]
        },
        ]
    });
chart.render();

/*----canvas-chart3----*/
var chart = new CanvasJS.Chart("canvas-chart3",
    {
        animationEnabled: true,
        title: {
            text: ""
        },
        axisX: {
            valueFormatString: "MMM",
            interval: 1,
            intervalType: "month",
			lineColor: " #d7e7ff",
			labelFontColor: "#5e7cac",
        },
        axisY: {
            includeZero: false,
			gridThickness: 1,
			gridColor: " #d7e7ff",
			lineColor: " #d7e7ff",
			labelFontColor: "#5e7cac",
        },
        data: [
        {
          type: "line",
		  color: "rgba(255,12,32,.3)",
          dataPoints: [
              { x: new Date(2012, 00, 1), y: 550 },
              { x: new Date(2012, 01, 1), y: 414 },
              { x: new Date(2012, 02, 1), y: 420},
              { x: new Date(2012, 03, 1), y: 460 },
              { x: new Date(2012, 04, 1), y: 350 },
              { x: new Date(2012, 05, 1), y: 500 },
              { x: new Date(2012, 06, 1), y: 480 },
              { x: new Date(2012, 07, 1), y: 480 },
              { x: new Date(2012, 08, 1), y: 310 },
              { x: new Date(2012, 09, 1), y: 500 },
              { x: new Date(2012, 10, 1), y: 480 },
              { x: new Date(2012, 11, 1), y: 410 }
            ]
        }
        ]
    });
chart.render();


/*----canvas-chart4----*/
var chart = new CanvasJS.Chart("canvas-chart4",
    {
        animationEnabled: true,
        title: {
            text: ""
        },
        axisX: {
            interval: 10,
			lineColor: " #d7e7ff",
			labelFontColor: "#5e7cac",
        },
		axisY: {
			gridThickness: 1,
			gridColor: " #d7e7ff",
			lineColor: " #d7e7ff",
			labelFontColor: "#5e7cac",
        },
        data: [
        {
            type: "column",
            color: "rgba(255,12,32,.3)",
            showInLegend: true,
            legendText: "",
            dataPoints: [
                { x: 10, y: 297571, label: "Jan" },
                { x: 20, y: 267017, label: "Feb" },
                { x: 30, y: 175200, label: "Mar" },
                { x: 40, y: 154580, label: "Apr" },
                { x: 50, y: 116000, label: "May" },
                { x: 60, y: 97800, label: "Jun" },
                { x: 70, y: 20682, label: "Jul" },
                { x: 80, y: 20350, label: "Aug" }
            ]
        },
        ]
    });
chart.render();


/*----canvas-chart5----*/
var dataPoints = [];
var y = 1000;
var limit = 50000;

for ( var i = 0; i < limit; i++ ) {
	y += Math.round( 10 + Math.random() * (-10 -10));	
	dataPoints.push({ y: y });
}

var chart = new CanvasJS.Chart("canvas-chart5", {
	animationEnabled: true,
	zoomEnabled: true,
	title:{
		text: ""
	}, 
	subtitles:[{
		text: ""
	}],
	data: [{
		type: "line",
		color: "rgba(255,12,32,.3)",
		dataPoints: dataPoints
	}],
	axisX: {
		lineColor: " #d7e7ff",
		labelFontColor: "#5e7cac",
	},
	axisY:{
		includeZero: false,
		gridThickness: 1,
		gridColor: " #d7e7ff",
		lineColor: " #d7e7ff",
		labelFontColor: "#5e7cac",
	}
});

chart.render();


/*----canvas-chart6----*/
var chart = new CanvasJS.Chart("canvas-chart6", {
	animationEnabled: true,
	title:{
		text: ""
	},
	toolTip: {
		shared: true
	},
	axisX: {
		suffix : " s",
		lineColor: " #d7e7ff",
		labelFontColor: "#5e7cac",
	},
	axisY: {
		titleFontColor: "#4F81BC",
		suffix : " m/s",
		lineColor: "#736cc7",
		tickColor: "#736cc7",
		gridThickness: 1,
		gridColor: " #d7e7ff",
		labelFontColor: "#5e7cac",
	},
	axisY2: {
		titleFontColor: "#C0504E",
		suffix : " m",
		lineColor: "#ff5c75",
		tickColor: "#ff5c75",
		labelFontColor: "#5e7cac",
	},
	data: [{
		type: "spline",
		name: "speed",
		xValueFormatString: "#### sec",
		yValueFormatString: "#,##0.00 m/s",
		dataPoints: [
			{ x: 0 , y: 0 },
			{ x: 11 , y: 8.2 },
			{ x: 47 , y: 41.7 },
			{ x: 56 , y: 16.7 },
			{ x: 120 , y: 31.3 },
			{ x: 131 , y: 18.2 },
			{ x: 171 , y: 31.3 },
			{ x: 189 , y: 61.1 },
			{ x: 221 , y: 40.6 },
			{ x: 232 , y: 18.2 },
			{ x: 249 , y: 35.3 },
			{ x: 253 , y: 12.5 },
			{ x: 264 , y: 16.4 },
			{ x: 280 , y: 37.5 },
			{ x: 303 , y: 24.3 },
			{ x: 346 , y: 23.3 },
			{ x: 376 , y: 11.3 },
			{ x: 388 , y: 8.3 },
			{ x: 430 , y: 1.9 },
			{ x: 451 , y: 4.8 }
		],
		color:"#ff5c75"
	},
	{
		type: "spline",  
		axisYType: "secondary",
		name: "distance covered",
		yValueFormatString: "#,##0.# m",
		dataPoints: [
			{ x: 0 , y: 0 },
			{ x: 11 , y: 90 },
			{ x: 47 , y: 1590 },
			{ x: 56 , y: 1740 },
			{ x: 120 , y: 3740 },
			{ x: 131 , y: 3940 },
			{ x: 171 , y: 5190 },
			{ x: 189 , y: 6290 },
			{ x: 221 , y: 7590 },
			{ x: 232 , y: 7790 },
			{ x: 249 , y: 8390 },
			{ x: 253 , y: 8440 },
			{ x: 264 , y: 8620 },
			{ x: 280 , y: 9220 },
			{ x: 303 , y: 9780 },
			{ x: 346 , y: 10780 },
			{ x: 376 , y: 11120 },
			{ x: 388 , y: 11220 },
			{ x: 430 , y: 11300 },
			{ x: 451 , y: 11400 }
		],
		color:"#736cc7"
	}]
});
chart.render();
