google.load("visualization", "1", {packages:["corechart"]});
      function drawChart(title, y_title, x_title, data, max_y_value) {
       
        var options = {
          // curveType: "function",
          // vAxis: {maxValue: 5},
          animation:{
            duration: 5000,
            easing: 'linear',
          },
          title: title,
          selectionMode: 'multiple',
          tooltip: { trigger: 'selection' },
          aggregationTarget: 'series',
          is3D: true,
          hAxis: {
            title: x_title,  
            titleTextStyle: {color: '#333'},
            showTextEvery: data.getNumberOfRows()-1
          },
          vAxis: {
            title: y_title,
            minValue: 0,
            maxValue: max_y_value
          },
          tooltip: {isHtml: true},
          legend: 'none',
        };
        
        var chart = new google.visualization.LineChart(document.getElementById('chart_div')); 
        
        chart.draw(data, options);
      }