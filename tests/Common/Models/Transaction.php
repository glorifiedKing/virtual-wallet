<?php

namespace GlorifiedKing\Wallet\Test\Common\Models;

/**
 * Class Transaction
 * @package GlorifiedKing\Wallet\Test\Common\Models
 * @property null|string $bank_method
 */
class Transaction extends \GlorifiedKing\Wallet\Models\Transaction
{

    /**
     * @inheritDoc
     */
    public function getFillable(): array
    {
        return array_merge($this->fillable, [
            'bank_method',
        ]);
    }

}
