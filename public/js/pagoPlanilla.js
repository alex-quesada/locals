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
$("#tituloInfoPago").hide();
$("#datosDePagoDiv").hide();
$("#tituloDeducciones").hide();
$("#deducciones").hide();
$("#datosDeSalariosBN").hide();

tituloDeducciones;

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});

function viewData() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "pagoplanilla",
        success: function(response) {
            var len = 0;
            if (response["paises"] != null) {
                len = response["paises"].length;
            }
            if (len > 0) {
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
                    $("#sel_pais_rest").append(option);
                }
            }
            var rows = "";
            $.each(response["pagoPlanillas"], function(key, value) {
                rows = rows + "<tr>";
                rows = rows + "<td>" + value.id_pago_planilla + "</td>";
                var fechaPago = new Date(value.fecha_pago);
                var mes = fechaPago.getMonth() + 1;
                var fechaPa =
                    +mes.toString() +
                    "/" +
                    fechaPago.getUTCDate().toString() +
                    "/" +
                    fechaPago.getUTCFullYear().toString();
                rows = rows + "<td>" + fechaPa + "</td>";
                rows = rows + "<td>" + value.salario_bruto + "</td>";
                rows = rows + "<td>" + value.salario_neto + "</td>";
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

                rows = rows + "</td><tr>";
            });
            $("tbody").html(rows);
        }
    });
}

viewData();

function saveData() {
    var fecha_pago = $("#fecha_pago").val();
    var salario_bruto = $("#salario_bruto").val();
    var salario_neto = $("#salario_neto").val();
    var id_empleado = $("#myid").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {
            id_empleado: id_empleado,
            fecha_pago: fecha_pago,
            salario_bruto: salario_bruto,
            salario_neto: salario_neto,
            deduccionesTotales: deduccionesTotales
        },
        url: "pagoplanilla",
        success: function(response) {
            viewData();
            clearData();
            $("#save").show();
            $("#tituloSeleccioneEmpleado").hide();
            $("#seleccionarEmpleado").hide();
            $("#tituloFechaYhoras").hide();
            $("#fechaYHoras").hide();
            $("#tituloSeleccioneEmpleado").hide();
            $("#seleccionarEmpleado").hide();
            $("#tituloFechaYhoras").hide();
            $("#fechaYHoras").hide();
            $("#tituloInfoPago").hide();
            $("#datosDePagoDiv").hide();
            $("#tituloDeducciones").hide();
            $("#deducciones").hide();
            $("#datosDeSalariosBN").hide();
            deduccionesTotales = [];
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
    $("#fecha_inicio").val("-");
    $("#fecha_final").val("-");
    $("#fecha_pago").val("-");
    $("#salario_bruto").val("");
    $("#salario_neto").val("");
    $("#porcentaje").val("");
    $("#detalle").val("");
}

function deleteData(id_pago_planilla) {
    $.ajax({
        type: "DELETE",
        dataType: "json",
        url: "pagoplanilla/" + id_pago_planilla,
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
    $("#sel_empleado")
        .empty()
        .append(
            "<option selected='true' readonly='true' value='-' disabled='true'>Empleado</option>"
        );
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
                            $("#salarioPorHora").val(
                                response["empleados"][i].salario_por_hora
                            );
                        }
                    }
                }
            }
        });
    }
    $("#tituloInfoPago").show();
    $("#datosDePagoDiv").show();
    $("#tituloDeducciones").show();
    $("#datosDeSalariosBN").show();
    $("#deducciones").show();
}

function calcularSalario() {
    var idEmpleado = $("#myid").val();
    var salPorHora = $("#salarioPorHora").val();
    var salTiempoYMedio = salPorHora * 1.5;
    var salarioBruto = 0;
    var fechaInicio = new Date($("#fecha_inicio").val());
    fechaInicio.setDate(fechaInicio.getUTCDate());
    var fechaFin = new Date($("#fecha_final").val());
    fechaFin.setDate(fechaFin.getUTCDate());
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "horastrabajadas",
        success: function(response) {
            var len = 0;
            if (response["horasTrabajadas"] != null) {
                len = response["horasTrabajadas"].length;
            }
            if (len > 0) {
                for (var i = 0; i < len; i++) {
                    if (
                        response["horasTrabajadas"][i].id_empleado == idEmpleado
                    ) {
                        var fechaTrabajada = new Date(
                            response["horasTrabajadas"][i].fecha_trabajada
                        );
                        if (
                            fechaTrabajada >= fechaInicio &&
                            fechaTrabajada <= fechaFin
                        ) {
                            var montoHorasSimples =
                                response["horasTrabajadas"][i].horas_simples *
                                salPorHora;
                            var montoHorasTiempoYMedio =
                                response["horasTrabajadas"][i]
                                    .horas_tiempo_medio * salTiempoYMedio;
                            salarioBruto =
                                salarioBruto +
                                montoHorasSimples +
                                montoHorasTiempoYMedio;
                        }
                    }
                }
                $("#salario_bruto").val(salarioBruto);
                $("#salario_neto").val(salarioBruto);
                // $("#calcSal").attr("disabled", true);
            }
        }
    });
}

var deduccionesTotales = [];
function deducciones() {
    var porcentaje = $("#porcentaje").val();
    var porcentajeD = porcentaje / 100;
    var detalleDeducion = $("#detalle").val();
    var salarioBruto = $("#salario_bruto").val();
    var montoDeduccion = salarioBruto * porcentajeD;
    var deduccion = {
        porcentaje: porcentaje,
        detalle: detalleDeducion,
        deduccion: montoDeduccion
    };
    deduccionesTotales.push(deduccion);

    $("#salario_neto").val($("#salario_neto").val() - montoDeduccion);
    $("#porcentaje").val("");
    $("#detalle").val("");
}
