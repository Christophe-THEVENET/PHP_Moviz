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
        $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::MEDIUM, IntlDateFormatter::SHORT);
        return $formatter->format($dateTimestamp);
    }
}
