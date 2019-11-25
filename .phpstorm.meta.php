<?php

namespace PHPSTORM_META {

    use GlorifiedKing\Wallet\Interfaces\Rateable;
    use GlorifiedKing\Wallet\Interfaces\Storable;
    use GlorifiedKing\Wallet\Models\Transaction;
    use GlorifiedKing\Wallet\Models\Transfer;
    use GlorifiedKing\Wallet\Models\Wallet;
    use GlorifiedKing\Wallet\Objects\Bring;
    use GlorifiedKing\Wallet\Objects\Cart;
    use GlorifiedKing\Wallet\Objects\EmptyLock;
    use GlorifiedKing\Wallet\Objects\Operation;
    use GlorifiedKing\Wallet\Services\CommonService;
    use GlorifiedKing\Wallet\Services\ExchangeService;
    use GlorifiedKing\Wallet\Services\ProxyService;
    use GlorifiedKing\Wallet\Services\WalletService;

    override(\app(0), map([
        Cart::class => Cart::class,
        Bring::class => Bring::class,
        Operation::class => Operation::class,
        EmptyLock::class => EmptyLock::class,
        ExchangeService::class => ExchangeService::class,
        CommonService::class => CommonService::class,
        ProxyService::class => ProxyService::class,
        WalletService::class => WalletService::class,
        Wallet::class => Wallet::class,
        Transfer::class => Transfer::class,
        Transaction::class => Transaction::class,
        Rateable::class => Rateable::class,
        Storable::class => Storable::class,
    ]));

}
