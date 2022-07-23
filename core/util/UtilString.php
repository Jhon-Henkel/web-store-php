<?php
namespace core\util;

class UtilString
{
    public function formatPrice($price): string
    {
        return'R$ ' . number_format($price, 2, ',', '.');
    }
}