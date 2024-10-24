<?php
interface IEmpleado
{
    public function CrearEmpleado($empleado);
    public function actualizarEmpleado($empleado);
    public function borrarEmpleado($idempleado);
    public function obtenerEmpleados();
    public function obtenerEmpleadosPorNombre($nombre);
    public function obtenerEmpleadosPorRol($rol);
}
?>