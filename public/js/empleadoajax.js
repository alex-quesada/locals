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
$("#selecCiudad").show();
$("#idDelRest").hide();
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
        url: "empleado",
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
                $("#sel_pais_rest")
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
                    $("#sel_pais_rest").append(option);
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
                $("#sel_ciudad_rest")
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
                    $("#sel_ciudad_rest").append(option);
                }
            }
            var len = 0;
            if (response["tipoEmpleados"] != null) {
                len = response["tipoEmpleados"].length;
            }
            if (len > 0) {
                $("#sel_tipo_emp")
                    .empty()
                    .append(
                        "<option selected='true' readonly='true' value='-' disabled='true'>Tipo Empleado</option>"
                    );
                for (var i = 0; i < len; i++) {
                    var id = response["tipoEmpleados"][i].id_tipo_empleado;
                    var name = response["tipoEmpleados"][i].nombre_puesto;
                    var option =
                        "<option value='" + id + "'>" + name + "</option>";
                    $("#sel_tipo_emp").append(option);
                }
            }
            var rows = "";
            $.each(response["empleados"], function(key, value) {
                rows = rows + "<tr scope='row'>";
                rows = rows + "<td>" + value.id_empleado + "</td>";
                $.each(response["personas"], function(
                    keyPersona,
                    valuePersona
                ) {
                    if (value.id_persona == valuePersona.id_persona) {
                        rows =
                            rows +
                            "<td>" +
                            valuePersona.nombre +
                            " " +
                            valuePersona.apellido_uno +
                            " " +
                            valuePersona.apellido_dos +
                            "</td>";
                        rows = rows + "<td>" + valuePersona.correo + "</td>";
                        $.each(response["direcciones"], function(
                            keyDireccion,
                            valueDireccion
                        ) {
                            if (
                                valueDireccion.id_direccion ==
                                valuePersona.id_direccion
                            ) {
                                rows =
                                    rows +
                                    "<td>" +
                                    valueDireccion.direccion_uno +
                                    "</td> <td>";
                                $.each(response["telefonosEmpleado"], function(
                                    keyTeleonos,
                                    valueTelefonos
                                ) {
                                    if (
                                        value.id_persona ==
                                        valueTelefonos.id_persona
                                    ) {
                                        rows =
                                            rows +
                                            valueTelefonos.tipo_telefono +
                                            ": " +
                                            valueTelefonos.telefono_empleado +
                                            "\n";
                                    }
                                });
                                $.each(response["tipoEmpleados"], function(
                                    keyTipoEmp,
                                    valueTipoEmp
                                ) {
                                    if (
                                        value.id_tipo_empleado ==
                                        valueTipoEmp.id_tipo_empleado
                                    ) {
                                        rows =
                                            rows +
                                            "</td> <td>" +
                                            valueTipoEmp.nombre_puesto +
                                            "</td> ";
                                        $.each(
                                            response["restaurantes"],
                                            function(keyRest, valueRest) {
                                                if (
                                                    valueRest.id_restaurante ==
                                                    value.id_restaurante
                                                ) {
                                                    rows =
                                                        rows +
                                                        "<td>" +
                                                        valueRest.id_restaurante +
                                                        "</td>";
                                                    $.each(
                                                        response["empleados"],
                                                        function(
                                                            keyValue,
                                                            value
                                                        ) {
                                                            if (
                                                                value.id_persona ==
                                                                valuePersona.id_persona
                                                            ) {
                                                                var fechaIn = new Date(
                                                                    value.fecha_ingreso
                                                                );
                                                                var mes =
                                                                    fechaIn.getMonth() +
                                                                    1;
                                                                var fechaDis =
                                                                    +mes.toString() +
                                                                    "/" +
                                                                    fechaIn
                                                                        .getUTCDate()
                                                                        .toString() +
                                                                    "/" +
                                                                    fechaIn
                                                                        .getUTCFullYear()
                                                                        .toString();
                                                                rows =
                                                                    rows +
                                                                    "<td>" +
                                                                    fechaDis +
                                                                    "</td>";
                                                                rows =
                                                                    rows +
                                                                    "<td>" +
                                                                    value.salario_por_hora +
                                                                    "</td>";
                                                            }
                                                        }
                                                    );
                                                }
                                            }
                                        );
                                    }
                                });
                            }
                        });
                    }
                });

                rows = rows + " <td width='200'>";
                rows =
                    rows +
                    "<button type='button' class='btn btn-warning ml-1' onclick='editData(" +
                    value.id_empleado +
                    ")'>Editar</button>";
                rows =
                    rows +
                    "<button type='button' class='btn btn-danger ml-2' onclick='deleteData(" +
                    value.id_empleado +
                    ")'>Eliminar</button>";
                rows = rows + "</td><tr>";
            });
            $("#filter").html(rows);
        }
    });
}

