@extends('master')

@section('content')
<h3>Empleados</h3>
<p>Se ingresan empleados y se asigna local al que pertenese (Recuerde haber agregado: al menos un local, y un tipo de empleado)</p>
<hr>
<h6>Datos Personales</h6>
<div class="row">

    <div class="col-md-12 mb-3">
        <form>
            <div class="form-row justify-content-center col-md-11">
                <div class="form-group col-md-3" id="idEmpleado">
                    <label>ID:</label>
                    <input type="text" id="myid" class="form-control">
                </div>
                <div hidden='true' class="form-group col-md-3" id="idEmpleado">
                    <label>ID Empleado:</label>
                    <input type="text" id="idEmpleado" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Nombre</label>
                    <input type="text" id="nombreEmpleado" class="form-control">
                </div>
                <div class="form-group col-md-3" id="apellido1">
                    <label>Apellido Uno</label>
                    <input type="text" id="apellidoUno" class="form-control" onchange="cambiaCiudad()">
                </div>
                <div class="form-group col-md-3" id="apellido2">
                    <label>Apellido Dos</label>
                    <input type="text" id="apellidoDos" class="form-control" onchange="cambiaCiudad()">
                </div>
                <div class="form-group col-md-4" id="correo">
                    <label>Correo</label>
                    <input type="email" id="correoEmpleado" class="form-control">
                </div>
                <div hidden='true' class="form-group col-md-4">
                    <label>ID Direccion</label>
                    <input type="text" id="idDireccion" class="form-control">
                </div>

                <div class="form-group col-md-4">
                    <label>Direccion</label>
                    <input type="text" id="direccionUno" class="form-control">
                </div>
                <div class="form-group col-md-4" id="selecPais">
                    <label>País</label>
                    <select id="sel_pais" class="form-control" onchange="cambiaCiudad()">
                    </select>
                </div>
                <div class="form-group col-md-4" id="selecCiudad">
                    <label>Ciudad</label>
                    <select id="sel_ciudad" class="form-control">
                    </select>
                </div>
                <div class="form-group col-md-3" id="telefono">
                    <label>#Telefono</label>
                    <input type="text" id="numeroTelefono" class="form-control">
                </div>
                <div class="form-group col-md-3" id="selecTipoTel">
                    <label>Tipo Telefono</label>
                    <select id="sel_TipoTel" class="form-control">
                        <option value="Casa" selected="true">Casa</option>
                        <option value="Oficina">Oficina</option>
                        <option value="Celular">Celular</option>
                    </select>
                </div>
                <div class="form-group col-md-2" id="botonAgregarTelefono">
                    <label>Otro</label>
                    <button onclick="otroTelefono()" type="button" class="btn btn-primary form-control"
                        id="agregarTelefono">Add</button>
                </div>
                <div class="form-group col-md-2 center" id="botonActualizar">
                    <button onclick="storeTel()" type="button" class="btn btn-primary form-control"
                        id="masTelefonos">Agregar</button>
                    <button onclick="updateTel()" type="button" class="btn btn-warning form-control mt-2"
                        id="actualizarTelefono">Actualizar</button>
                </div>
                <div id="telefonoesArea" class="form-group col-md-4" id="botonAgregarTelefono">
                    <label>Telefonos</label>
                    <textarea id="telefonosAgregados" cols="42" rows="3" readonly="readonly"></textarea>
                </div>
                <table id="datatable1" class="table table-bordered table-striped table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col" class="th-sm">Numero</th>
                            <th scope="col" class="th-sm">Tipo</th>
                            <th scope="col" class="th-sm">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id='telefonos'></tbody>
                </table>

            </div>


            <hr>
            <h6>Restaurante & Empleado</h6>
            <div class="form-row justify-content-center col-md-11">
                <div class="form-group col-md-3" id="selecPais">
                    <label>Tipo Empleado</label>
                    <select id="sel_tipo_emp" class="form-control">
                    </select>
                </div>
                <div class="form-group col-md-3" id="selecPais">
                    <label>País Restaurante</label>
                    <select id="sel_pais_rest" class="form-control" onchange="cambiaCiudadRest()">
                    </select>
                </div>
                <div class="form-group col-md-3" id="selecCiudad">
                    <label>Ciudad Restaurante</label>
                    <select id="sel_ciudad_rest" class="form-control" onchange="cambiaDirRest()">
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Direccion Restaurante</label>
                    <select id="sel_dir_rest" class="form-control" onclick="darIdRest()"></select>
                </div>
                <div class="form-group col-md-1" id="idDelRest">
                    <label>ID Restaurante</label>
                    <input type="number" id="idRestaurante" class="form-control" readonly='readonly'>
                </div>
                <div class="form-group col-md-3" id="selecCiudad">
                    <label>Fecha Ingreso</label>
                    <input type="date" id="sel_fech_ingreso" class="form-control">
                    </select>
                </div>
                <div class="form-group col-md-3" id="selecCiudad">
                    <label>Salario Por Hora</label>
                    <input type="number" id="salarioPorHora" class="form-control">
                    </select>
                </div>
            </div>
            <div class="form-row col-md-11 justify-content-center">
                <button type="button" id="save" onclick="saveData()" class="btn btn-primary mt-2">Agregar</button>
                <button type="button" id="update" onclick="updateData()" class="btn btn-warning mt-2">Actualizar /
                    Cancelar</button>
            </div>
        </form>
        <hr>
    </div>
    <div class="col-md-12">
        <input class="form-control col-md-3" id="myInput" type="text" placeholder="Buscar..">
        <table id="datatable" class="table table-bordered table-striped table-sm" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th scope="col" class="th-sm">ID</th>
                    <th scope="col" class="th-sm">Nombre</th>
                    <th scope="col" class="th-sm">Correo</th>
                    <th scope="col" class="th-sm">Direccion</th>
                    <th scope="col" class="th-sm">Telefonos</th>
                    <th scope="col" class="th-sm">Tipo Empleado</th>
                    <th scope="col" class="th-sm">Restaurante</th>
                    <th scope="col" class="th-sm">Fecha Ingreso</th>
                    <th scope="col" class="th-sm">Salario Por Hora</th>
                    <th scope="col" class="th-sm">Acciones</th>
                </tr>
            </thead>
            <tbody id='filter'></tbody>
        </table>
        <hr>
    </div>
</div>
@endsection

@section('footer-script')
<script type="text/javascript" src="{{ asset('js/empleadoajax.js') }}">
</script>
@endsection