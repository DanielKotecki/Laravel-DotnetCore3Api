<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FarmMan</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">

<style>
</style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    {{-- navbar --}}
    @include('layouts.header')
    {{-- sidbar --}}
    @include('layouts.sidbar')
    {{-- content  WAZNE TUTAJ W SEKCJI SECTION BEDĄ WSZYSTKIE FORMULARZE TABELE I RÓZNE--}}
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    {{-- Wpisujemy tutaj nazwę sekcji w którą przechodzimy np. Magazyn,Maszyny... --}}
    

<section class="content">
    <div class="card-deck" style="padding-top: 20px;">
        <div class="card" style="width:500px">
            <div class="card-body">
              <h4 class="card-title">Zwierzęta</h4>
              <img class="card-img-top" src="img/cow.jpg" alt="Card image" height="230">
              <p class="card-text">liczba zwierząt: @if(empty($animals)==true) 0 
                                                    @else {{ $animals }} 
                                                    @endif</p>
              <a href="{{asset('/animals')}}" class="btn btn-primary  ">Sprawdź</a>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
                <h4 class="card-title">Maszyny</h4>
                <img class="card-img-top" src="img/tractor.jpg" height="230">
                <p class="card-text">liczba maszyn: @if(empty($machines)==true) 0 
                                                    @else {{ $machines }} 
                                                    @endif</p>
                <a href="{{asset('/machines')}}" class="btn btn-primary  ">Sprawdź</a>
              </div>
          </div>
          <div class="card">
            <div class="card-body">
                <h4 class="card-title">Działki</h4>
                <img class="card-img-top" src="img/land.png" alt="Card image" height="230" >
                <p class="card-text">liczba działek: @if(empty($plots)==true) 0 
                                                     @else {{ $plots }} 
                                                     @endif</p>
                <a href="{{asset('/plots')}}" class="btn btn-primary  ">Sprawdź</a>
              </div>
          </div>
          <div class="card">
            <div class="card-body">
                <h4 class="card-title">Magazyn</h4>
                <img class="card-img-top" src="img/storehouse.jpg" alt="Card image" height="230">
                <p class="card-text">ilość towarów w magazynie: @if(empty($storehouse)==true) 0 
                                                                @else {{ $storehouse }} 
                                                                @endif</p>
                <a href="{{asset('/storehouse')}}" class="btn btn-primary  ">Sprawdź</a>
              </div>
          </div>
      </div>
      

      <div class='d-flex flex-wrap justify-content-around'>
        {{-- {{$storehouse}}<br>{{$animals}}<br>{{$plots}}<br>{{$machines}} --}}
            @if ((empty($machines)==false)||(empty($animals)==false)||(empty($plots)==false)||(empty($storehouse)==false))
             <div id="piechart" style="padding: 20px;"></div>
            @endif
            @if (empty($group_machines)==false)
                <div id="machinechart" style="padding: 20px;"></div>
            @endif
            @if (empty($group_plots)==false)
                 <div id="plotchart" style="padding: 20px;"></div>
            @endif
            @if (empty($group_storehouse)==false)
                <div id="storehousepie" style="padding: 20px;"></div>
            @endif
      </div>

      @foreach ($group_machines as $data)
      <input type="hidden" id="{{$data['name_category']}}" name="msg" value="{{$data['count_group']}}">
      @endforeach

      @foreach ($group_plots as $data)
      <input type="hidden" id="{{$data['nameType']}}" name="msg" value="{{$data['countType']}}">
      @endforeach
      {{-- storehouse chart --}}
       @foreach ($group_storehouse as $data)
      <input type="hidden" id="{{$data['name_category']}}" name="msg" value="{{$data['count_group']}}">
      @endforeach 

    <input type="hidden" id="machines" name="msg" value="@if(empty($machines)==true) 0 
    @else {{ $machines }} 
    @endif">
    <input type="hidden" id="plots" name="msg" value="@if(empty($plots)==true) 0 
    @else {{ $plots }} 
    @endif">
    <input type="hidden" id="storehouse" name="msg" value="@if(empty($storehouse)==true) 0 
    @else {{ $storehouse }} 
    @endif">
    <input type="hidden" id="animals" name="msg" value="@if(empty($animals)==true) 0 
    @else {{ $animals }} 
    @endif">

</div>
     
    </section>
    <!-- /.content -->
  </div>
  
 @include('layouts.footer')
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 <script type="text/javascript" src="js/char_main.js"></script>
 <script type="text/javascript" src="js/charStorehouse.js"></script>
 <script type="text/javascript" src="js/charMachines.js"></script>
 <script type="text/javascript" src="js/charPlot.js"></script>

<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
</body>
</html>
