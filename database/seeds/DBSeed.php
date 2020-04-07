<?php

use App\Ciudad;
use App\Combo;
use App\Contacto;
use App\Deducciones;
use App\Deducciones_empleado;
use App\Direccion;
use App\Empleado;
use App\Gerente_pais;
use App\Horas_trabajadas;
use App\Inventario;
use App\Lista_productos;
use App\Lista_proveedores;
use App\Pago_planilla;
use App\Pais;
use App\Persona;
use App\Producto;
use App\Producto_combo;
use App\Proveedor;
use App\Restaurante;
use App\Telefonos_empleado;
use App\Telefonos_restaurante;
use App\Tipo_empleado;
use App\Ventas_diarias;
use App\Ventas_diarias_acompaniamiento;
use App\Ventas_mensuales;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DBSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 11; $i++) {
            $pais = new Pais();
            $pais->nombre_pais = Str::random(10);
            $pais->codigo_pais = Str::random(3);
            $pais->continente_pais = Str::random(10);
            $pais->save();
            $ciudad = new Ciudad();
            $ciudad->nombre_ciudad = Str::random(10);
            $ciudad->id_pais = $i;
            $ciudad->save();
            $direccion = new Direccion();
            $direccion->direccion_uno = Str::random(15);
            $direccion->id_ciudad = $i;
            $direccion->save();
            $persona = new Persona();
            $persona->id_persona = Str::random(10);
            $persona->nombre = Str::random(10);
            $persona->apellido_uno = Str::random(10);
            $persona->apellido_dos = Str::random(10);
            $persona->correo = Str::random(10) . "@correo.com";
            $persona->id_direccion = $i;
            $persona->save();
            $telefonosEmpleado = new Telefonos_empleado();
            $telefonosEmpleado->telefono_empleado = Str::random(10);
            $telefonosEmpleado->id_persona = $persona->id_persona;
            $telefonosEmpleado->tipo_telefono = Str::random(5);
            $telefonosEmpleado->save();
            $tipoEmpleado = new Tipo_empleado();
            $tipoEmpleado->nombre_puesto = Str::random(10);
            $tipoEmpleado->save();
            $restaurante = new Restaurante();
            $restaurante->id_direccion = $i;
            $restaurante->save();
            $empleado = new Empleado();
            $empleado->fecha_ingreso = Carbon::now();
            $empleado->id_persona = $persona->id_persona;
            $empleado->id_tipo_empleado = $i;
            $empleado->id_restaurante = $i;
            $empleado->salario_por_hora = rand(2500, 5000);
            $empleado->save();
            $horasTrabajadas = new Horas_trabajadas();
            $horasTrabajadas->fecha_trabajada = Carbon::now();
            $horasTrabajadas->horas_simples = rand(5, 10);
            $horasTrabajadas->horas_tiempo_medio = rand(5, 10);
            $horasTrabajadas->horas_extra = rand(5, 10);
            $horasTrabajadas->id_empleado = $i;
            $horasTrabajadas->save();
            $deducciones = new Deducciones();
            $deducciones->detalle = Str::random(30);
            $deducciones->porcentaje = rand(5, 15);
            $deducciones->save();
            $deduccionesEmpleado = new Deducciones_empleado();
            $deduccionesEmpleado->deduccion = rand(100000, 300000);
            $deduccionesEmpleado->id_deducciones = $i;
            $deduccionesEmpleado->id_empleado = $i;
            $deduccionesEmpleado->save();
            $pagoPlanilla = new Pago_planilla();
            $pagoPlanilla->fecha_pago = Carbon::now();
            $pagoPlanilla->salario_bruto = rand(400000, 1000000);
            $pagoPlanilla->salario_neto = rand(400000, 1000000);
            $pagoPlanilla->id_empleado = $i;
            $pagoPlanilla->save();
            $gerente = new Gerente_pais();
            $gerente->id_empleado = $i;
            $gerente->id_pais = $i;
            $gerente->salario = rand(800000, 3000000);
            $gerente->save();
            $telefonoLista = new Telefonos_restaurante();
            $telefonoLista->telefono_restaurante = Str::random(10);;
            $telefonoLista->id_restaurante = $i;
            $telefonoLista->save();
            $proveedor = new Proveedor();
            $proveedor->nombre_proveedor = Str::random(10);
            $proveedor->save();
            $contacto = new Contacto();
            $contacto->id_proveedor = $i;
            $contacto->id_persona = $persona->id_persona;
            $contacto->save();
            $listaProveedores = new Lista_proveedores();
            $listaProveedores->id_proveedor = $i;
            $listaProveedores->id_restaurante = $i;
            $listaProveedores->save();
            $produ = new Producto();
            $produ->descripcion_producto = Str::random(40);
            $produ->precio_producto = rand(500, 5000);
            $produ->save();
            $listaProducto = new Lista_productos();
            $listaProducto->id_producto = $i;
            $listaProducto->id_proveedor = $i;
            $listaProducto->costo_producto = rand(500, 5000);
            $listaProducto->save();
            $combo = new Combo();
            $combo->nombre = Str::random(40);
            $combo->precio_combo = rand(500, 5000);
            $combo->save();
            $ventaDiaria = new Ventas_diarias();
            $ventaDiaria->id_combo = $i;
            $ventaDiaria->fecha_venta = Carbon::now();
            $ventaDiaria->save();
            $ventasDiarias = new Ventas_diarias_acompaniamiento();
            $ventasDiarias->id_ventas_diarias = $i;
            $ventasDiarias->id_producto = $i;
            $ventasDiarias->save();
            $productoCombo = new Producto_combo();
            $productoCombo->id_producto = $i;
            $productoCombo->id_combo = $i;
            $productoCombo->precio_combo = rand(3000, 8000);
            $productoCombo->acompaniamiento = false;
            $productoCombo->save();
            $inventario = new Inventario();
            $inventario->cantidad_min = rand(5, 10);
            $inventario->cantidad = rand(0, 50);
            $inventario->id_lista_productos = $i;
            $inventario->id_restaurante = $i;
            $inventario->save();
            $ventasMensuales = new Ventas_mensuales();
            $ventasMensuales->mes = rand(1, 12);
            $ventasMensuales->anio = rand(2018, 2021);
            $ventasMensuales->id_producto = $i;
            $ventasMensuales->id_restaurante = $i;
            $ventasMensuales->cantidad = rand(5, 40);
            $ventasMensuales->save();
        }
    }
}
