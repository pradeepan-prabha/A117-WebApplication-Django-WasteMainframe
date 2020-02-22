// Bar Chart
fetch("http://localhost/zero-waste-city-demo/dbconnect/barGraphData.php").then(function(response){
  return response.json();
}).then(function(obj){
    console.log(obj);
    var barChart = new CanvasJS.Chart("barChart", {
        animationEnabled: true,
        theme: "light2",
        title:{
          text: "Waste generated by Countries"
        },
        axisY: {
          title: "Waste produced (in percentage)"
        },
        data: [{
          type: "column",
          yValueFormatString: "#,##0.## tonnes",
          dataPoints: obj
        }]
    });
    
    barChart.render();
}).catch(function(error){
  console.error(`Oops error occured: ${error}`);
});


// Multi-Line chart 
fetch("http://localhost/zero-waste-city-demo/dbconnect/lineGraphData.php").then(function(response){
  return response.json();
}).then(function(obj){
    console.log(obj);
    var mulChart = new CanvasJS.Chart("lineChart", {
        animationEnabled: true,
        theme: "light2",
        title:{
          text: "Types of Waste Densities"
        },
        axisY: {
          title: "Waste Density (in percentage)"
        },
        data: [{
          type: "line",
          yValueFormatString: "# %",
          dataPoints: obj
        }]
    });
    
    mulChart.render();
}).catch(function(error){
  console.error(`Oops error occured: ${error}`);
});

// Pie chart 
fetch("http://localhost/zero-waste-city-demo/dbconnect/pieGraphData.php").then(function(response){
  return response.json();
}).then(function(obj){
    console.log(obj);
    var pieChart = new CanvasJS.Chart("pieChart", {
        animationEnabled: true,
        theme: "light2",
        title:{
          text: "Waste Characteristics Graph"
        },
        axisY: {
          title: "Waste produced (in percentage)"
        },
        data: [{
          type: "pie",
          yValueFormatString: "#,##0.## %",
          dataPoints: obj
        }]
    });
    
    pieChart.render();
}).catch(function(error){
  console.error(`Oops error occured: ${error}`);
});
