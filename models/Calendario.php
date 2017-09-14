<?php
namespace app\models;

use Yii;

class Calendario
{

    public static function getDayName($string=null)
    {
        // Inicializamos la fecha y hora actual
        $tiempo = time();
        if($string){
            $tiempo = strtotime($string);
        }
        
            $fecha = date('N', $tiempo);
        

        $nombreDia = self::nombreDia($fecha);

        return $nombreDia;
    }

    public static function getDayNumber($string=null)
    {

        $tiempo = time();
        if($string){
            $tiempo = strtotime($string);
        }
        $diaNumero = date('d', $tiempo);

        return $diaNumero;
    }

    public static function getMonthName($string=null)
    {
        // Inicializamos la fecha y hora actual

        $tiempo = time();
        if($string){
            $tiempo = strtotime($string);
        }
        $fecha = date('n', $tiempo);
        $nombreMes = self::nombreMes($fecha);

        return $nombreMes;

    }

    public static function getYearLastDigit($string=null)
    {

        $tiempo = time();
        if($string){
            $tiempo = strtotime($string);
        }
        $fecha = date('y', $tiempo);

        return $fecha;
    }

    public static function getDateComplete($string){
        $dia = self::getDayNumber($string);
        $mes = self::getMonthName($string);
        $anio = self::getYearLastDigit($string);

        return $dia." - ".$mes." - ".$anio;
    }

    public static function nombreMes($fecha)
    {
        $nombreMes = '';
        switch ($fecha) {
            case '1' :
                $nombreMes = 'Enero';
                break;
            case '2' :
                $nombreMes = 'Febrero';
                break;
            case '3' :
                $nombreMes = 'Marzo';
                break;
            case '4' :
                $nombreMes = 'Abril';
                break;
            case '5' :
                $nombreMes = 'Mayo';
                break;
            case '6' :
                $nombreMes = 'Junio';
                break;
            case '7' :
                $nombreMes = 'Julio';
                break;
            case '8' :
                $nombreMes = 'Agosto';
                break;
            case '9' :
                $nombreMes = 'Septiembre';
                break;
            case '10' :
                $nombreMes = 'Octubre';
                break;
            case '11' :
                $nombreMes = 'Noviembre';
                break;
            case '12' :
                $nombreMes = 'Diciembre';
                break;
            default :
                # code...
                break;
        }

        return $nombreMes;
    }

    public static function nombreDia($fecha)
    {
        $dayName = '';
        switch ($fecha) {
            case '1' :
                $dayName = 'Lunes';
                break;
            case '2' :
                $dayName = 'Martes';
                break;
            case '3' :
                $dayName = 'Miércoles';
                break;
            case '4' :
                $dayName = 'Jueves';
                break;
            case '5' :
                $dayName = 'Viernes';
                break;
            case '6' :
                $dayName = 'Sábado';
                break;
            case '7' :
                $dayName = 'Domingo';
                break;

        }

        return $dayName;
    }
}