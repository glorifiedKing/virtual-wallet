<?php

namespace GlorifiedKing\Wallet\Test\Models;

use GlorifiedKing\Wallet\Interfaces\Customer;
use GlorifiedKing\Wallet\Interfaces\Product;
use GlorifiedKing\Wallet\Services\WalletService;
use GlorifiedKing\Wallet\Test\Common\Models\Wallet;
use GlorifiedKing\Wallet\Traits\HasWallet;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 *
 * @package GlorifiedKing\Wallet\Test\Models
 * @property string $name
 * @property int $quantity
 * @property int $price
 */
class Item extends Model implements Product
{
    use HasWallet;

    /**
     * @var array
     */
    protected $fillable = ['name', 'quantity', 'price'];

    /**
     * @param Customer $customer
     * @param int $quantity
     * @param bool $force
     *
     * @return bool
     */
    public function canBuy(Customer $customer, int $quantity = 1, bool $force = null): bool
    {
        $result = $this->quantity >= $quantity;

        if ($force) {
            return $result;
        }

        return $result && !$customer->paid($this);
    }

    /**
     * @param Customer $customer
     * @return int
     */
    public function getAmountProduct(Customer $customer): int
    {
        /**
         * @var Wallet $wallet
         */
        $wallet = app(WalletService::class)->getWallet($customer);
        return $this->price + $wallet->holder_id;
    }

    /**
     * @return array|null
     */
    public function getMetaProduct(): ?array
    {
        return null;
    }

    /**
     * @return string
     */
    public function getUniqueId(): string
    {
        return $this->getKey();
    }
}
