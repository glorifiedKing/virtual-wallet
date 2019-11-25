<?php

namespace GlorifiedKing\Wallet\Services;

use GlorifiedKing\Wallet\Interfaces\Rateable;
use GlorifiedKing\Wallet\Interfaces\Wallet;

class ExchangeService
{

    /**
     * @param Wallet $from
     * @param Wallet $to
     * @return float
     */
    public function rate(Wallet $from, Wallet $to): float
    {
        return app(Rateable::class)
            ->withAmount(1)
            ->withCurrency($from)
            ->convertTo($to);
    }

}
