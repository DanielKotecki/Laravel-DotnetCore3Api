// Load google charts
google.charts.load('current', { 'packages': ['corechart'] });
google.charts.setOnLoadCallback(drawChart);


// Draw the chart and set the chart values
function drawChart() {
    if (document.getElementById('Siedliskowa') == null) {
        var siedliskowa = "0";
    } else {
        var siedliskowa = document.getElementById("Siedliskowa").value;
    }

    if (document.getElementById('Inwestycyjna') == null) {
        var inwestycyjna = "0";
    } else {
        var inwestycyjna = document.getElementById("Inwestycyjna").value;
    }

    if (document.getElementById('Rolna') == null) {
        var rolna = "0";
    } else {
        var rolna = document.getElementById("Rolna").value;
    }

    if (document.getElementById('Budowlana') == null) {
        var budowlana = "0";
    } else {
        var budowlana = document.getElementById("Budowlana").value;
    }

    if (document.getElementById('Rekreacyjna') == null) {
        var rekreacyjna = "0";
    } else {
        var rekreacyjna = document.getElementById("Rekreacyjna").value;
    }

    if (document.getElementById('Leśna') == null) {
        var lesna = "0";
    } else {
        var lesna = document.getElementById("Leśna").value;
    }

    var data = google.visualization.arrayToDataTable([

        ['Task', 'Hours per Day'],
        ['Siedliskowa', parseInt(siedliskowa)],
        ['Inwestycyjna', parseInt(inwestycyjna)],
        ['Rolna', parseInt(rolna)],
        ['Budowlana', parseInt(budowlana)],
        ['Rekreacyjna', parseInt(rekreacyjna)],
        ['Leśna', parseInt(lesna)]
    ]);

    // Optional; add a title and set the width and height of the chart
    var options = { 'title': 'Wykres Działek', 'width': 550, 'height': 400 };

    // Display the chart inside the <div> element with id="piechart"
    var chart = new google.visualization.PieChart(document.getElementById('plotchart'));
    chart.draw(data, options);
}