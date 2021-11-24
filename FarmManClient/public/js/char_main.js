// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

 
// Draw the chart and set the chart values
function drawChart() {
    var animals = document.getElementById("animals").value;
    var machines = document.getElementById("machines").value;
    var storehouse = document.getElementById("storehouse").value;
    var plots = document.getElementById("plots").value;
    var data = google.visualization.arrayToDataTable([

  ['Task', 'Hours per Day'],
  ['Zwierzęta', parseInt(animals)],
  ['Maszyny', parseInt(machines)],
  ['Magazyn', parseInt(storehouse)],
  ['Działki', parseInt(plots)]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Wykres gospodarstwa', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}