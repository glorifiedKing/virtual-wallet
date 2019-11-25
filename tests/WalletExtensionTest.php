<?php

namespace GlorifiedKing\Wallet\Test;

use GlorifiedKing\Wallet\Objects\Operation;
use GlorifiedKing\Wallet\Test\Common\Models\Transaction;
use GlorifiedKing\Wallet\Test\Models\Buyer;
use GlorifiedKing\Wallet\Test\Objects;

class WalletExtensionTest extends TestCase
{

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->app->bind(Operation::class, Objects\Operation::class);
    }

    /**
     * @return void
     */
    public function testCustomAttribute(): void
    {
        /**
         * @var Buyer $buyer
         */
        $buyer = factory(Buyer::class)->create();
        $this->assertFalse($buyer->relationLoaded('wallet'));
        $transaction = $buyer->deposit(1000, ['bank_method' => 'VietComBank']);

        $this->assertEquals($transaction->amount, $buyer->balance);
        $this->assertInstanceOf(Transaction::class, $transaction);
        $this->assertEquals('VietComBank', $transaction->bank_method);
    }

    public function testNoCustomAttribute(): void
    {
        /**
         * @var Buyer $buyer
         */
        $buyer = factory(Buyer::class)->create();
        $this->assertFalse($buyer->relationLoaded('wallet'));
        $transaction = $buyer->deposit(1000);

        $this->assertEquals($transaction->amount, $buyer->balance);
        $this->assertInstanceOf(Transaction::class, $transaction);
        $this->assertNull($transaction->bank_method);
    }

}
