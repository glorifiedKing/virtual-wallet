<?php

namespace GlorifiedKing\Wallet\Simple;

use GlorifiedKing\Wallet\Interfaces\Rateable;
use GlorifiedKing\Wallet\Interfaces\Wallet;

/**
 * Class Rate
 * @package GlorifiedKing\Wallet\Simple
 */
class Rate implements Rateable
{

    /**
     * @var int
     */
    protected $amount;

    /**
     * @var Wallet|\GlorifiedKing\Wallet\Models\Wallet
     */
    protected $withCurrency;

    /**
     * @inheritDoc
     */
    public function withAmount(int $amount): Rateable
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function withCurrency(Wallet $wallet): Rateable
    {
        $this->withCurrency = $wallet;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function convertTo(Wallet $wallet): float
    {
        return $this->amount;
    }

}
