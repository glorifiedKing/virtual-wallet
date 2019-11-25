<?php

namespace GlorifiedKing\Wallet\Test;

use GlorifiedKing\Wallet\Interfaces\Rateable;
use GlorifiedKing\Wallet\Objects\Bring;
use GlorifiedKing\Wallet\Objects\Cart;
use GlorifiedKing\Wallet\Objects\EmptyLock;
use GlorifiedKing\Wallet\Objects\Operation;
use GlorifiedKing\Wallet\Services\CommonService;
use GlorifiedKing\Wallet\Services\DbService;
use GlorifiedKing\Wallet\Services\ExchangeService;
use GlorifiedKing\Wallet\Services\LockService;
use GlorifiedKing\Wallet\Services\ProxyService;
use GlorifiedKing\Wallet\Services\WalletService;
use GlorifiedKing\Wallet\Test\Common\Models\Transaction;
use GlorifiedKing\Wallet\Test\Common\Models\Transfer;
use GlorifiedKing\Wallet\Test\Common\Models\Wallet;

class SingletonTest extends TestCase
{

    /**
     * @param string $object
     * @return string
     */
    protected function getRefId(string $object): string
    {
        return spl_object_hash(app($object));
    }

    /**
     * @return void
     */
    public function testBring(): void
    {
        $this->assertNotEquals($this->getRefId(Bring::class), $this->getRefId(Bring::class));
    }

    /**
     * @return void
     */
    public function testCart(): void
    {
        $this->assertNotEquals($this->getRefId(Cart::class), $this->getRefId(Cart::class));
    }

    /**
     * @return void
     */
    public function testEmptyLock(): void
    {
        $this->assertNotEquals($this->getRefId(EmptyLock::class), $this->getRefId(EmptyLock::class));
    }

    /**
     * @return void
     */
    public function testOperation(): void
    {
        $this->assertNotEquals($this->getRefId(Operation::class), $this->getRefId(Operation::class));
    }

    /**
     * @return void
     */
    public function testRateable(): void
    {
        $this->assertEquals($this->getRefId(Rateable::class), $this->getRefId(Rateable::class));
    }

    /**
     * @return void
     */
    public function testTransaction(): void
    {
        $this->assertNotEquals($this->getRefId(Transaction::class), $this->getRefId(Transaction::class));
    }

    /**
     * @return void
     */
    public function testTransfer(): void
    {
        $this->assertNotEquals($this->getRefId(Transfer::class), $this->getRefId(Transfer::class));
    }

    /**
     * @return void
     */
    public function testWallet(): void
    {
        $this->assertNotEquals($this->getRefId(Wallet::class), $this->getRefId(Wallet::class));
    }

    /**
     * @return void
     */
    public function testExchangeService(): void
    {
        $this->assertEquals($this->getRefId(ExchangeService::class), $this->getRefId(ExchangeService::class));
    }

    /**
     * @return void
     */
    public function testCommonService(): void
    {
        $this->assertEquals($this->getRefId(CommonService::class), $this->getRefId(CommonService::class));
    }

    /**
     * @return void
     */
    public function testProxyService(): void
    {
        $this->assertEquals($this->getRefId(ProxyService::class), $this->getRefId(ProxyService::class));
    }

    /**
     * @return void
     */
    public function testWalletService(): void
    {
        $this->assertEquals($this->getRefId(WalletService::class), $this->getRefId(WalletService::class));
    }

    /**
     * @return void
     */
    public function testDbService(): void
    {
        $this->assertEquals($this->getRefId(DbService::class), $this->getRefId(DbService::class));
    }

    /**
     * @return void
     */
    public function testLockService(): void
    {
        $this->assertEquals($this->getRefId(LockService::class), $this->getRefId(LockService::class));
    }

}
