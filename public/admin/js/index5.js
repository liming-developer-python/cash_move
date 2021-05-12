$(function(e){
  'use strict'
  /*-----echart2-----*/
   
  var chartdata = [
    {
      name: 'sales',
      type: 'bar',
      data: [10, 15, 9, 18, 10, 15]
    },
    {
      name: 'profit',
      type: 'line',
	  smooth:true,
      data: [8, 5, 25, 10, 10]
    },
    {
      name: 'growth',
      type: 'bar',
      data: [10, 14, 10, 15, 9, 25]
    }
  ];

  var chart = document.getElementById('echart1');
  var barChart = echarts.init(chart);

  var option = {
    grid: {
      top: '6',
      right: '0',
      bottom: '17',
      left: '25',
    },
    xAxis: {
      data: [ '2014', '2015', '2016', '2017', '2018'],
      axisLine: {
        lineStyle: {
          color: '#d7e7ff'
        }
      },
      axisLabel: {
        fontSize: 10,
        color: '#5e7cac'
      }
    },
	tooltip: {
		show: true,
		showContent: true,
		alwaysShowContent: true,
		triggerOn: 'mousemove',
		trigger: 'axis',
		axisPointer:
		{
			label: {
				show: false,
			}
		}

	},
    yAxis: {
      splitLine: {
        lineStyle: {
          color: '#d7e7ff'
        }
      },
      axisLine: {
        lineStyle: {
          color: '#d7e7ff'
        }
      },
      axisLabel: {
        fontSize: 10,
        color: '#5e7cac'
      }
    },
    series: chartdata,
    color:[ '#ff5c75','#2bcbba', '#736cc7',]
  };

  barChart.setOption(option);

  });