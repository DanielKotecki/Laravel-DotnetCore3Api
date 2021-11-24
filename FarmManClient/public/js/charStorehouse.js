 // Load google charts
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

     
    // Draw the chart and set the chart values
    function drawChart() {
        if (document.getElementById('Zboża') ==null){
          var zboża = "0";
        }else {
          var zboża = document.getElementById("Zboża").value;
        }

        if (document.getElementById('Nawóz nieorganiczny') ==null){
          var nawoznie = "0";
        }else {
          var nawoznie = document.getElementById("Nawóz nieorganiczny").value;
        }

        if (document.getElementById('Nawóz organiczny') ==null){
          var nawozorg = "0";
        }else {
          var nawozorg = document.getElementById("Nawóz organiczny").value;
        }

        if (document.getElementById('Oprysk') ==null){
          var oprysk = "0";
        }else {
          var oprysk = document.getElementById("Oprysk").value;
        }

        if (document.getElementById('Paliwo') ==null){
          var paliwo = "0";
        }else {
          var paliwo = document.getElementById("Paliwo").value;
        }

        if (document.getElementById('Narzędzia') ==null){
          var narzedzia = "0";
        }else {
          var narzedzia = document.getElementById("Narzędzia").value;
        }

        if (document.getElementById('Balot') ==null){
          var balot = "0";
        }else {
          var balot = document.getElementById("Balot").value;
        }

        if (document.getElementById('Pasza objętościowa') ==null){
          var pasza = "0";
        }else {
          var pasza = document.getElementById("Pasza objętościowa").value;
        }

        if (document.getElementById('Owoce') ==null){
          var owoce = "0";
        }else {
          var owoce = document.getElementById("Owoce").value;
        }

        if (document.getElementById('Warzywo') ==null){
          var warzywo = "0";
        }else {
          var warzywo = document.getElementById("Warzywo").value;
        }

        if (document.getElementById('Rośliny strączkowe') ==null){
          var roslinystr = "0";
        }else {
          var roslinystr = document.getElementById("Rośliny strączkowe").value;
        }

        if (document.getElementById('Rośliny okopowe') ==null){
          var roslinyoko = "0";
        }else {
          var roslinyoko = document.getElementById("Rośliny okopowe").value;
        }

        if (document.getElementById('Rośliny pastewne') ==null){
          var roslinypas = "0";
        }else {
          var roslinypas = document.getElementById("Rośliny pastewne").value;
        }

        if (document.getElementById('Inne') ==null){
          var inne = "0";
        }else {
          var inne = document.getElementById("Inne").value;
        }

        var data = google.visualization.arrayToDataTable([

      ['Task', 'Hours per Day'],
      ['Zboża', parseInt(zboża)],
      ['Nawóz nieorganiczny', parseInt(nawoznie)],
      ['Nawóz organiczny', parseInt(nawozorg)],
      ['Oprysk', parseInt(oprysk)],
      ['Paliwo', parseInt(paliwo)],
      ['Narzędzia', parseInt(narzedzia)],
      ['Balot', parseInt(balot)],
      ['Pasza objętościowa', parseInt(pasza)],
      ['Owoce', parseInt(owoce)],
      ['Warzywo', parseInt(warzywo)],
      ['Rośliny strączkowe', parseInt(roslinystr)],
      ['Rośliny okopowe', parseInt(roslinyoko)],
      ['Rośliny pastewne', parseInt(roslinypas)],
      ['Inne', parseInt(inne)],
     
    ]);
    
      // Optional; add a title and set the width and height of the chart
      var options = {'title':'Wykres Magazyn', 'width':550, 'height':400};
    
      // Display the chart inside the <div> element with id="piechart"
      var chart = new google.visualization.PieChart(document.getElementById('storehousepie'));
      chart.draw(data, options);
    }