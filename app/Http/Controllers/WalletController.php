<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\TransferMoney;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class WalletController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function page()
    {
        return view('wallet');
    }

    /**
     * @param  \App\Http\Requests\TransferMoney
     * @return \Illuminate\Http\JsonResponse
     */
    public function transfer(TransferMoney $request)
    {
        $amount = (int) $request->amount;
        $from = $request->user();
        $to = User::where('name', $request->targetUser)->first();

        $from->withdraw($amount);
        $to->deposit($amount);

        $request->session()->flash('info', "Transferred " . currency($amount) . " from $from->name to $to->name.");

        return redirect()->back();
    }
}
