<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // return "OK";
        // $userId = Auth::user()->id;
        $todos = Products::get();
        return view('product.list', ['todos' => $todos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'password' => 'required',
        //     'c_password' => 'required|same:password',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->errors()], 401);
        // }
        if(!trim($request->title)){
            return redirect('product/create')->with('error', 'Please Enter Title');
        }
        if(!trim($request->description)){
            return redirect('product/create')->with('error', 'Please Enter Description');
        }
        if(!trim($request->price)){
            return redirect('product/create')->with('error', 'Please Enter Price');
        }
        $input = $request->input();
        $todoStatus = Products::create($input);
        if ($todoStatus) {
            $request->session()->flash('success', 'Product successfully added');
        } else {
            $request->session()->flash('error', 'Oops something went wrong, Product not saved');
        }
        return redirect('product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Products::where(['id' => $id])->first();
        if (!$product) {
            return redirect('product')->with('error', 'Product not found');
        }
        return view('product.view', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $product = Products::where(['id' => $id])->first();
        // return $product;
        if ($product) {
            return view('product.edit', ['todo' => $product]);
        } else {
            return redirect('product')->with('error', 'Todo not found');
        }
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
    $product = Products::find($id);
    if (!$product) {
        return redirect('product')->with('error', 'Product not found.');
    }
    if(!trim($request->title)){
        return redirect("product/$id/edit")->with('error', 'Please Enter Title');
    }
    if(!trim($request->description)){
        return redirect("product/$id/edit")->with('error', 'Please Enter Description');
    }
    if(!trim($request->price)){
        return redirect("product/$id/edit")->with('error', 'Please Enter Price');
    }

    $input = $request->input();
    $productStatus = $product->update($input);
    if ($productStatus) {
        return redirect('product')->with('success', 'Product successfully updated.');
    } else {
        return redirect('product')->with('error', 'Oops something went wrong. Product not updated');
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

        $product = Products::where(['id' => $id])->first();
        $respStatus = $respMsg = '';
        if (!$product) {
            $respStatus = 'error';
            $respMsg = 'Product not found';
        }
        $productDelStatus = $product->delete();
        if ($productDelStatus) {
            $respStatus = 'success';
            $respMsg = 'Product deleted successfully';
        } else {
            $respStatus = 'error';
            $respMsg = 'Oops something went wrong. Product not deleted successfully';
        }
        return redirect('product')->with($respStatus, $respMsg);
    }
}
