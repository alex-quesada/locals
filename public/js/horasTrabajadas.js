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
$("#tituloSeleccioneEmpleado").hide();
$("#seleccionarEmpleado").hide();
$("#tituloFechaYhoras").hide();
$("#fechaYHoras").hide();

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});

function viewData() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "horastrabajadas",
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
            var rows = "";
            $.each(response["horasTrabajadas"], function(key, value) {
                rows = rows + "<tr>";
                rows = rows + "<td>" + value.id_horas_trabajadas + "</td>";
                var lenEmp = response["empleados"].length;
                var lenPersonas = response["personas"].length;
                for (let i = 0; i < lenEmp; i++) {
                    for (let j = 0; j < lenPersonas; j++) {
                        if (
                            response["empleados"][i].id_empleado ==
                                value.id_empleado &&
                            response["personas"][j].id_persona ==
                                response["empleados"][i].id_persona
                        ) {
                            rows =
                                rows +
                                "<td>" +
                                response["personas"][j].nombre +
                                " " +
                                response["personas"][j].apellido_uno +
                                "</td>";
                        }
                    }
                }
                var fechaTrab = new Date(value.fecha_trabajada);
                var mes = fechaTrab.getMonth() + 1;
                var fechaDis =
                    +mes.toString() +
                    "/" +
                    fechaTrab.getUTCDate().toString() +
                    "/" +
                    fechaTrab.getUTCFullYear().toString();
                rows = rows + "<td>" + fechaDis + "</td>";
                rows = rows + "<td>" + value.horas_simples + "</td>";
                rows = rows + "<td>" + value.horas_tiempo_medio + "</td>";
                rows = rows + "<td>" + value.horas_extra + "</td>";
                rows = rows + "<td width='200'>";
                rows =
                    rows +
                    "<button type='button' class='btn btn-warning ml-1' onclick='editData(" +
                    value.id_horas_trabajadas +
                    ")'>Editar</button>";
                rows =
                    rows +
                    "<button type='button' class='btn btn-danger ml-2' onclick='deleteData(" +
                    value.id_horas_trabajadas +
                    ")'>Eliminar</button>";
                rows = rows + "</td><tr>";
            });
            $("tbody").html(rows);
        }
    });
}

viewData();

function saveData() {
    var id_empleado = $("#myid").val();
    var fecha_trabajada = $("#fecha_trabajada").val();
    var horas_simples = $("#horas_simples").val();
    var horas_tiempo_medio = $("#horas_tiempo_medio").val();
    var horas_extra = $("#horas_extra").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {
            id_empleado: id_empleado,
            fecha_trabajada: fecha_trabajada,
            horas_simples: horas_simples,
            horas_tiempo_medio: horas_tiempo_medio,
            horas_extra: horas_extra
        },
        url: "horastrabajadas",
        success: function(response) {
            viewData();
            clearData();
            $("#save").show();
            $("#tituloSeleccioneEmpleado").hide();
            $("#seleccionarEmpleado").hide();
            $("#tituloFechaYhoras").hide();
            $("#fechaYHoras").hide();
        }
    });
}

function clearData() {
    $("#myid").val("");
    $("#idRestaurante").val("");
    $("#sel_pais_rest").val("-");
    $("#sel_ciudad_rest").val("-");
    $("#sel_dir_rest").val("-");
    $("#sel_empleado").val("-");
    $("#fecha_trabajada").val("");
    $("#horas_simples").val("");
    $("#horas_tiempo_medio").val("");
    $("#horas_extra").val("");
}

