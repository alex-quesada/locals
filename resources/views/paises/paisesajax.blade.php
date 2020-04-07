@extends('master')

@section('content')
<h3>Países</h3>
<hr>
<div class="row">
    <div class="col-md-12 mb-3">
        <form>
            <div class="form-row justify-content-center col-md-11">
                <div class="form-group col-md-2" id="idPais">
                    <label>ID:</label>
                    <input type="text" id="myid" class="form-control" readonly='readonly'>
                </div>
                <div class="form-group col-md-4">
                    <label>País</label>
                    <input type="text" id="nombrePais" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label>Continente</label>
                    <input type="text" id="continentePais" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Codigo</label>
                    <input type="text" id="codigoPais" class="form-control">
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
                    <th>País</th>
                    <th>Continente</th>
                    <th>Código Teléfono</th>
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
    $('#idPais').hide();



    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function viewData() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "pais",
            success: function(response) {
                var rows = "";
                $.each(response, function(key, value) {
                    rows = rows + "<tr>";
                    rows = rows + "<td>" + value.id_pais + "</td>";
                    rows = rows + "<td>" + value.nombre_pais + "</td>";
                    rows = rows + "<td>" + value.continente_pais + "</td>";
                    rows = rows + "<td>" + value.codigo_pais + "</td>";
                    rows = rows + "<td width='200'>";
                    rows = rows + "<button type='button' class='btn btn-warning ml-1' onclick='editData(" + value.id_pais + ")'>Editar</button>";
                    rows = rows + "<button type='button' class='btn btn-danger ml-2' onclick='deleteData(" + value.id_pais + ")'>Eliminar</button>";
                    rows = rows + "</td><tr>";
                });
                $('tbody').html(rows);
            }

        });
    }

    viewData();

    function saveData() {
        var nombre_pais = $('#nombrePais').val();
        var continente_pais = $('#continentePais').val();
        var codigo_pais = $('#codigoPais').val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {
                nombre_pais: nombre_pais,
                codigo_pais: codigo_pais,
                continente_pais: continente_pais
            },
            url: ('pais'),
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
        $('#nombrePais').val('');
        $('#continentePais').val('');
        $('#codigoPais').val('');

    }

    function editData(id_pais) {
        $('#save').hide();
        $('#update').show();
        $('#idPais').show();
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: 'pais/' + id_pais + '/edit',
            success: function(response) {
                $('#myid').val(response.id_pais);
                $('#nombrePais').val(response.nombre_pais);
                $('#continentePais').val(response.continente_pais);
                $('#codigoPais').val(response.codigo_pais);
            }
        })
    }

    function updateData() {
        var id_pais = $('#myid').val();
        var nombre_pais = $('#nombrePais').val();
        var codigo_pais = $('#codigoPais').val();
        var continente_pais = $('#continentePais').val();
        $.ajax({
            type: 'PUT',
            dataType: 'json',
            data: {
                nombre_pais: nombre_pais,
                codigo_pais: codigo_pais,
                continente_pais: continente_pais
            },
            url: 'pais/' + id_pais, 
            success: function(response) {
                viewData();
                clearData();
                $('#save').show();
                $('#update').hide();
                $('#idPais').hide();
            }
        })
    }

    function deleteData(id_pais) {
        $.ajax({
            type: 'DELETE',
            dataType: 'json',
            url: 'pais/' + id_pais,
            success: function(response) {
                viewData();
                clearData();

            }
        })
    }
</script>
@endsection