<?php

namespace GlorifiedKing\Wallet\Test\Models;

use GlorifiedKing\Wallet\Interfaces\Customer;
use GlorifiedKing\Wallet\Interfaces\Discount;
use GlorifiedKing\Wallet\Services\WalletService;

class ItemDiscount extends Item implements Discount
{

    /**
     * @return string
     */
    public function getTable(): string
    {
        return 'items';
    }

    /**
     * @param Customer $customer
     * @return int
     */
    public function getPersonalDiscount(Customer $customer): int
    {
        $wallet = app(WalletService::class)
            ->getWallet($customer);

        return $wallet->holder->id;
    }

}
