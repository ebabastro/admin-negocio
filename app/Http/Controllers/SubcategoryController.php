<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index(){
        $subcategories = Subcategory::get();

        return $subcategories;
    }

    public function store(Request $request){
        $rules =[
            'fk_category_id' => 'bail|required',
			'name' => 'bail|required|unique:subcategories,name',
    	];

    	$messages = [
            'fk_category_id.required' => 'Es necesario el id de la categoría',
    		'name.required' => 'Es necesario el nombre de la subcategoría',
    		'name.unique' => 'Ya existe esa subcategoría',
    	];

    	$data = $request->validate($rules, $messages);
    	/** @var \App\Models\Subcategory $subcategory */
    	$subcategory = Subcategory::create([
            'fk_category_id' => $data['fk_category_id'],
    		'name' => $data['name'],
    	]);

		return response([
			'message' => 'Subcategoría agregada con éxito',
		]);
    }

	public function delete(Request $request){
		$subcategory = Subcategory::find($request->id);

		$subcategory->delete();

		return response([
			'message' => 'Subcategoría eliminada con éxito',
		]);
	}

    public function edit(Request $request){
        $subcategory = Subcategory::find($request->id);
        $subcategory->name = $request->name;
        $subcategory->save();

        return response([
            'message' => 'Subcategoría editada con éxito',
        ]);

    }
}
