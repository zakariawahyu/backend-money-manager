<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Category;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::all();

        if(empty($transactions)) {
            return response()->json([
                "message" => "Data Not Found",
                "status" => "error",
            ], 404);
        }

        return response()->json([
            "message" => "Success get all data",
            "status" => "succes",
            "data" => $transactions
        ], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJoin(Request $request)
    {
        if (!empty($request->transaction_type)) {
            $idTrsansactiontype = $request->transaction_type;
            $transactions = Transaction::with(['wallet', 'category', 'category.transactiontype'])->whereHas('category.transactiontype', function($q) use($idTrsansactiontype){
                $q->where('id', $idTrsansactiontype);
            })->get();
        }else if(!empty($request->wallet)) {
            $idWallet = $request->wallet;
            $transactions = Transaction::with(['wallet', 'category', 'category.transactiontype'])->whereHas('wallet', function($q) use($idWallet){
                $q->where('id', $idWallet);
            })->get();
        } else{
            $transactions = Transaction::with(['wallet', 'category', 'category.transactiontype'])->get();
        }

        if(empty($transactions)) {
            return response()->json([
                "message" => "Data Not Found",
                "status" => "error",
            ], 404);
        }

        return response()->json([
            "message" => "Success get all data",
            "status" => "succes",
            "data" => $transactions
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_category' => 'required',
            'id_wallet' => 'required',
            'date' => 'required',
            'note' => 'required',
            'amount' => 'required',
        ]);

        $transaction = new Transaction();
        $transaction->id_category = $request->input('id_category');
        $transaction->id_wallet = $request->input('id_wallet');
        $transaction->date = $request->input('date');
        $transaction->note = $request->input('note');
        $transaction->amount = $request->input('amount');


        $category = Category::find($request->input('id_category'));
        $wallet = Wallet::find($request->input('id_wallet'));
        $balance = $wallet['balance'];

        if ($category['id_transaction_type'] == 1) {
            $wallet->balance = $balance + $request->input('amount');
        } else{
            $wallet->balance = $balance - $request->input('amount');
        }

        $wallet->save();
        $transaction->save();

        return response()->json([
            "message" => "Success Added",
            "status" => "success",
            "data" => [
                "attributes" => $transaction
            ]
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::find($id);

        if(!$transaction) {
            return response()->json([
                "message" => "Data Not Found",
                "status" => "error"
            ], 404);
        }

        return response()->json([
            "message" => "Success get data",
            "status" => "success",
            "data" => $transaction
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showJoin($id)
    {
        $transaction = Transaction::with(['wallet', 'category', 'category.transactiontype'])->where('id', $id)->first();

        if(!$transaction) {
            return response()->json([
                "message" => "Data Not Found",
                "status" => "error"
            ], 404);
        }

        return response()->json([
            "message" => "Success get data",
            "status" => "success",
            "data" => $transaction
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_category' => 'required',
            'id_wallet' => 'required',
            'date' => 'required',
            'note' => 'required',
            'amount' => 'required',
        ]);

        $transaction = Transaction::find($id);

        if ($transaction) {
            $transaction->id_category = $request->input('id_category');
            $transaction->id_wallet = $request->input('id_wallet');
            $transaction->date = $request->input('date');
            $transaction->note = $request->input('note');
            $transaction->amount = $request->input('amount');
            $transaction->save();

            return response()->json([
                "message" => "Success Updated",
                "status" => "succcess",
                "data" => [
                    "attributes" => $transaction
                ]
            ], 200);
        } else {
            return response()->json([
                "message" => "Data Not Found",
                "status" => "error",
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if($transaction) {
            $transaction->delete();
            return response()->json([
                "message" => "Success Deleted",
                "status" => "success",
                "data" => [
                    "attributes" => $transaction
                ]
            ], 200);
        }else {
            return response()->json([
                "message" => "Data Not Found",
                "status" => "error",
            ], 404);
        }
    }
}
