<?php

namespace GlorifiedKing\Wallet\Interfaces;

use GlorifiedKing\Wallet\Models\Transfer;

interface Exchangeable
{
    /**
     * @param Wallet $to
     * @param int $amount
     * @param array|null $meta
     * @return Transfer
     */
    public function exchange(Wallet $to, int $amount, ?array $meta = null): Transfer;

    /**
     * @param Wallet $to
     * @param int $amount
     * @param array|null $meta
     * @return Transfer|null
     */
    public function safeExchange(Wallet $to, int $amount, ?array $meta = null): ?Transfer;

    /**
     * @param Wallet $to
     * @param int $amount
     * @param array|null $meta
     * @return Transfer
     */
    public function forceExchange(Wallet $to, int $amount, ?array $meta = null): Transfer;
}
