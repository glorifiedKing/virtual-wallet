<?php

namespace GlorifiedKing\Wallet;

use GlorifiedKing\Wallet\Commands\RefreshBalance;
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
use GlorifiedKing\Wallet\Services\DbService;
use GlorifiedKing\Wallet\Services\ExchangeService;
use GlorifiedKing\Wallet\Services\LockService;
use GlorifiedKing\Wallet\Services\ProxyService;
use GlorifiedKing\Wallet\Services\WalletService;
use GlorifiedKing\Wallet\Simple\Rate;
use GlorifiedKing\Wallet\Simple\Store;
use Illuminate\Support\ServiceProvider;
use function config;
use function dirname;
use function function_exists;

class WalletServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     * @codeCoverageIgnore
     */
    public function boot(): void
    {
        $this->loadTranslationsFrom(
            dirname(__DIR__) . '/resources/lang',
            'wallet'
        );

        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->commands([RefreshBalance::class]);

        $this->loadMigrationsFrom([
            __DIR__ . '/../database/migrations_v1',
            __DIR__ . '/../database/migrations_v2',
        ]);

        if (function_exists('config_path')) {
            $this->publishes([
                dirname(__DIR__) . '/config/config.php' => config_path('wallet.php'),
            ], 'laravel-wallet-config');
        }

        $this->publishes([
            dirname(__DIR__) . '/database/migrations_v1/' => database_path('migrations'),
            dirname(__DIR__) . '/database/migrations_v2/' => database_path('migrations'),
        ], 'laravel-wallet-migrations');

        $this->publishes([
            dirname(__DIR__) . '/database/migrations_v1/' => database_path('migrations'),
        ], 'laravel-wallet-migrations-v1');

        $this->publishes([
            dirname(__DIR__) . '/database/migrations_v2/' => database_path('migrations'),
        ], 'laravel-wallet-migrations-v2');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/config/config.php',
            'wallet'
        );

        // Bind eloquent models to IoC container
        $this->app->singleton(Rateable::class, config('wallet.package.rateable', Rate::class));
        $this->app->singleton(Storable::class, config('wallet.package.storable', Store::class));
        $this->app->singleton(DbService::class, config('wallet.services.db', DbService::class));
        $this->app->singleton(ExchangeService::class, config('wallet.services.exchange', ExchangeService::class));
        $this->app->singleton(CommonService::class, config('wallet.services.common', CommonService::class));
        $this->app->singleton(ProxyService::class, config('wallet.services.proxy', ProxyService::class));
        $this->app->singleton(WalletService::class, config('wallet.services.wallet', WalletService::class));
        $this->app->singleton(LockService::class, config('wallet.services.lock', LockService::class));

        // models
        $this->app->bind(Transaction::class, config('wallet.transaction.model', Transaction::class));
        $this->app->bind(Transfer::class, config('wallet.transfer.model', Transfer::class));
        $this->app->bind(Wallet::class, config('wallet.wallet.model', Wallet::class));

        // object's
        $this->app->bind(Bring::class, config('wallet.objects.bring', Bring::class));
        $this->app->bind(Cart::class, config('wallet.objects.cart', Cart::class));
        $this->app->bind(EmptyLock::class, config('wallet.objects.emptyLock', EmptyLock::class));
        $this->app->bind(Operation::class, config('wallet.objects.operation', Operation::class));
    }

}
