// Load google charts
google.charts.load('current', { 'packages': ['corechart'] });
google.charts.setOnLoadCallback(drawChart);


// Draw the chart and set the chart values
function drawChart() {
    if (document.getElementById('Ciągnik') == null) {
        var ciagnik = "0";

    } else {
        var ciagnik = document.getElementById("Ciągnik").value;

    }

    if (document.getElementById('Kosiarka') == null) {
        var kosiarka = "0";
    } else {
        var kosiarka = document.getElementById("Kosiarka").value;
    }

    if (document.getElementById('Chwastownik') == null) {
        var chwastownik = "0";
    } else {
        var chwastownik = document.getElementById("Chwastownik").value;
    }

    if (document.getElementById('Technologia nawożenia') == null) {
        var technologia = "0";
    } else {
        var technologia = document.getElementById("Technologia nawożenia").value;
    }

    if (document.getElementById('Kultywatora') == null) {
        var kultywator = "0";
    } else {
        var kultywator = document.getElementById("Kultywator").value;
    }

    if (document.getElementById('Siwnik') == null) {
        var siwnik = "0";
    } else {
        var siwnik = document.getElementById("Siwnik").value;
    }

    if (document.getElementById('Kultywatora') == null) {
        var kultywator = "0";
    } else {
        var kultywator = document.getElementById("Kultywator").value;
    }

    if (document.getElementById('Rozrzutnik obornika') == null) {
        var rozrzutnik = "0";
    } else {
        var rozrzutnik = document.getElementById("Rozrzutnik obornika").value;
    }

    if (document.getElementById('Sadzarka') == null) {
        var sadzarka = "0";
    } else {
        var sadzarka = document.getElementById("Sadzarka").value;
    }

    if (document.getElementById('Brona') == null) {
        var brona = "0";
    } else {
        var brona = document.getElementById("Brona").value;
    }

    if (document.getElementById('Pług') == null) {
        var plug = "0";
    } else {
        var plug = document.getElementById("Pług").value;
    }

    if (document.getElementById('Transport zwierząt') == null) {
        var transport = "0";
    } else {
        var transport = document.getElementById("Transport zwierząt").value;
    }

    if (document.getElementById('Przyczepa') == null) {
        var przyczepa = "0";
    } else {
        var przyczepa = document.getElementById("Przyczepa").value;
    }

    if (document.getElementById('Kombajn do ziemniaków') == null) {
        var kombajndoziemniakow = "0";
    } else {
        var kombajndoziemniakow = document.getElementById("Kombajn do ziemniaków").value;
    }

    if (document.getElementById('Ładowarka') == null) {
        var ladowarka = "0";
    } else {
        var ladowarka = document.getElementById("Ładowarka").value;
    }

    if (document.getElementById('Kombajn Trzcinowy') == null) {
        var kombajntrzcinowy = "0";
    } else {
        var kombajntrzcinowy = document.getElementById("Kombajn Trzcinowy").value;
    }

    if (document.getElementById('Kombajn ogólny') == null) {
        var kombajnogolny = "0";
    } else {
        var kombajnogolny = document.getElementById("Kombajn ogólny").value;
    }

    if (document.getElementById('Technologia Bel') == null) {
        var technologiabel = "0";
    } else {
        var technologiabel = document.getElementById("Technologia Bel").value;
    }

    if (document.getElementById('Ochrona roślin') == null) {
        var ochronaroslin = "0";
    } else {
        var ochronaroslin = document.getElementById("Ochrona roślin").value;
    }


    var data = google.visualization.arrayToDataTable([

        ['Task', 'Hours per Day'],
        ['Ciągnik', parseInt(ciagnik)],
        ['Kosiarka', parseInt(kosiarka)],
        ['Chwastownik', parseInt(chwastownik)],
        ['Technologia nawożenia', parseInt(technologia)],
        ['Kultywator', parseInt(kultywator)],
        ['Siwnik', parseInt(siwnik)],
        ['Rozrzutnik obornika', parseInt(rozrzutnik)],
        ['Sadzarka', parseInt(sadzarka)],
        ['Brona', parseInt(brona)],
        ['Pług', parseInt(plug)],
        ['Transport zwierząt', parseInt(transport)],
        ['Przyczepa', parseInt(przyczepa)],
        ['Kombajn do ziemniaków', parseInt(kombajndoziemniakow)],
        ['Ładowarka', parseInt(ladowarka)],
        ['Kombajn Trzcinowy', parseInt(kombajntrzcinowy)],
        ['Kombajn ogólny', parseInt(kombajnogolny)],
        ['Technologia Bel', parseInt(technologiabel)],
        ['Ochrona roślin', parseInt(ochronaroslin)]
    ]);

    // Optional; add a title and set the width and height of the chart
    var options = { 'title': 'Wykres Maszyn', 'width': 550, 'height': 400 };

    // Display the chart inside the <div> element with id="piechart"
    var chart = new google.visualization.PieChart(document.getElementById('machinechart'));
    chart.draw(data, options);
}