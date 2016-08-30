<?php

namespace App;

use App\Exceptions\WalletBalanceIsNegativeException;

trait HasWallet
{
    /**
     * Lifecycle hooks.
     */
    public static function bootHasWallet()
    {
        static::updating(function($model) {
            // Ensure wallet balance can't drop below 0
            if ($model->balance < 0) {
                throw new WalletBalanceIsNegativeException;
            }
        });
    }

    /**
     * @param  int
     */
    public function deposit($amount)
    {
        $this->balance += $amount;
        $this->save();
    }

    /**
     * @param  int
     */
    public function withdraw($amount)
    {
        $this->balance -= $amount;
        $this->save();
    }
}
