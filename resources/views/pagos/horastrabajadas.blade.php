@extends('master')

@section('content')
<h3>Horas Trabajadas</h3>


<div class="row">

    <div class="col-md-12 mb-3">
        <form>
            <div id="tituloRest">
                <hr>
                <h6>Seleccione Restaurante:</h6>
            </div>

            <div class="form-row justify-content-center col-md-11" id="selRestDiv">
                <div class="form-group col-md-1" id="idDelRest">
                    <label>ID Rest.</label>
                    <input type="number" id="idRestaurante" class="form-control" readonly='readonly'>
                </div>
                <div class="form-group col-md-3" id="selecPais">
                    <label>País Restaurante</label>
                    <select id="sel_pais_rest" class="form-control" onchange="cambiaCiudadRest()">
                    </select>
                </div>
                <div class="form-group col-md-3" id="selecCiudad">
                    <label>Ciudad Restaurante</label>
                    <select id="sel_ciudad_rest" class="form-control" onchange="cambiaDirRest()">
                        <option value="-" disabled="true" selected="true">Ciudad</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Direccion Restaurante</label>
                    <select id="sel_dir_rest" class="form-control" onclick="darIdRest()">
                        <option value="-" disabled="true" selected="true">Direccion Restaurante</option>
                    </select>
                </div>
            </div>
            <div id="tituloSeleccioneEmpleado">
                <hr>
                <h6>Seleccione Empleado:</h6>
            </div>
            <div class="form-row justify-content-center col-md-11" id="seleccionarEmpleado">
                <div class="form-group col-md-1" id="idEmpleado">
                    <label>ID Emp.</label>
                    <input type="text" id="myid" class="form-control" readonly="readonly">
                </div>
                <div class="form-group col-md-3" id="divSelEmp">
                    <label>Seleccione Empleado</label>
                    <select id="sel_empleado" class="form-control" onclick="darIdEmpleado()"></select>
                </div>
            </div>
            <div id="tituloFechaYhoras">
                <hr>
                <h6>Fecha y Horas Trabajadas</h6>
            </div>
            <div class="form-row justify-content-center col-md-11" id="fechaYHoras">
                <div class="form-group col-md-3" hidden="true">
                    <label>Id Horas Trabajas</label>
                    <input type="number" id="id_horas_trabajadas" class="form-control">
                </div>
                <div class="form-group col-md-3" id="selecFechaTrabajada">
                    <label>Fecha Trabajada</label>
                    <input type="date" id="fecha_trabajada" class="form-control">
                </div>
                <div class="form-group col-md-3" id="hSimples">
                    <label>Horas Simples</label>
                    <input type="number" id="horas_simples" class="form-control">
                </div>
                <div class="form-group col-md-3" id="hTiempoYMedio">
                    <label>Horas Tiempo Y Medio</label>
                    <input type="number" id="horas_tiempo_medio" class="form-control">
                </div>
                <div class="form-group col-md-3" id="hTiempoYMedio">
                    <label>Total Horas Extra</label>
                    <input type="number" id="horas_extra" class="form-control">
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
                    <th scope="col" class="th-sm">Nombre Empleado</th>
                    <th scope="col" class="th-sm">Fecha Trabajada</th>
                    <th scope="col" class="th-sm">Horas Simples</th>
                    <th scope="col" class="th-sm">Horas Tiempo y medio</th>
                    <th scope="col" class="th-sm">Horas Extra</th>
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
<script type="text/javascript" src="{{ asset('js/horasTrabajadas.js') }}">
</script>
@endsection