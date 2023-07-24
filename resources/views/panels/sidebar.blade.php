@php
$configData = Helper::applClasses();
@endphp
<div class="main-menu menu-fixed {{(($configData['theme'] === 'dark') || ($configData['theme'] === 'semi-dark')) ? 'menu-dark' : 'menu-light'}} menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item me-auto text-center" style="width: 80%">
        <a class="" href="{{url('/')}}">
          <span class="brand-logo">
            <img src="{{ asset('images/login/pm2.png')}}" style="max-width:150px">
          </span>
        </a>
      </li>
      <li class="nav-item nav-toggle">
        <a class="nav-link modern-nav-toggle pe-0" data-toggle="collapse">
          <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
          <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc" data-ticon="disc"></i>
        </a>
      </li>
    </ul>
  </div>
  <div class="shadow-bottom"></div>
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
		@if (Auth::user()->type==1)
			<li class="nav-item  {{Route::currentRouteName() === 'home' ? 'active' : ''}}">
				<a href="{{ route('home') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="home"></i>
					<span class="menu-title text-truncate">Inicio</span>
				</a>
			</li>
			<li class="nav-item  {{Route::currentRouteName() === 'fichas.index' ? 'active' : ''}}">
				<a href="{{ route('fichas.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="book"></i>
					<span class="menu-title text-truncate">Fichas de atención</span>
				</a>
			</li>
			<li class="nav-item  {{Route::currentRouteName() === 'solicitudes.index' ? 'active' : ''}}">
				<a href="{{ route('solicitudes.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="calendar"></i>
					<span class="menu-title text-truncate">Solicitudes</span>
				</a>
			</li>
			<li class="nav-item  {{Route::currentRouteName() === 'calendario.index' ? 'active' : ''}}">
				<a href="{{ route('calendario.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="calendar"></i>
					<span class="menu-title text-truncate">Disponibilidad</span>
				</a>
			</li>
			<li class="nav-item  {{Route::currentRouteName() === 'usuarios.index' ? 'active' : ''}}">
				<a href="{{ route('usuarios.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="users"></i>
					<span class="menu-title text-truncate">Usuarios</span>
				</a>
			</li>
			<li class="nav-item  {{Route::currentRouteName() === 'horarios.index' ? 'active' : ''}}">
				<a href="{{ route('horarios.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="users"></i>
					<span class="menu-title text-truncate">Horarios</span>
				</a>
			</li>
			<li class="nav-item  {{Route::currentRouteName() === 'sedes.index' ? 'active' : ''}}">
				<a href="{{ route('sedes.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="map"></i>
					<span class="menu-title text-truncate">Sedes</span>
				</a>
			</li>
			<li class="nav-item  {{Route::currentRouteName() === 'hojasderuta.index' ? 'active' : ''}}">
				<a href="{{ route('hojasderuta.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="calendar"></i>
					<span class="menu-title text-truncate">Hoja de ruta</span>
				</a>
			</li>
			<li class="nav-item  {{Route::currentRouteName() === 'asignacionDiaria.index' ? 'active' : ''}}">
				<a href="{{ route('asignacionDiaria.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="calendar"></i>
					<span class="menu-title text-truncate">Asignación diaria</span>
				</a>
			</li>
			<li class="nav-item  {{Route::currentRouteName() === 'asistencias.index' ? 'active' : ''}}">
				<a href="{{ route('asistencias.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="calendar"></i>
					<span class="menu-title text-truncate">Asistencias</span>
				</a>
			</li>
			<li class="nav-item  {{Route::currentRouteName() === 'mensajes.index' ? 'active' : ''}}">
				<a href="{{ route('mensajes.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="mail"></i>
					<span class="menu-title text-truncate">Mensajes</span>
				</a>
			</li>
			<li class="nav-item  {{Route::currentRouteName() === 'reportes.index' ? 'active' : ''}}">
				<a href="{{ route('reportes.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="download"></i>
					<span class="menu-title text-truncate">Reportes</span>
				</a>
			</li>
			<li class="nav-item  {{Route::currentRouteName() === 'compras.index' ? 'active' : ''}}">
				<a href="{{ route('compras.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="truck"></i>
					<span class="menu-title text-truncate">Compras</span>
				</a>
			</li>
			<li class="nav-item  {{Route::currentRouteName() === 'proveedores.index' ? 'active' : ''}}">
				<a href="{{ route('proveedores.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="truck"></i>
					<span class="menu-title text-truncate">Proveedores</span>
				</a>
			</li>
			<li class="nav-item has-sub  {{Route::currentRouteName() === 'productos.index' ? 'sidebar-group-active open' : ''}} {{Route::currentRouteName() === 'unidades.index' ? 'sidebar-group-active open' : ''}} {{Route::currentRouteName() === 'categorias.index' ? 'sidebar-group-active open' : ''}}" style="">
				<a class="d-flex align-items-center" href="#">
					<i data-feather="book"></i>
					<span class="menu-title text-truncate">Catálogo</span>
				</a>
				<ul class="menu-content">
					<li {{Route::currentRouteName() === 'productos.index' ? 'class="active"' : ''}}>
						<a class="d-flex align-items-center" href="{{ route('productos.index') }}">
							<span class="menu-item text-truncate" data-i18n="Basic">Productos</span>
						</a>
					</li>
					<li {{Route::currentRouteName() === 'categorias.index' ? 'class="active"' : ''}}>
						<a class="d-flex align-items-center" href="{{ route('categorias.index') }}">
							<span class="menu-item text-truncate" data-i18n="Advanced">Categorias</span>
						</a>
					</li>
					<li {{Route::currentRouteName() === 'unidades.index' ? 'class="active"' : ''}}>
						<a class="d-flex align-items-center" href="{{ route('unidades.index') }}">
							<span class="menu-item text-truncate" data-i18n="Advanced">Unidades</span>
						</a>
					</li>
				</ul>
			</li>
		@elseif(Auth::user()->type==2 || Auth::user()->type==3)
			<li class="nav-item  {{Route::currentRouteName() === 'fichas.index' ? 'active' : ''}}">
				<a href="{{ route('fichas.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="book"></i>
					<span class="menu-title text-truncate">Fichas de atención</span>
				</a>
			</li>
			<li class="nav-item  {{Route::currentRouteName() === 'calendario.index' ? 'active' : ''}}">
				<a href="{{ route('calendario.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="calendar"></i>
					<span class="menu-title text-truncate">Disponibilidad</span>
				</a>
			</li>
			<li class="nav-item  {{Route::currentRouteName() === 'solicitudes.index' ? 'active' : ''}}">
				<a href="{{ route('solicitudes.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="calendar"></i>
					<span class="menu-title text-truncate">Solicitudes</span>
				</a>
			</li>
		@elseif(Auth::user()->type==4)
			<li class="nav-item  {{Route::currentRouteName() === 'calendario.index' ? 'active' : ''}}">
				<a href="{{ route('calendario.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="calendar"></i>
					<span class="menu-title text-truncate">Horario</span>
				</a>
			</li>

			<li class="nav-item  {{Route::currentRouteName() === 'hojasderuta.index' ? 'active' : ''}}">
				<a href="{{ route('hojasderuta.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="calendar"></i>
					<span class="menu-title text-truncate">Hoja de ruta</span>
				</a>
			</li>
			
			<li class="nav-item  {{Route::currentRouteName() === 'solicitudes.index' ? 'active' : ''}}">
				<a href="{{ route('solicitudes.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="calendar"></i>
					<span class="menu-title text-truncate">Solicitudes</span>
				</a>
			</li>
		@elseif(Auth::user()->type==5)
			<li class="nav-item  {{Route::currentRouteName() === 'calendario.index' ? 'active' : ''}}">
				<a href="{{ route('calendario.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="calendar"></i>
					<span class="menu-title text-truncate">fs</span>
				</a>
			</li>
			
		@elseif(Auth::user()->type==6)
			<li class="nav-item  {{Route::currentRouteName() === 'fichas.index' ? 'active' : ''}}">
				<a href="{{ route('fichas.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="book"></i>
					<span class="menu-title text-truncate">Fichas de atención</span>
				</a>
			</li>
			<li class="nav-item  {{Route::currentRouteName() === 'calendario.index' ? 'active' : ''}}">
				<a href="{{ route('calendario.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="calendar"></i>
					<span class="menu-title text-truncate">Disponibilidad</span>
				</a>
			</li>
			<li class="nav-item  {{Route::currentRouteName() === 'solicitudes.index' ? 'active' : ''}}">
				<a href="{{ route('solicitudes.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="calendar"></i>
					<span class="menu-title text-truncate">Solicitudes</span>
				</a>
			</li>
			<li class="nav-item  {{Route::currentRouteName() === 'reportes.index' ? 'active' : ''}}">
				<a href="{{ route('reportes.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="download"></i>
					<span class="menu-title text-truncate">Reportes</span>
				</a>
			</li>
		@else
			<li class="nav-item  {{Route::currentRouteName() === 'cronograma.index' ? 'active' : ''}}">
				<a href="{{ route('cronograma.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="calendar"></i>
					<span class="menu-title text-truncate">Cronograma</span>
				</a>
			</li>
			
			<li class="nav-item  {{Route::currentRouteName() === 'solicitudes.index' ? 'active' : ''}}">
				<a href="{{ route('solicitudes.index') }}" class="d-flex align-items-center" target="_self">
					<i data-feather="calendar"></i>
					<span class="menu-title text-truncate">Solicitudes</span>
				</a>
			</li>
		@endif
		<li class="nav-item  ">
       		<a href="{{ route('logout') }}" class="d-flex align-items-center" onclick="event.preventDefault(); document.getElementById('logout-form2').submit();">
				<i data-feather="power"></i>
				<span class="menu-title text-truncate">Salir</span>
            </a>
          <form method="POST" id="logout-form2" action="{{ route('logout') }}">
            @csrf
          </form>
        </li>
    </ul>
  </div>
</div>
<!-- END: Main Menu-->
