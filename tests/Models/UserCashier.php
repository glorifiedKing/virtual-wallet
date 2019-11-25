<?php

namespace GlorifiedKing\Wallet\Test\Models;

use GlorifiedKing\Wallet\Traits\HasWallets;
use GlorifiedKing\Wallet\Traits\MorphOneWallet;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

/**
 * Class User
 *
 * @package GlorifiedKing\Wallet\Test\Models
 * @property string $name
 * @property string $email
 */
class UserCashier extends Model
{
    use Billable, HasWallets, MorphOneWallet;

    /**
     * @return string
     */
    public function getTable(): string
    {
        return 'users';
    }
}