viewData();

function saveData() {
    var id_persona = $("#myid").val();
    var id_ciudad = $("#sel_ciudad").val();
    var direccion_uno = $("#direccionUno").val();
    var nombre = $("#nombreEmpleado").val();
    var correo = $("#correoEmpleado").val();
    var apellido_uno = $("#apellidoUno").val();
    var apellido_dos = $("#apellidoDos").val();
    var fecha_ingreso = $("#sel_fech_ingreso").val();
    var id_tipo_empleado = $("#sel_tipo_emp").val();
    var id_restaurante = $("#idRestaurante").val();
    var salario_por_hora = $("#salarioPorHora").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {
            id_persona: id_persona,
            id_ciudad: id_ciudad,
            direccion_uno: direccion_uno,
            nombre: nombre,
            correo: correo,
            apellido_uno: apellido_uno,
            apellido_dos: apellido_dos,
            fecha_ingreso: fecha_ingreso,
            id_tipo_empleado: id_tipo_empleado,
            id_restaurante: id_restaurante,
            salario_por_hora: salario_por_hora
        },
        url: "empleado",
        success: function(response) {
            agregarTelefonos(telefonosAgregados, id_persona);
            viewData();
            clearData();
            $("#save").show();
            telefonosAgregados = [];
        }
    });
}

function clearData() {
    $("#myid").val("");
    $("#idRestaurante").val("");
    $("#direccionUno").val("");
    $("#nombreEmpleado").val("");
    $("#apellidoUno").val("");
    $("#apellidoDos").val("");
    $("#correoEmpleado").val("");
    $("#numeroTelefono").val("");
    $("#telefonosAgregados").val("");
    $("#sel_TipoTel").val("-");
    $("#sel_tipo_emp").val("-");
    $("#sel_pais_rest").val("-");
    $("#sel_ciudad_rest").val("-");
    $("#sel_dir_rest").val("-");
    $("#sel_ciudad").val("-");
    $("#sel_pais").val("-");
    $("#sel_fech_ingreso").val("");
    $("#salarioPorHora").val("");
}

function viewDataTelefonos($id_persona) {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "telefono",
        success: function(response) {
            var rows = "";
            $.each(response["telefonosEmpleado"], function(key, value) {
                if (value.id_persona == $id_persona) {
                    rows = rows + "<tr>";
                    rows = rows + "<td>" + value.telefono_empleado + "</td>";
                    rows = rows + "<td>" + value.tipo_telefono + "</td>";
                    rows = rows + "<td width='200'>";
                    rows =
                        rows +
                        "<button type='button' class='btn btn-warning ml-1' onclick='editarTelefono(" +
                        value.telefono_empleado +
                        ")'>Editar</button>";
                    rows =
                        rows +
                        "<button type='button' class='btn btn-danger ml-2' onclick='deleteTelefono(" +
                        value.telefono_empleado +
                        ")'>Eliminar</button>";
                    rows = rows + "</td><tr>";
                }
            });
            $("#telefonos").html(rows);
        }
    });
}

function deleteTelefono(telefono_empleado) {
    $.ajax({
        type: "DELETE",
        dataType: "json",
        url: "telefono/" + telefono_empleado,
        success: function(response) {
            viewDataTelefonos($("#myid").val());
            $("#idRestaurante").hide();
        }
    });
}

var idTel = "";
function editarTelefono(id_persona) {
    $("#actualizarTelefono").attr("disabled", false);
    $("#masTelefonos").attr("disabled", true);
    $("#save").hide();
    $("#botonActualizar").show();
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "telefono/" + id_persona + "/edit",
        success: function(response) {
            $("#numeroTelefono").val(response.telefono_empleado);
            idTel = response.telefono_empleado;
            $("#sel_TipoTel").val(response.tipo_telefono);
        }
    });
}

