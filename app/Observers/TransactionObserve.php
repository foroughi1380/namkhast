<?php

namespace App\Observers;

use App\Models\Challenge;
use App\Models\Contributors;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TransactionObserve
{
    /**
     * Handle the Transaction "created" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "updated" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function updated(Transaction $transaction)
    {
        if ($transaction->status === "paid"){
            switch ($transaction->extras['for']){
                case Challenge::class :
                    $model = Challenge::query()->find($transaction->extras['id']);
                    $model->status = "paid";
                    $model->save();
                    return redirect(route("challenge.index"))->send();

                case Contributors::class:
                    $cont = new Contributors();
                    $cont->user_id = $transaction->extras['user_id'];
                    $cont->challenge_id = $transaction->extras['challenge_id'];
                    $cont->save();
                    return redirect(route("challenge.show" , $transaction->extras['challenge_id']))->send();
                case Wallet::class:
                    $wallet = new Wallet();
                    $wallet->user_id = $transaction->extras['user_id'];
                    $wallet->price = $transaction->extras['price'];
                    $wallet->description = "شارژ حساب کاربری";
                    $wallet->extras = ['transaction_id' => $transaction->id];
                    $wallet->save();
                    return redirect("/")->send();
            }
        }
    }

    /**
     * Handle the Transaction "deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function deleted(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function restored(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function forceDeleted(Transaction $transaction)
    {
        //
    }
}
