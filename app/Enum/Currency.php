<?php


namespace App\Enum;


class Currency
{
    const IQD = "IQD";
    const USD = "USD";

    /**
     * Get all currencies.
     *
     * @return array
     */
    public static function getCurrencies()
    {
        return array(
            self::IQD,
            self::USD
        );
    }

    /**
     * Get the name of the currency.
     *
     * @param $currency
     * @return string
     */
    public static function getCurrencyName($currency)
    {
        switch ($currency){
            case self::IQD:  return "دينار العراقي"; break;
            case self::USD: return "دولار الامريكي"; break;
        }

        return "";
    }
}
