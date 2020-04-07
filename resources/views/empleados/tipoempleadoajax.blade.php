@extends('master')

@section('content')
<h3>Tipo Empleado</h3>
<hr>
<div class="row">
    <div class="col-md-12 mb-3">
        <form>
            <div class="form-row justify-content-center col-md-11">
                <div class="form-group col-md-2" id="idTipoEmpleado">
                    <label>ID:</label>
                    <input type="text" id="myid" class="form-control" readonly='readonly'>
                </div>
                <div class="form-group col-md-4">
                    <label>Puesto</label>
                    <input type="text" id="nombrePuesto" class="form-control">
                </div>
                <div class="form-row col-md-11 justify-content-center">
                    <button type="button" id="save" onclick="saveData()" class="btn btn-primary">Agregar</button>
                    <button type="button" id="update" onclick="updateData()" class="btn btn-warning">Actualiza /
                        Cancel</button>
                </div>
            </div>
            <hr>
        </form>
    </div>
    <div class="col-md-12">
        <input class="form-control col-md-3" id="myInput" type="text" placeholder="Buscar..">
        <table id="datatable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pusto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id='filter'></tbody>
        </table>
    </div>

</div>
@endsection

@section('footer-script')
<script type="text/javascript">
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#filter tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    $(document).ready(function() {
        $('#datatable').DataTable({
            "scrollY": "40vh",
            "scrollCollapse": true,
            "paging": false,
            "ordering": false,
            "info": false,
            "searching": false
        });
        $('.dataTables_length').addClass('bs-select');
    });
    $('#save').show();
    $('#update').hide();
    $('#idTipoEmpleado').hide();



    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function viewData() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "tipoempleado",
            success: function(response) {
                var rows = "";
                $.each(response, function(key, value) {
                    rows = rows + "<tr>";
                    rows = rows + "<td>" + value.id_tipo_empleado + "</td>";
                    rows = rows + "<td>" + value.nombre_puesto + "</td>";
                    rows = rows + "<td width='200'>";
                    rows = rows + "<button type='button' class='btn btn-warning ml-1' onclick='editData(" + value.id_tipo_empleado + ")'>Editar</button>";
                    rows = rows + "<button type='button' class='btn btn-danger ml-2' onclick='deleteData(" + value.id_tipo_empleado + ")'>Eliminar</button>";
                    rows = rows + "</td><tr>";
                });
                $('tbody').html(rows);
            }

        });
    }

    viewData();

    function saveData() {
        var nombre_puesto = $('#nombrePuesto').val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {
                nombre_puesto: nombre_puesto,
            },
            url: ('tipoempleado'),
            success: function(response) {
                viewData();
                clearData();
                $('#save').show();
            }
        })
    }

    function clearData() {
        $('#myInput').val('');
        $('#myid').val('');
        $('#nombrePuesto').val('');

    }

    function editData(id_tipo_empleado) {
        $('#save').hide();
        $('#update').show();
        $('#idTipoEmpleado').show();
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: 'tipoempleado/' + id_tipo_empleado + '/edit',
            success: function(response) {
                $('#myid').val(response.id_tipo_empleado);
                $('#nombrePuesto').val(response.nombre_puesto);
            }
        })
    }

    function updateData() {
        var id_tipo_empleado = $('#myid').val();
        var nombre_puesto = $('#nombrePuesto').val();
        $.ajax({
            type: 'PUT',
            dataType: 'json',
            data: {
                id_tipo_empleado: id_tipo_empleado,
                nombre_puesto: nombre_puesto,
            },
            url: 'tipoempleado/' + id_tipo_empleado,
            success: function(response) {
                viewData();
                clearData();
                $('#save').show();
                $('#update').hide();
                $('#idTipoEmpleado').hide();
            }
        })
    }

    function deleteData(id_tipo_empleado) {
        $.ajax({
            type: 'DELETE',
            dataType: 'json',
            url: 'tipoempleado/' + id_tipo_empleado,
            success: function(response) {
                viewData();
                clearData();

            }
        })
    }
</script>
@endsection