function editData(id_horas_trabajadas) {
    $("#save").hide();
    $("#update").show();

    $("#tituloSeleccioneEmpleado").hide();
    $("#seleccionarEmpleado").show();
    $("#divSelEmp").hide();
    $("#tituloRest").hide();
    $("#selRestDiv").hide();
    $("#tituloFechaYhoras").show();
    $("#fechaYHoras").show();

    $.ajax({
        type: "GET",
        dataType: "json",
        url: "horastrabajadas/" + id_horas_trabajadas + "/edit",
        success: function(response) {
            $("#id_horas_trabajadas").val(id_horas_trabajadas);
            $("#myid").val(response["horasTrabajadas"].id_empleado);

            var fechaTrabajada = new Date(
                response["horasTrabajadas"].fecha_trabajada
            );
            $("#fecha_trabajada").val(
                fechaTrabajada.getFullYear() +
                    "-" +
                    (fechaTrabajada.getMonth() + 1) +
                    "-" +
                    (fechaTrabajada.getUTCDate() > 9
                        ? fechaTrabajada.getUTCDate()
                        : "0" + fechaTrabajada.getUTCDate())
            );

            $("#horas_simples").val(response["horasTrabajadas"].horas_simples);
            $("#horas_tiempo_medio").val(
                response["horasTrabajadas"].horas_tiempo_medio
            );
            $("#horas_extra").val(response["horasTrabajadas"].horas_extra);
        }
    });
}
function updateData() {
    var id_horas_trabajadas = $("#id_horas_trabajadas").val();
    var id_empleado = $("#myid").val();
    var fecha_trabajada = $("#fecha_trabajada").val();
    var horas_simples = $("#horas_simples").val();
    var horas_tiempo_medio = $("#horas_tiempo_medio").val();
    var horas_extra = $("#horas_extra").val();
    console.log(id_horas_trabajadas);
    $.ajax({
        type: "PUT",
        dataType: "json",
        data: {
            id_empleado: id_empleado,
            fecha_trabajada: fecha_trabajada,
            horas_simples: horas_simples,
            horas_tiempo_medio: horas_tiempo_medio,
            horas_extra: horas_extra
        },
        url: "horastrabajadas/" + id_horas_trabajadas,
        success: function(response) {
            viewData();
            clearData();
            $("#save").show();
            $("#update").hide();
            $("#divSelEmp").show();
            $("#tituloRest").show();
            $("#selRestDiv").show();
            $("#tituloSeleccioneEmpleado").hide();
            $("#seleccionarEmpleado").hide();
            $("#tituloFechaYhoras").hide();
            $("#fechaYHoras").hide();
        }
    });
}

function deleteData(id_horas_trabajadas) {
    $.ajax({
        type: "DELETE",
        dataType: "json",
        url: "horastrabajadas/" + id_horas_trabajadas,
        success: function(response) {
            clearData();
            viewData();
            $("#save").show();
            $("#update").hide();
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
                var restaurante = $("#idRestaurante").val();
                len = 0;
                if (response["empleados"] != null) {
                    len = response["empleados"].length;
                    var lenPer = response["personas"].length;
                }
                if (len > 0) {
                    $("#sel_empleado")
                        .empty()
                        .append(
                            "<option selected='true' readonly='true' value='-' disabled='true'>Empleado</option>"
                        );
                    for (var i = 0; i < len; i++) {
                        for (let j = 0; j < lenPer; j++) {
                            if (
                                response["empleados"][i].id_restaurante ==
                                    restaurante &&
                                response["personas"][j].id_persona ==
                                    response["empleados"][i].id_persona
                            ) {
                                var id = response["empleados"][i].id_empleado;
                                var name =
                                    response["personas"][j].nombre +
                                    " " +
                                    response["personas"][j].apellido_uno;
                                var option =
                                    "<option value='" +
                                    id +
                                    "'>" +
                                    name +
                                    "</option>";
                                $("#sel_empleado").append(option);
                            }
                        }
                    }
                }
            }
        });
    }
    $("#seleccionarEmpleado").show();
    $("#tituloSeleccioneEmpleado").show();
}

function darIdEmpleado() {
    var empleado = $("#sel_empleado").val();
    if (empleado != 0) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "empleado",
            success: function(response) {
                var len = 0;
                if (response["empleados"] != null) {
                    len = response["empleados"].length;
                }
                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                        if (response["empleados"][i].id_empleado == empleado) {
                            $("#myid").val(
                                response["empleados"][i].id_empleado
                            );
                        }
                    }
                }
            }
        });
    }
    $("#tituloFechaYhoras").show();
    $("#fechaYHoras").show();
}
