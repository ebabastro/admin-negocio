<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $product = Product::get();

        return $product;
    }

    public function store(Request $request){
        $rules =[
            'fk_subcategory_id' => 'bail|required',
			'name' => 'bail|required|unique:products,name',
            'cost' => 'bail|required|min:0'
    	];

    	$messages = [
            'fk_subcategory_id.required' => 'Es necesario el id de la subcategoría',
    		'name.required' => 'Es necesario el nombre del producto',
    		'name.unique' => 'Ya existe ese producto',
            'cost.required' => 'Es necesario el costo del producto',
            'cost.min:0' => 'El costo debe ser mayor que 0',
    	];

    	$data = $request->validate($rules, $messages);
    	/** @var \App\Models\Product $product */
    	$subcategory = Product::create([
            'fk_subcategory_id' => $data['fk_subcategory_id'],
    		'name' => $data['name'],
            'cost' =>$data['cost'],
    	]);

		return response([
			'message' => 'Producto agregada con éxito',
		]);
    }

    public function delete(Request $request){
        $product = Product::find($request->id);

        $product->delete();

        return response([
           'message' => 'Producto eliminado con éxito',
        ]);
    }

    public function edit(Request $request){
        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->cost = $request->cost;

        $product->save();
        return response([
           'message' => 'Producto editado con éxito',
        ]);
    } 
}