<?php

namespace GlorifiedKing\Wallet\Test\Models;

use GlorifiedKing\Wallet\Interfaces\Confirmable;
use GlorifiedKing\Wallet\Interfaces\Wallet;
use GlorifiedKing\Wallet\Traits\CanConfirm;
use GlorifiedKing\Wallet\Traits\HasWallet;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserConfirm
 *
 * @package GlorifiedKing\Wallet\Test\Models
 * @property string $name
 * @property string $email
 */
class UserConfirm extends Model implements Wallet, Confirmable
{
    use HasWallet, CanConfirm;

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
