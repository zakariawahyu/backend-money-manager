<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionType;

class TransactionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactionTypes = TransactionType::all();

        if(empty($transactionTypes)) {
            return response()->json([
                "message" => "Data Not Found",
                "status" => "error",
            ], 404);
        }

        return response()->json([
            "message" => "Success get all data",
            "status" => "succes",
            "data" => $transactionTypes
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
            'name_transaction_type' => 'required',
        ]);

        $transactionType = new TransactionType();
        $transactionType->name_transaction_type = $request->input('name_transaction_type');
        $transactionType->save();

        return response()->json([
            "message" => "Success Added",
            "status" => "success",
            "data" => [
                "attributes" => $transactionType
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
        $transactionType = TransactionType::find($id);

        if(!$transactionType) {
            return response()->json([
                "message" => "Data Not Found",
                "status" => "error"
            ], 404);
        }

        return response()->json([
            "message" => "Success get data",
            "status" => "success",
            "data" => $transactionType
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
            'name_transaction_type' => 'required',
        ]);

        $transactionType = TransactionType::find($id);

        if ($transactionType) {
            $transactionType->name_transaction_type = $request->input('name_transaction_type');
            $transactionType->save();

            return response()->json([
                "message" => "Success Updated",
                "status" => "succcess",
                "data" => [
                    "attributes" => $transactionType
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
        $transactionType = TransactionType::find($id);

        if($transactionType) {

            $transactionType->delete();
            return response()->json([
                "message" => "Success Deleted",
                "status" => "success",
                "data" => [
                    "attributes" => $transactionType
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