var idLastPersona = "";
function editData(id_empleado) {
    $("#save").hide();
    $("#update").show();
    $("#datatable1").show();
    $("#telefonosAgregados").hide();
    $("#botonAgregarTelefono").hide();
    $("#actualizarTelefono").attr("disabled", true);
    $("#masTelefonos").attr("disabled", false);
    $("#myid").attr("readonly", true);

    $.ajax({
        type: "GET",
        dataType: "json",
        url: "empleado/" + id_empleado + "/edit",
        success: function(response) {
            $("#idRestaurante").val(response["restaurantes"].id_restaurante);
            $("#idDireccion").val(response["direcciones"].id_direccion);
            $("#idEmpleado").val(response["empleados"].id_empleado);
            $("#myid").val(response["personas"].id_persona);
            idLastPersona = response["personas"].id_persona;
            $("#nombreEmpleado").val(response["personas"].nombre);
            $("#apellidoUno").val(response["personas"].apellido_uno);
            $("#apellidoDos").val(response["personas"].apellido_dos);
            $("#correoEmpleado").val(response["personas"].correo);
            $("#direccionUno").val(response["direcciones"].direccion_uno);
            $("#sel_pais").val(response["paises"].id_pais);
            $("#sel_ciudad")
                .val(response["ciudades"].id_ciudad)
                .attr("selected");
            //            $("#telefonosAgregados").val();
            $("#sel_tipo_emp").val(response["tipoEmpleados"].id_tipo_empleado);
            $("#sel_pais_rest").val(response["ciudadRest"].id_pais);
            $("#sel_ciudad_rest").val(response["ciudadRest"].id_ciudad);
            var fechaDeIngreso = new Date(response["empleados"].fecha_ingreso);
            $("#sel_fech_ingreso").val(
                fechaDeIngreso.getFullYear() +
                    "-" +
                    (fechaDeIngreso.getMonth() + 1) +
                    "-" +
                    (fechaDeIngreso.getUTCDate() > 9
                        ? fechaDeIngreso.getUTCDate()
                        : "0" + fechaDeIngreso.getUTCDate())
            );
            $("#salarioPorHora").val(response["empleados"].salario_por_hora);
            viewDataTelefonos(response["personas"].id_persona);
            var idDir = response["dirRest"].direccion_uno;
            cambiaDirRest();
            $("#sel_dir_rest")
                .val(idDir)
                .attr("selected", true);
            $("#botonActualizar").show();
        }
    });
}
function updateData() {
    var id_empleado = $("#idEmpleado").val();
    var id_persona = $("#myid").val();
    var id_ciudad = $("#sel_ciudad").val();
    var id_direccion = $("idDireccion").val();
    var direccion_uno = $("#direccionUno").val();
    var nombre = $("#nombreEmpleado").val();
    var correo = $("#correoEmpleado").val();
    var apellido_uno = $("#apellidoUno").val();
    var apellido_dos = $("#apellidoDos").val();
    var fecha_ingreso = $("#sel_fech_ingreso").val();
    console.log(fecha_ingreso);
    var id_tipo_empleado = $("#sel_tipo_emp").val();
    var id_restaurante = $("#idRestaurante").val();
    var salario_por_hora = $("#salarioPorHora").val();
    $.ajax({
        type: "PUT",
        dataType: "json",
        data: {
            id_direccion: id_direccion,
            id_empleado: id_empleado,
            id_persona: id_persona,
            id_ciudad: id_ciudad,
            direccion_uno: direccion_uno,
            nombre: nombre,
            correo: correo,
            apellido_uno: apellido_uno,
            apellido_dos: apellido_dos,
            fecha_ingreso: fecha_ingreso,
            id_tipo_empleado: id_tipo_empleado,
            id_restaurante: id_restaurante,
            salario_por_hora: salario_por_hora
        },
        url: "empleado/" + idLastPersona,
        success: function(response) {
            viewData();
            clearData();
            $("#save").show();
            $("#update").hide();
            $("#telefonosAgregados").show();
            $("#datatable1").hide();
            $("#botonAgregarTelefono").show();
            $("#botonActualizar").hide();
            $("#myid").attr("readonly", false);
        }
    });
}

