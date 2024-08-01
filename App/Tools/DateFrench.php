<?php

namespace App\Tools;

use IntlDateFormatter;

class DateFrench
{
    // ******************* formater les dates en français ******************************
    public static function  formatDateInFrench($date)
    {
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR@euro', 'fr_FR.utf8', 'fr-FR', 'fra');
        date_default_timezone_set('Europe/Paris');
        // converti la date en timestamp
        $dateTimestamp = strtotime($date);
        // pour avoir les dates en français avec l objet Intl
        $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::MEDIUM, IntlDateFormatter::NONE);
        return $formatter->format($dateTimestamp);
    }
    // ******************* formater les dates en français dans admin ******************************
    public static function  formatDateAdimInFrench($date)
    {
        setlocale(LC_TIME, 'fr',
            'fr_FR',
            'fr_FR@euro',
            'fr_FR.utf8',
            'fr-FR',
            'fra'
        );
        date_default_timezone_set('Europe/Paris');
        // converti la date en timestamp
        $dateTimestamp = strtotime($date);
        // pour avoir les dates en français avec l objet Intl
        $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::SHORT, IntlDateFormatter::NONE);
        return $formatter->format($dateTimestamp);
    }
    // ******************* formater heures en français ******************************
    public static function  formatHourInFrench($date)
    {
        setlocale(LC_TIME, 'fr',
            'fr_FR',
            'fr_FR@euro',
            'fr_FR.utf8',
            'fr-FR',
            'fra'
        );
        date_default_timezone_set('Europe/Paris');
        // converti la date en timestamp
        $dateTimestamp = strtotime($date);
        // pour avoir les dates en français avec l objet Intl
        $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::NONE, IntlDateFormatter::SHORT);
        return $formatter->format($dateTimestamp);
    }
}
