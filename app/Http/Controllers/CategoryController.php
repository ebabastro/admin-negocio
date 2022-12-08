<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::get();

        return $categories;
    }

    public function store(Request $request){
    	$rules =[
			'name' => 'bail|required|unique:categories,name',
    	];

    	$messages = [
    		'name.required' => 'Es necesario el nombre de la categoría',
    		'name.unique' => 'Ya existe esa categoría',
    	];

    	$data = $request->validate($rules, $messages);
    	/** @var \App\Models\Category $category */
    	$category = Category::create([
    		'name' => $data['name'],
    	]);

		return response([
			'message' => 'Categoría agregada con éxito',
		]);
    }

	public function delete(Request $request){
		/** @var \App\Models\Category $category */
        $category = Category::find($request->id);
        $category->delete();

		return response([
			'message' => 'Categoría eliminada con éxito',
		]);
	}

	public function edit(Request $request){
		/** @var \App\Models\Category $category */
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->save();

        return response([
			'message' => 'Categoría editada con éxito',
		]);
	}
}