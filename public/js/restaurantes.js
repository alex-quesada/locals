$(document).ready(function() {
    $("#myInput").on("keyup", function() {
        var value = $(this)
            .val()
            .toLowerCase();
        $("#filter tr").filter(function() {
            $(this).toggle(
                $(this)
                    .text()
                    .toLowerCase()
                    .indexOf(value) > -1
            );
        });
    });
});

$("#save").show();
$("#update").hide();
$("#idRestaurante").hide();
$("#selecCiudad").hide();
$("#datatable1").hide();
$("#botonActualizar").hide();

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});

function viewData() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "restaurante",
        success: function(response) {
            var len = 0;
            if (response["paises"] != null) {
                len = response["paises"].length;
            }
            if (len > 0) {
                $("#sel_pais")
                    .empty()
                    .append(
                        "<option selected='true' readonly='true' value='-' disabled='true'>País</option>"
                    );
                for (var i = 0; i < len; i++) {
                    var id = response["paises"][i].id_pais;
                    var name = response["paises"][i].nombre_pais;
                    var option =
                        "<option value='" + id + "'>" + name + "</option>";
                    $("#sel_pais").append(option);
                }
            }
            var len = 0;
            if (response["ciudades"] != null) {
                len = response["ciudades"].length;
            }
            if (len > 0) {
                $("#sel_ciudad")
                    .empty()
                    .append(
                        "<option selected='true' readonly='true' value='-' disabled='true'>Ciudad</option>"
                    );
                for (var i = 0; i < len; i++) {
                    var id = response["ciudades"][i].id_ciudad;
                    var name = response["ciudades"][i].nombre_ciudad;
                    var option =
                        "<option value='" + id + "'>" + name + "</option>";
                    $("#sel_ciudad").append(option);
                }
            }
            var rows = "";
            $.each(response["restaurantes"], function(key, value) {
                rows = rows + "<tr>";
                rows = rows + "<td>" + value.id_restaurante + "</td>";
                $.each(response["direcciones"], function(
                    keyDireccion,
                    valueDireccion
                ) {
                    if (value.id_direccion == valueDireccion.id_direccion) {
                        rows =
                            rows +
                            "<td>" +
                            valueDireccion.direccion_uno +
                            "</td>";
                        $.each(response["ciudades"], function(
                            keyCiudad,
                            valueCiudad
                        ) {
                            if (
                                valueDireccion.id_ciudad ==
                                valueCiudad.id_ciudad
                            ) {
                                rows =
                                    rows +
                                    "<td>" +
                                    valueCiudad.nombre_ciudad +
                                    "</td>";
                                $.each(response["paises"], function(
                                    keyPais,
                                    valuePais
                                ) {
                                    if (
                                        valueCiudad.id_pais == valuePais.id_pais
                                    ) {
                                        rows =
                                            rows +
                                            "<td>" +
                                            valuePais.nombre_pais +
                                            "</td> <td> Telefonos: ";
                                    }
                                });
                                $.each(response["telefonosRest"], function(
                                    keyTelefonos,
                                    valueTelefonos
                                ) {
                                    if (
                                        value.id_restaurante ==
                                        valueTelefonos.id_restaurante
                                    ) {
                                        rows =
                                            rows +
                                            valueTelefonos.telefono_restaurante +
                                            ", ";
                                    }
                                });
                            }
                        });
                    }
                });

                rows = rows + "</td> <td width='200'>";
                rows =
                    rows +
                    "<button type='button' class='btn btn-warning ml-1' onclick='editData(" +
                    value.id_restaurante +
                    ")'>Editar</button>";
                rows =
                    rows +
                    "<button type='button' class='btn btn-danger ml-2' onclick='deleteData(" +
                    value.id_restaurante +
                    ")'>Eliminar</button>";
                rows = rows + "</td><tr>";
            });
            $("#datatable").html(rows);
        }
    });
}

viewData();

function saveData() {
    var direccion_uno = $("#direccionUno").val();
    var id_ciudad = $("#sel_ciudad").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {
            direccion_uno: direccion_uno,
            id_ciudad: id_ciudad
        },
        url: "restaurante",
        success: function(response) {
            agregarTelefonos(telefonosAgregados, response.id_restaurante);
            viewData();
            clearData();
            $("#save").show();
        }
    });
    $("#selecCiudad").hide();
}

function clearData() {
    $("#myid").val("");
    $("#direccionUno").val("");
    $("#myInput").val("");
    $("#numeroTelefono").val("");
    $("#telefonosAgregados").val("");
}

function editData(id_restaurante) {
    $("#save").hide();
    $("#update").show();
    $("#idRestaurante").show();
    $("#selecCiudad").show();
    $("#selecPais").show();
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "restaurante/" + id_restaurante + "/edit",
        success: function(response) {
            $("#myid").val(response["restaurantes"].id_restaurante);
            $("#direccionUno").val(response["direcciones"].direccion_uno);
            $("#sel_pais").val(response["paises"].id_pais);
            $("option[value =" + response["ciudades"].id_ciudad + "]").attr(
                "selected",
                true
            );
            viewDataTelefonos(response["restaurantes"].id_restaurante);
            $("#botonActualizar").show();
            $("#telefonosAgregados").hide();
            $("#botonAgregarTelefono").hide();
            $("#actualizarTelefono").attr("disabled", true);
            $("#masTelefonos").attr("disabled", false);
            $("#datatable1").show();
        }
    });
}

