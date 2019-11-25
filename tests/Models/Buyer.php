<?php

namespace GlorifiedKing\Wallet\Test\Models;

use GlorifiedKing\Wallet\Interfaces\Customer;
use GlorifiedKing\Wallet\Traits\CanPay;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 *
 * @package GlorifiedKing\Wallet\Test\Models
 * @property string $name
 * @property string $email
 */
class Buyer extends Model implements Customer
{
    use CanPay;

    /**
     * @return string
     */
    public function getTable(): string
    {
        return 'users';
    }
}
