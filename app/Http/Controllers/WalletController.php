<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wallets = Wallet::all();

        if(empty($wallets->name_wallet)) {
            return response()->json([
                "message" => "Data Not Found",
                "status" => "error",
            ], 404);
        }

        return response()->json([
            "message" => "Success get all data",
            "status" => "succes",
            "data" => $wallets
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
            'name_wallet' => 'required',
            'balance' => 'required',
        ]);

        $wallet = new Wallet();
        $wallet->name_wallet = $request->input('name_wallet');
        $wallet->balance = $request->input('balance');
        $wallet->save();

        return response()->json([
            "message" => "Success Added",
            "status" => "success",
            "data" => [
                "attributes" => $wallet
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
        $wallet = Wallet::find($id);

        if(!$wallet) {
            return response()->json([
                "message" => "Data Not Found",
                "status" => "error"
            ], 404);
        }

        return response()->json([
            "message" => "Success get data",
            "status" => "success",
            "data" => $wallet
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
            'name_wallet' => 'required',
            'balance' => 'required',
        ]);

        $wallet = Wallet::find($id);

        if ($wallet) {
            $wallet->name_wallet = $request->input('name_wallet');
            $wallet->balance = $request->input('balance');
            $wallet->save();

            return response()->json([
                "message" => "Success Updated",
                "status" => "succcess",
                "data" => [
                    "attributes" => $wallet
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
        $wallet = Wallet::find($id);

        if($wallet) {

            $wallet->delete();
            return response()->json([
                "message" => "Success Deleted",
                "status" => "success",
                "data" => [
                    "attributes" => $wallet
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
