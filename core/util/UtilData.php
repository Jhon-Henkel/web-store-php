<?php

namespace core\util;
use DateTime;

class UtilData
{
    public function formatDateUsToBr($date): string
    {
        $format = DateTime::createFromFormat('Y-m-d H:i:s', $date);
        return $format->format('d/m/Y');
    }
}