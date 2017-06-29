<?php

/**
 * Created by PhpStorm.
 * User: Lucien
 * Date: 26/06/2017
 * Time: 11:42
 */
class DateTransform
{
    public static function TransformToString($datetime)
    {
        $d = new DateTime($datetime);
        $d = $d->format("Y-m-d H:i:s");
        list($date, $time) = explode(' ', $d);
        list($year, $mouth, $day) = explode('-', $date);
        list($hour, $minute, $seconde) = explode(':', $time);
        $mouthString = self::GetMouthFrench($mouth);
        return $day.' '.$mouthString.' '.$year.' à '.$hour.'h'.$minute;
    }

    private static function GetMouthFrench($mouth)
    {
        switch ($mouth){
            case "1":
                return "Janvier";
            case "2":
                return "Février";
            case "3":
                return "Mars";
            case "4":
                return "Avril";
            case "5":
                return "Mai";
            case "6":
                return "Juin";
            case "7":
                return "Juillet";
            case "8":
                return "Aout";
            case "9":
                return "Septembre";
            case "10":
                return "Octobre";
            case "11":
                return "Novembre";
            case "12":
                return "Décembre";
        }
    }
}