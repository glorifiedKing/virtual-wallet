<?php

namespace GlorifiedKing\Wallet\Test\Models;

use GlorifiedKing\Wallet\Interfaces\Wallet;
use GlorifiedKing\Wallet\Traits\HasWallet;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 *
 * @package GlorifiedKing\Wallet\Test\Models
 * @property string $name
 * @property string $email
 */
class User extends Model implements Wallet
{
    use HasWallet;

    /**
     * @var array
     */
    protected $fillable = ['name', 'email'];
}
