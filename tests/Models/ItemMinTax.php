<?php

namespace GlorifiedKing\Wallet\Test\Models;

use GlorifiedKing\Wallet\Interfaces\MinimalTaxable;

class ItemMinTax extends Item implements MinimalTaxable
{

    /**
     * @inheritDoc
     */
    public function getTable(): string
    {
        return 'items';
    }

    /**
     * @inheritDoc
     */
    public function getFeePercent(): float
    {
        return 3;
    }

    /**
     * @return int
     */
    public function getMinimalFee(): int
    {
        return 90;
    }

}
