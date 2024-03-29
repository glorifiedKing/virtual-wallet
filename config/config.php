<?php

use GlorifiedKing\Wallet\Objects\Bring;
use GlorifiedKing\Wallet\Objects\Cart;
use GlorifiedKing\Wallet\Objects\EmptyLock;
use GlorifiedKing\Wallet\Objects\Operation;
use GlorifiedKing\Wallet\Services\ExchangeService;
use GlorifiedKing\Wallet\Services\CommonService;
use GlorifiedKing\Wallet\Services\ProxyService;
use GlorifiedKing\Wallet\Services\WalletService;
use GlorifiedKing\Wallet\Services\LockService;
use GlorifiedKing\Wallet\Models\Transaction;
use GlorifiedKing\Wallet\Models\Transfer;
use GlorifiedKing\Wallet\Models\Wallet;
use GlorifiedKing\Wallet\Simple\Rate;
use GlorifiedKing\Wallet\Simple\Store;

return [
    /**
     * The parameter is used for fast packet overload.
     * You do not need to search for the desired class by code, the library will do it itself.
     */
    'package' => [
        'rateable' => Rate::class,
        'storable' => Store::class,
    ],

    /**
     * Lock settings for highload projects
     *
     * If you want to replace the default cache with another,
     * then write the name of the driver cache in the key `wallet.lock.cache`.
     * @see https://laravel.com/docs/6.x/cache#driver-prerequisites
     *
     * @example
     *  'cache' => 'redis'
     */
    'lock' => [
        'cache' => null,
        'enabled' => false,
        'seconds' => 1,
    ],

    /**
     * Sometimes a slug may not match the currency and you need the ability to add an exception.
     * The main thing is that there are not many exceptions)
     *
     * Syntax:
     *  'slug' => 'currency'
     *
     * @example
     *  'my-usd' => 'USD'
     */
    'currencies' => [],

    /**
     * Services are the main core of the library and sometimes they need to be improved.
     * This configuration will help you to quickly customize the library.
     */
    'services' => [
        'exchange' => ExchangeService::class,
        'common' => CommonService::class,
        'proxy' => ProxyService::class,
        'wallet' => WalletService::class,
        'lock' => LockService::class,
    ],

    'objects' => [
        'bring' => Bring::class,
        'cart' => Cart::class,
        'emptyLock' => EmptyLock::class,
        'operation' => Operation::class,
    ],

    /**
     * Transaction model configuration.
     */
    'transaction' => [
        'table' => 'transactions',
        'model' => Transaction::class,
    ],

    /**
     * Transfer model configuration.
     */
    'transfer' => [
        'table' => 'transfers',
        'model' => Transfer::class,
    ],

    /**
     * Wallet model configuration.
     */
    'wallet' => [
        'table' => 'wallets',
        'model' => Wallet::class,
        'default' => [
            'name' => 'Default Wallet',
            'slug' => 'default',
        ],
    ],
];
