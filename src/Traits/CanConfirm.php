<?php

namespace GlorifiedKing\Wallet\Traits;

use GlorifiedKing\Wallet\Exceptions\ConfirmedInvalid;
use GlorifiedKing\Wallet\Exceptions\WalletOwnerInvalid;
use GlorifiedKing\Wallet\Models\Transaction;
use GlorifiedKing\Wallet\Services\CommonService;
use GlorifiedKing\Wallet\Services\DbService;
use GlorifiedKing\Wallet\Services\LockService;
use GlorifiedKing\Wallet\Services\WalletService;

trait CanConfirm
{


    /**
     * @param Transaction $transaction
     * @return bool
     */
    public function confirm(Transaction $transaction): bool
    {
        return app(LockService::class)->lock($this, __FUNCTION__, function () use ($transaction) {
            $self = $this;
            return app(DbService::class)->transaction(static function () use ($self, $transaction) {
                $wallet = app(WalletService::class)
                    ->getWallet($self);

                if (!$wallet->refreshBalance()) {
                    return false;
                }

                if ($transaction->type === Transaction::TYPE_WITHDRAW) {
                    app(CommonService::class)->verifyWithdraw(
                        $wallet,
                        \abs($transaction->amount)
                    );
                }

                return $self->forceConfirm($transaction);
            });
        });
    }

    /**
     * @param Transaction $transaction
     * @return bool
     */
    public function safeConfirm(Transaction $transaction): bool
    {
        try {
            return $this->confirm($transaction);
        } catch (\Throwable $throwable) {
            return false;
        }
    }

    /**
     * @param Transaction $transaction
     * @return bool
     * @throws ConfirmedInvalid
     * @throws WalletOwnerInvalid
     */
    public function forceConfirm(Transaction $transaction): bool
    {
        return app(LockService::class)->lock($this, __FUNCTION__, function () use ($transaction) {
            $self = $this;
            return app(DbService::class)->transaction(static function () use ($self, $transaction) {

                $wallet = app(WalletService::class)
                    ->getWallet($self);

                if ($transaction->confirmed) {
                    throw new ConfirmedInvalid(trans('wallet::errors.confirmed_invalid'));
                }

                if ($wallet->id !== $transaction->wallet_id) {
                    throw new WalletOwnerInvalid(trans('wallet::errors.owner_invalid'));
                }

                return $transaction->update(['confirmed' => true]) &&

                    // update balance
                    app(CommonService::class)
                        ->addBalance($wallet, $transaction->amount);

            });
        });
    }

}