function deleteData(id_empleado) {
    $.ajax({
        type: "DELETE",
        dataType: "json",
        url: "empleado/" + id_empleado,
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
                    $("#sel_ciudad")
                        .empty()
                        .append(
                            "<option selected='true' readonly='true' value='-' disabled='true'>Ciudad</option>"
                        );
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

function cambiaCiudadRest() {
    var pais = $("#sel_pais_rest").val();
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
                    $("#sel_ciudad_rest")
                        .empty()
                        .append(
                            "<option selected='true' readonly='true' value='-' disabled='true'>Ciudad</option>"
                        );
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
                            $("#sel_ciudad_rest").append(option);
                        }
                    }
                }
            }
        });
    }
}

function cambiaDirRest() {
    var ciudad = $("#sel_ciudad_rest").val();
    if (ciudad != 0) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "empleado",
            success: function(response) {
                var len = 0;
                if (response["restaurantes"] != null) {
                    len = response["restaurantes"].length;
                    lenDir = response["direcciones"].length;
                }
                if (len > 0) {
                    $("#sel_dir_rest")
                        .empty()
                        .append(
                            "<option readonly='true' value='-' disabled='true'>Direccion</option>"
                        );
                    for (let j = 0; j < len; j++) {
                        for (var i = 0; i < lenDir; i++) {
                            if (
                                response["direcciones"][i].id_ciudad ==
                                    ciudad &&
                                response["restaurantes"][j].id_direccion ==
                                    response["direcciones"][i].id_direccion
                            ) {
                                var id =
                                    response["direcciones"][i].id_direccion;
                                var name =
                                    response["direcciones"][i].direccion_uno;
                                var option =
                                    "<option value='" +
                                    id +
                                    "'>" +
                                    name +
                                    "</option>";
                                $("#sel_dir_rest").append(option);
                            }
                        }
                    }
                }
            }
        });
    }
}

function darIdRest() {
    var dirRest = $("#sel_dir_rest").val();
    if (dirRest != 0) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "empleado",
            success: function(response) {
                var len = 0;
                if (response["restaurantes"] != null) {
                    len = response["restaurantes"].length;
                }
                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                        if (
                            response["restaurantes"][i].id_direccion == dirRest
                        ) {
                            $("#idRestaurante").val(
                                response["restaurantes"][i].id_restaurante
                            );
                        }
                    }
                }
            }
        });
    }
}
var telefonosAgregados = [];
function otroTelefono() {
    var numero_telefono = $("#numeroTelefono").val();
    var tipo_telefono = $("#sel_TipoTel").val();
    var telefono = {
        numero_telefono: numero_telefono,
        tipo_telefono: tipo_telefono
    };
    telefonosAgregados.push(telefono);
    $("#numeroTelefono").val("");
    $("#sel_TipoTel").val("Casa");
    var datos = "";
    $.each(telefonosAgregados, function(key, value) {
        datos =
            datos + value.tipo_telefono + ": " + value.numero_telefono + "\n";
    });

    $("#telefonosAgregados").val(datos);
}
function updateTel() {
    $("#actualizarTelefono").attr("disabled", true);
    $("#masTelefonos").attr("disabled", false);
    var telefono_empleado = $("#numeroTelefono").val();
    var tipo_telefono = $("#sel_TipoTel").val();
    $.ajax({
        type: "PUT",
        dataType: "json",
        data: {
            telefono_empleado: telefono_empleado,
            tipo_telefono: tipo_telefono
        },
        url: "telefono/" + idTel,
        success: function(response) {
            $("#numeroTelefono").val("");
            var id = $("#myid").val();
            viewDataTelefonos(id);
        }
    });
}
function storeTel() {
    var telefono_empleado = $("#numeroTelefono").val();
    var tipo_telefono = $("#sel_TipoTel").val();
    var id_persona = $("#myid").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {
            telefono_empleado: telefono_empleado,
            tipo_telefono: tipo_telefono,
            id_persona: id_persona
        },
        url: "telefono",
        success: function(response) {
            telefonosAgregados = [];
            $("#numeroTelefono").val("");
            viewDataTelefonos(id_persona);
        }
    });
}

function agregarTelefonos(telefonosAgregados, id_persona) {
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {
            telefonosAgregados,
            id_persona: id_persona
        },
        url: "telefono",
        success: function(response) {
            telefonosAgregados = [];
            $("#telefonosAgregados").val("");
        }
    });
}
