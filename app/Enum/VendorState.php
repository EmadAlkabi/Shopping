<?php


namespace App\Enum;


class VendorState
{
    const ACTIVE = 1;
    const INACTIVE = 2;

    /**
     * Get all states.
     *
     * @return array
     */
    public static function getStates()
    {
        return array(
            self::ACTIVE,
            self::INACTIVE

        );
    }
    /**
     * Get the name of the state.
     *
     * @param $stateNumber
     * @return string
     */
    public static function getStateName($stateNumber)
    {
        $locale = app()->getLocale();
        switch ($locale) {
            case Language::ARABIC:
                switch ($stateNumber) {
                    case self::ACTIVE: return "فعال";
                    case self::INACTIVE:return "غير فعال";
                }
                break;
            case Language::ENGLISH:
                switch ($stateNumber) {
                    case self::ACTIVE:return "Active";
                    case self::INACTIVE:return "Inactive";
                }
                break;
        }

        return "";
    }
}
