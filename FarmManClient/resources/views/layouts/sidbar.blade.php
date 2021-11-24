
       <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/main" class="brand-link">
      <img src="{{asset('./FarmManLogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">FarmMan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        {{-- <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> --}}
        <div class="info">
          <a href="/person" class="d-block">{{Illuminate\Support\Facades\Cookie::get('email')}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
   
          <li class="nav-header">Menu</li>
         
          <li class="nav-item">
            <a href="#" class="nav-link">
              {{-- <ion-icon name="cube-outline" ></ion-icon> --}}
              <i class="fas fa-tractor"></i>
              <p>
                Maszyny
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/machines" class="nav-link">
                 <i class="far fa-circle nav-icon"></i> 
                  <p>Pokaż maszyny</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{asset('/addmachine')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dodaj maszynę</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Alerty
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/alert/insurences" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Ubezpiecznie maszyny</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/alert/mot" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Przegląd techniczny</p>
                    </a>
                  </li>
                  
                </ul>
              </li>
             
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              {{-- <i class="nav-icon fas fa-circle"></i> --}}
              <i class="fas fa-warehouse"></i>
              <p>
                Magazyn
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{asset('storehouse')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pokaż zasoby</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{'itemadd'}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dodaj do magazynu</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-square"></i>
              <p>
                Działki
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{asset('plots')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pokaż działki</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{'plotadd'}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dodaj działkę</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Alerty
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{asset('alert/plot')}}" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Prace<strong>/</strong>Dzierżawa</p>
                    </a>
                  </li>
                  
                  
                </ul>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-horse"></i>
             
              <p>
                Zwierzęta
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{asset('animals')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pokaż zwierzęta</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{'animal'}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dodaj zwierzę</p>
                </a>
              </li>

            </ul>
          </li>
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>Level 1</p>
            </a>
          </li> --}}

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>


  
