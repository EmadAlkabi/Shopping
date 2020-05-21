<?php


namespace App\Enum;


class Unit
{
    const PIECE = 1;

    /**
     * Get all units.
     *
     * @return array
     */
    public static function getUnits()
    {
        return array(
            self::PIECE
        );
    }

    /**
     * Get the name of the unit.
     *
     * @param $unit
     * @return string
     */
    public static function getUnitName($unit)
    {
        switch ($unit){
            case self::PIECE:  return "قطعة"; break;
        }

        return "";
    }
}
