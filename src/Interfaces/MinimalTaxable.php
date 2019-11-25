<?php

namespace GlorifiedKing\Wallet\Interfaces;

interface MinimalTaxable extends Taxable
{
    /**
     * @return int
     */
    public function getMinimalFee(): int;
}