function updateData() {
    var id_restaurante = $("#myid").val();
    var direccion_uno = $("#direccionUno").val();
    var id_ciudad = $("#sel_ciudad").val();
    var id_pais = $("#sel_pais").val();
    $.ajax({
        type: "PUT",
        dataType: "json",
        data: {
            direccion_uno: direccion_uno,
            id_ciudad: id_ciudad
        },
        url: "restaurante/" + id_restaurante,
        success: function(response) {
            viewData();
            clearData();
            $("#save").show();
            $("#update").hide();
            $("#idRestaurante").hide();
            $("#selecPais").show();
            $("#selecCiudad").hide();
            $("#telefonosAgregados").show();
            $("#datatable1").hide();
            $("#botonAgregarTelefono").show();
            $("#botonActualizar").hide();
        }
    });
}

function deleteData(id_restaurante) {
    $.ajax({
        type: "DELETE",
        dataType: "json",
        url: "restaurante/" + id_restaurante,
        success: function(response) {
            clearData();
            viewData();
            $("#save").show();
            $("#update").hide();
            $("#idRestaurante").hide();
        }
    });
}
$(document).ready(function() {
    $("#datatable").DataTable({
        scrollY: "40vh",
        scrollCollapse: true,
        paging: false,
        ordering: false,
        info: false,
        searching: false
    });
    $(".dataTables_length").addClass("bs-select");
});

function cambiaCiudad() {
    var pais = $("#sel_pais").val();
    if (pais != 0) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "restaurante",
            success: function(response) {
                var len = 0;
                if (response["ciudades"] != null) {
                    len = response["ciudades"].length;
                }
                if (len > 0) {
                    $("#sel_ciudad").empty();
                    for (var i = 0; i < len; i++) {
                        if (response["ciudades"][i].id_pais == pais) {
                            var id = response["ciudades"][i].id_ciudad;
                            var name = response["ciudades"][i].nombre_ciudad;
                            var option =
                                "<option value='" +
                                id +
                                "'>" +
                                name +
                                "</option>";
                            $("#sel_ciudad").append(option);
                        }
                    }
                }
            }
        });
    }
    $("#selecCiudad").show();
}

//metodos para controlar telefonos restaurantes

function viewDataTelefonos($id_restaurante) {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "telefonorestaurante",
        success: function(response) {
            var rows = "";
            $.each(response["telefonosEmpleado"], function(key, value) {
                if (value.id_restaurante == $id_restaurante) {
                    rows = rows + "<tr>";
                    rows =
                        rows +
                        "<td> Telefono: " +
                        value.telefono_restaurante +
                        "</td>";
                    rows = rows + "<td width='200'>";
                    rows =
                        rows +
                        "<button type='button' class='btn btn-warning ml-1' onclick='editarTelefono(" +
                        value.telefono_restaurante +
                        ")'>Editar</button>";
                    rows =
                        rows +
                        "<button type='button' class='btn btn-danger ml-2' onclick='deleteTelefono(" +
                        value.telefono_restaurante +
                        ")'>Eliminar</button>";
                    rows = rows + "</td><tr>";
                }
            });
            $("#telefonos").html(rows);
        }
    });
}

function deleteTelefono(telefono_restaurante) {
    $.ajax({
        type: "DELETE",
        dataType: "json",
        url: "telefonorestaurante/" + telefono_restaurante,
        success: function(response) {
            viewDataTelefonos($("#myid").val());
            $("#idRestaurante").hide();
        }
    });
}

var idTel = "";
function editarTelefono(telefono_restaurante) {
    $("#actualizarTelefono").attr("disabled", false);
    $("#masTelefonos").attr("disabled", true);
    $("#save").hide();
    $("#botonActualizar").show();
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "telefonorestaurante/" + telefono_restaurante + "/edit",
        success: function(response) {
            $("#numeroTelefono").val(response.telefono_restaurante);
            idTel = response.telefono_restaurante;
        }
    });
}
var telefonosAgregados = [];
function otroTelefono() {
    var numero_telefono = $("#numeroTelefono").val();
    var telefono = {
        numero_telefono: numero_telefono
    };
    telefonosAgregados.push(telefono);
    $("#numeroTelefono").val("");
    var datos = "";
    $.each(telefonosAgregados, function(key, value) {
        datos = datos + "Telefono: " + value.numero_telefono + "\n";
    });

    $("#telefonosAgregados").val(datos);
}
function updateTel() {
    $("#actualizarTelefono").attr("disabled", true);
    $("#masTelefonos").attr("disabled", false);
    var telefono_restaurante = $("#numeroTelefono").val();
    $.ajax({
        type: "PUT",
        dataType: "json",
        data: {
            telefono_restaurante: telefono_restaurante
        },
        url: "telefonorestaurante/" + idTel,
        success: function(response) {
            $("#numeroTelefono").val("");
            var id = $("#myid").val();
            viewDataTelefonos(id);
        }
    });
}
function storeTel() {
    var telefono_restaurante = $("#numeroTelefono").val();
    var id_restaurante = $("#myid").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {
            telefono_restaurante: telefono_restaurante,
            id_restaurante: id_restaurante
        },
        url: "telefonorestaurante",
        success: function(response) {
            telefonosAgregados = [];
            $("#numeroTelefono").val("");
            viewDataTelefonos(id_restaurante);
        }
    });
}

function agregarTelefonos(telefonosAgregados, id_restaurante) {
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {
            telefonosAgregados,
            id_restaurante: id_restaurante
        },
        url: "telefonorestaurante",
        success: function(response) {
            telefonosAgregados = [];
            $("#telefonosAgregados").val("");
        }
    });
}
