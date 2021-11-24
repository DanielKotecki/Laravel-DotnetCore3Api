
      <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
     @php
       use App\Http\Controllers\AlertsHeaderController;
       $alerty=AlertsHeaderController::HeaderAlert();
       //Testowe pomaga co się znajduje w zmiennej alert 
      //var_dump($alerty);
    @endphp 
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{asset('/main')}}" class="nav-link">Strona główna</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
      <a href="{{asset('/o-nas')}}" class="nav-link">O nas</a> 
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"><strong class="font-weight-bold ">{{$alerty['alert_count']}}</strong></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <span class="dropdown-item dropdown-header bg-danger">{{$alerty['alert_count']}} Alertów</span>
          @if (!empty($alerty['insurence_count']))
          <div class="dropdown-divider"></div>
          <a href="{{asset('/alert/insurences')}}" class="dropdown-item bg-warning">
            <i class="bi bi-exclamation-triangle"></i> {{$alerty['insurence_count']}} Alerty ubezpieczeń
          </a>    
          @endif
          @if (!empty($alerty['mot_count']))
          <div class="dropdown-divider"></div>
          <a href="{{asset('/alert/mot')}}" class="dropdown-item bg-warning">
            <i class="bi bi-exclamation-triangle"></i> {{$alerty['mot_count']}} Alerty przeglądu technicznego
          </a>    
          @endif
          @if (!empty($alerty['work_count']))
          <div class="dropdown-divider"></div>
          <a href="{{asset('alert/plot')}}" class="dropdown-item bg-warning">
            <i class="bi bi-exclamation-triangle"></i> {{$alerty['work_count']}} Alerty kończących się terminów prac
          </a>   
          @endif
          @if (!empty($alerty['rent_count']))
          <div class="dropdown-divider"></div>
          <a href="{{asset('alert/plot')}}" class="dropdown-item bg-warning">
            <i class="bi bi-exclamation-triangle"></i> {{$alerty['rent_count']}} Alerty o końcu dzierżawy
          </a>    
          @endif
          
          
        </div>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/logout" class="nav-link">Wyloguj</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->




