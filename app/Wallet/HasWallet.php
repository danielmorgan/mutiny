<?php

namespace App\Wallet;

use App\Exceptions\WalletBalanceIsNegativeException;

trait HasWallet
{
    /*
    |--------------------------------------------------------------------------
    | Observers
    |--------------------------------------------------------------------------
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


    /*
    |--------------------------------------------------------------------------
    | Domain specific methods
    |--------------------------------------------------------------------------
    */

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
