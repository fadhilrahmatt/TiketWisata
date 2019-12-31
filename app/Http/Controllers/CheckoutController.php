<?php

namespace App\Http\Controllers;

use App\TourPackage;
use App\Transaction;
use App\TransactionDetail;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request, $id)
    {
        $item = Transaction::with(['details','tour_package','user'])->findOrFail($id);

        return view('pages.checkout', [
            'item' => $item
        ]);
    }

    public function process(Request $request, $id){
        $tour_package = TourPackage::findOrFail($id);

        $transaction = Transaction::create([
            'tour_packages_id' => $id,
            'users_id' => Auth::user()->id,
            'transaction_total' => $tour_package->price,
            'transaction_status' => 'IN_CART'
        ]);

        TransactionDetail::create([
            'transactions_id' => $transaction->id,
            'username' => Auth::user()->username,
            'region' => $transaction_details->region,
            'no_hp' =>  $transaction_details->no_hp,
        ]);

        return redirect()->route('checkout', $transaction->id);
    }

    public function remove(Request $request, $detail_id){
        $item = TransactionDetail::findOrFail($detail_id);

        $transaction = Transaction::with(['details','tour_package'])
            ->findOrFail($item->transactions_id);

        // if($item->no_hp){
        //     $transaction->transaction_total -= 190;
        // }

        // $transaction->transaction_total -= 
        //     $transaction->tour_package->price;

        $transaction->save();
        $item->delete();

        return redirect()->route('checkout', $item->transactions_id);
    }

    public function create(Request $request, $id){
        $request->validate([
            'username' => 'required|string|exists:users, username',
            'no_hp' => 'required|string',
        ]);

        $data = $request->all();
        $data['transactions_id'] = $id;

        TransactionDetail::create($data);

        $transaction = Transaction::with(['tour_package'])->find($id);

        // if($request->no_hp){
        //     $transaction->transaction_total += 190;
        // }

        // $transaction->transaction_total += 
        //     $transaction->tour_package->price;

        $transaction->save();

        return redirect()->route('checkout', $id);
    }

    public function success(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->transaction_status = 'PENDING';

        $transaction->save();
        return view('pages.success');
    }
}
