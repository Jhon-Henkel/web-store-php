<?php
namespace core\util;

class UtilString
{
    public function formatPrice($price): string
    {
        return'R$ ' . number_format($price, 2, ',', '.');
    }

    public function getStatusString($status): string
    {
        switch ($status) {
            case ORDER_PENDENTE:
                return 'Pendente';
            case ORDER_PAGO:
                return 'Pago';
            case ORDER_FATURADO:
                return 'Faturado';
            case ORDER_ENVIADO:
                return 'Enviado';
            case ORDER_ENTREGUE:
                return 'Entregue';
            case ORDER_CANCELADO:
                return 'Cancelado';
        }
        return 'Status não definido';
    }
}