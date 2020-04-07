@extends('master')

@section('content')
<h3>Ciudades</h3>

<hr>
<div class="row">

    <div class="col-md-12 mb-3">
        <form>
            <div class="form-row justify-content-center col-md-11">
                <div class="form-group col-md-2" id="idCiudad">
                    <label>ID:</label>
                    <input type="text" id="myid" class="form-control" readonly='readonly'>
                </div>
                <div class="form-group col-md-5">
                    <label>Ciudad</label>
                    <input type="teSxt" id="nombreCiudad" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label>País de ciudad</label>
                    <select id="sel_pais" class="form-control">

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
                    <th class="th-sm">ID</th>
                    <th class="th-sm">Ciudad</th>
                    <th class="th-sm">País</th>
                    <th class="th-sm">Acciones</th>
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

    $('#save').show();
    $('#update').hide();
    $('#idCiudad').hide();



    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function viewData() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "ciudad",
            success: function(response) {
                var len = 0;
                if (response['paises'] != null) {
                    len = response['paises'].length;
                }
                if (len > 0) {
                    $('#sel_pais').empty().append("<option selected='true' readonly='true' disabled='true'>País de ciudad</option>");
                    for (var i = 0; i < len; i++) {
                        var id = response['paises'][i].id_pais;
                        var name = response['paises'][i].nombre_pais;
                        var option = "<option value='" + id + "'>" + name + "</option>";
                        $("#sel_pais").append(option);
                    }
                }
                var rows = "";
                $.each(response['ciudades'], function(key, value) {
                    rows = rows + "<tr>";
                    rows = rows + "<td>" + value.id_ciudad + "</td>";
                    rows = rows + "<td>" + value.nombre_ciudad + "</td>";
                    $.each(response['paises'], function(keyPais, valuePais) {
                        if (value.id_pais == valuePais.id_pais) {
                            rows = rows + "<td>" + valuePais.nombre_pais + "</td>";
                        }
                    });
                    rows = rows + "<td width='200'>";
                    rows = rows + "<button type='button' class='btn btn-warning ml-1' onclick='editData(" + value.id_ciudad + ")'>Editar</button>";
                    rows = rows + "<button type='button' class='btn btn-danger ml-2' onclick='deleteData(" + value.id_ciudad + ")'>Eliminar</button>";
                    rows = rows + "</td><tr>";
                });
                $('tbody').html(rows);
            }
        });
    }

    viewData();

    function saveData() {
        var nombre_ciudad = $('#nombreCiudad').val();
        var id_pais = $('#sel_pais').val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {
                nombre_ciudad: nombre_ciudad,
                id_pais: id_pais
            },
            url: 'ciudad',
            success: function(response) {
                viewData();
                clearData();
                $('#save').show();
            }
        })
    }

    function clearData() {
        $('#myid').val('');
        $('#nombreCiudad').val('');
        $('#nombrePais').val('');
        $('#myInput').val('');
    }

    function editData(id_ciudad) {
        $('#save').hide();
        $('#update').show();
        $('#idCiudad').show();
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: 'ciudad/' + id_ciudad + '/edit',
            success: function(response) {
                $('#myid').val(response.id_ciudad);
                $('#nombreCiudad').val(response.nombre_ciudad);
                $('option[value =' + response.id_pais + ']').attr('selected', true);
            }
        });
    }

    function updateData() {
        var id_ciudad = $('#myid').val();
        var nombre_ciudad = $('#nombreCiudad').val();
        var id_pais = $('#sel_pais').val();
        $.ajax({
            type: 'PUT',
            dataType: 'json',
            data: {
                nombre_ciudad: nombre_ciudad,
                id_pais: id_pais
            },
            url: 'ciudad/' + id_ciudad,
            success: function(response) {
                viewData();
                clearData();
                $('#save').show();
                $('#update').hide();
                $('#idCiudad').hide();
            }
        })
    }

    function deleteData(id_ciudad) {
        $.ajax({
            type: 'DELETE',
            dataType: 'json',
            url: 'ciudad/' + id_ciudad,
            success: function(response) {
                clearData();
                viewData();
                $('#save').show();
                $('#update').hide();
                $('#idCiudad').hide();
            }
        })
    }
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
</script>
@endsection