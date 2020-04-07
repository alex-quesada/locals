@extends('master')

@section('content')
<h3>Pago Planillas</h3>


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
                <div class="form-group col-md-1" id="salXH" hidden="true">
                    <label>Salario Por Hora</label>
                    <input type="number" id="salarioPorHora" class="form-control" readonly="readonly">
                </div>
                <div class="form-group col-md-3" id="divSelEmp">
                    <label>Seleccione Empleado</label>
                    <select id="sel_empleado" class="form-control" onclick="darIdEmpleado()"></select>
                </div>
            </div>
            <div id="tituloInfoPago">
                <hr>
                <h6>Informacion de pago</h6>
                <button type="button" id="calcSal" onclick="calcularSalario()"
                    class="btn btn-primary mt">Calcular</button>
            </div>
            <div class="form-row justify-content-center col-md-11" id="datosDePagoDiv">
                <div class="form-group col-md-3" id="fechaInicio">
                    <label>Fecha Inicio</label>
                    <input type="date" id="fecha_inicio" class="form-control">
                </div>
                <div class="form-group col-md-3" id="fechaFinal">
                    <label>Fecha Final</label>
                    <input type="date" id="fecha_final" class="form-control">
                </div>
                <div class="form-group col-md-3" id="fechaPago">
                    <label>Fecha Pago</label>
                    <input type="date" id="fecha_pago" class="form-control">
                </div>
            </div>

            <div class="form-row justify-content-center col-md-11" id="datosDeSalariosBN">
                <div class="form-group col-md-2" id="salarioBruto">
                    <label>Salario Bruto</label>
                    <input type="number" id="salario_bruto" class="form-control" step=".01" readonly="readonly">
                </div>
                <div class="form-group col-md-2" id="salarioBruto">
                    <label>Salario Neto</label>
                    <input type="number" id="salario_neto" class="form-control" step=".01" readonly="readonly">
                </div>

            </div>
            <div id="tituloDeducciones">
                <h6>Deducciones</h6>
                <button type="button" id="save" onclick="deducciones()" class="btn btn-primary mt">Deduccion</button>
            </div>
            <div class="form-row justify-content-center col-md-11" id="deducciones">

                <div class="form-group col-md-2" id="porcDeduc">
                    <label>Porcentaje</label>
                    <input type="number" id="porcentaje" class="form-control" step=".01">
                </div>
                <div class="form-group col-md-4" id="detaDeduc">
                    <label>Detalle</label>
                    <textarea type="text" id="detalle" class="form-control" rows="4"></textarea>
                </div>

            </div>
            <div class="form-row col-md-11 justify-content-center">
                <button type="button" id="save" onclick="saveData()" class="btn btn-primary mt-2">Pagar</button>
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
                    <th scope="col" class="th-sm">Fecha de pago</th>
                    <th scope="col" class="th-sm">Salario Bruto</th>
                    <th scope="col" class="th-sm">Salario Neto</th>
                    <th scope="col" class="th-sm">Empleado</th>
                </tr>
            </thead>
            <tbody id='filter'></tbody>
        </table>
        <hr>
    </div>
</div>
@endsection
@section('footer-script')
<script type="text/javascript" src="{{ asset('js/pagoPlanilla.js') }}">
</script>
@endsection