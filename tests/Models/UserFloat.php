<?php

namespace GlorifiedKing\Wallet\Test\Models;

use GlorifiedKing\Wallet\Interfaces\Wallet;
use GlorifiedKing\Wallet\Interfaces\WalletFloat;
use GlorifiedKing\Wallet\Traits\HasWalletFloat;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserFloat
 *
 * @package GlorifiedKing\Wallet\Test\Models
 * @property string $name
 * @property string $email
 */
class UserFloat extends Model implements Wallet, WalletFloat
{
    use HasWalletFloat;

    /**
     * @var array
     */
    protected $fillable = ['name', 'email'];

    /**
     * @return string
     */
    public function getTable(): string
    {
        return 'users';
    }
}
