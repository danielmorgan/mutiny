<?php

namespace App;

trait HasWallet
{
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
