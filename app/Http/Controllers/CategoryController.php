<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        if(empty($categories)) {
            return response()->json([
                "message" => "Data Not Found",
                "status" => "error",
            ], 404);
        }

        return response()->json([
            "message" => "Success get all data",
            "status" => "succes",
            "data" => $categories
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
            'name_category' => 'required',
            'id_transaction_type' => 'required|exists:transaction_types,id',
        ]);

        $category = new Category();
        $category->name_category = $request->input('name_category');
        $category->id_transaction_type = $request->input('id_transaction_type');
        $category->save();

        return response()->json([
            "message" => "Success Added",
            "status" => "success",
            "data" => [
                "attributes" => $category
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
        $category = Category::find($id);

        if(!$category) {
            return response()->json([
                "message" => "Data Not Found",
                "status" => "error"
            ], 404);
        }

        return response()->json([
            "message" => "Success get data",
            "status" => "success",
            "data" => $category
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
            'name_category' => 'required',
            'id_transaction_type' => 'required|exists:transaction_types,id',
        ]);

        $category = Category::find($id);

        if ($category) {
            $category->name_category = $request->input('name_category');
            $category->id_transaction_type = $request->input('id_transaction_type');
            $category->save();

            return response()->json([
                "message" => "Success Updated",
                "status" => "succcess",
                "data" => [
                    "attributes" => $category
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
        $category = Category::find($id);

        if($category) {

            $category->delete();
            return response()->json([
                "message" => "Success Deleted",
                "status" => "success",
                "data" => [
                    "attributes" => $category
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
