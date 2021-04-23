<?php
// namespace App\Helpers;


// class Helper{
 
    if (! function_exists('listar_grupos')) {
        // public static function obtener_grupos()
        function listar_grupos()
        {
            return \App\Models\Grupo::all();
        }
}
if (! function_exists('listar_alumnos')) {
    // public static function obtener_grupos()
    function listar_alumnos()
    {
        return \App\Models\alumnos::all();
    }
}
if (! function_exists('listar_asignaturas')) {
    // public static function obtener_grupos()
    function listar_asignaturas()
    {
        return \App\Models\Asignatura::all();
    }
}