<?php

namespace GlorifiedKing\Wallet\Test\Models;

use GlorifiedKing\Wallet\Interfaces\Wallet;
use GlorifiedKing\Wallet\Traits\HasWallet;
use GlorifiedKing\Wallet\Traits\HasWallets;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 *
 * @package GlorifiedKing\Wallet\Test\Models
 * @property string $name
 * @property string $email
 */
class UserMulti extends Model implements Wallet
{
    use HasWallet, HasWallets;

    /**
     * @return string
     */
    public function getTable(): string
    {
        return 'users';
    }
}
