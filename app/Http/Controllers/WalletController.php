<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TransferMoney;
use App\User;

class WalletController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\View\View
     *
     */
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
