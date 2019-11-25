<?php

namespace GlorifiedKing\Wallet\Test\Common;

use GlorifiedKing\Wallet\Interfaces\Wallet;
use GlorifiedKing\Wallet\Services\WalletService;
use Illuminate\Support\Arr;

class Rate extends \GlorifiedKing\Wallet\Simple\Rate
{

    /**
     * @var array
     */
    protected $rates = [
        'USD' => [
            'RUB' => 67.61,
        ],
    ];

    /**
     * Rate constructor.
     */
    public function __construct()
    {
        foreach ($this->rates as $from => $rates) {
            foreach ($rates as $to => $rate) {
                if (empty($this->rates[$to][$from])) {
                    $this->rates[$to][$from] = 1 / $rate;
                }
            }
        }
    }

    /**
     * @param Wallet $wallet
     * @return float
     */
    protected function rate(Wallet $wallet): float
    {
        $from = app(WalletService::class)->getWallet($this->withCurrency);
        $to = app(WalletService::class)->getWallet($wallet);

        /**
         * @var \GlorifiedKing\Wallet\Models\Wallet $wallet
         */
        return Arr::get(
            Arr::get($this->rates, $from->currency, []),
            $to->currency,
            1
        );
    }

    /**
     * @inheritDoc
     */
    public function convertTo(Wallet $wallet): float
    {
        return parent::convertTo($wallet) * $this->rate($wallet);
    }

}
