<?php


namespace App\Enum;


class Language
{
    const ARABIC = "ar";
    const ENGLISH = "en";

    /**
     * Get all languages.
     *
     * @return array
     */
    public static function getLanguages()
    {
        return array(
            self::ARABIC,
            self::ENGLISH
        );
    }

    /**
     * Get the name of the language.
     *
     * @param $locale
     * @return string
     */
    public static function getLanguageName($locale)
    {
        switch ($locale){
            case self::ARABIC:  return "العربية"; break;
            case self::ENGLISH: return "English"; break;
        }

        return "";
    }

    /**
     * Get the random language.
     *
     * @return string
     */
    public static function getRandomLanguage()
    {
        $languages = self::getLanguages();
        return (string)$languages[array_rand($languages)];
    }
}
