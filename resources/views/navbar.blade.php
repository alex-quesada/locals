<nav id="navbar" class="navbar navbar-dark bg-dark mt-3" style="background-color: #5D5D5D;">
    <a class="navbar-brand" href="/">Mi Empresa</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Inicio <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Administrar
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <h6 class="ml-3">Empleados:</h6>
                    <div class="row text-left">
                    <div class="col-md-2">
                            <a class="dropdown-item" href="{{ action('TipoEmpleadoAjaxController@index') }}">Tipo
                                Empleado</a>
                        </div>
                        <div class="col-md-2">
                            <a class="dropdown-item" href="{{ action('EmpleadoAjaxController@index') }}">Empleado</a>
                        </div>
                        <div class="col-md-2">
                            <a class="dropdown-item" href="{{ action('HorasTrabajadasAjaxController@index') }}">Horas
                                Trabajadas</a>
                        </div>
                    </div>
                    <hr>
                    <h6 class="ml-3">Local:</h6>
                    <div class="row text-left">
                        <div class="col-md-2">
                            <a class="dropdown-item"
                                href="{{ action('RestaurantesAjaxController@index') }}">Local</a>
                        </div>
                        <div class="col-md-2">
                            <a class="dropdown-item" href="{{ action('PagoPlanillaAjaxController@index') }}">Pago
                                Planilla</a>
                        </div>
                    </div>
                    <hr>
                    <h6 class="ml-3">Miscelaneos:</h6>
                    <div class="row text-left">
                    <div class="col-md-2">
                            <a class="dropdown-item" href="{{ action('PaisesAjaxController@index') }}">Países</a>
                        </div>
                        <div class="col-md-2">
                            <a class="dropdown-item" href="{{ action('CiudadesAjaxController@index') }}">Ciudades</a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>