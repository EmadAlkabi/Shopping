<?php


namespace App\Enum;


class OrderState
{
    const REVIEW = 1;
    const ACCEPT = 2;
    const REJECT = 3;

    /**
     * Get all states.
     *
     * @return array
     */
    public static function getStates()
    {
        return array(
            self::REVIEW,
            self::ACCEPT,
            self::REJECT
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
                    case self::REVIEW:
                        return "قيد المراجعة";
                        break;
                    case self::ACCEPT:
                        return "قبول";
                        break;
                    case self::REJECT:
                        return "رفض";
                        break;
                }
                break;
            case Language::ENGLISH:
                switch ($stateNumber) {
                    case self::REVIEW:
                        return "Under Review";
                        break;
                    case self::ACCEPT:
                        return "Accept";
                        break;
                    case self::REJECT:
                        return "Reject";
                        break;
                }
                break;
        }

        return "";
    }
}
