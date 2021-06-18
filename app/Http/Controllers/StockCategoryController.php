<?php

namespace App\Http\Controllers;

use App\Models\StockCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class StockCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //retrieve all records
        $stock_categories = StockCategory::all();

        //then display using the Index view
        return Inertia::render('StockCategories/Index',
            ['stock_categories' => $stock_categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //display a blank form
        return Inertia::render('StockCategories/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate(

            [
                'id' => 'required|numeric|unique:stock_categories',
                'description' => 'required',
                'type' => 'required',
                'stock_account' => 'nullable',

            ]

        );
        //if everything is ok then the next line of codes will be executed
        //otherwise it will return an object called <<errors> that can be  

        $model = new StockCategory();
        $model->id = $request->id;
        $model->description = $request->description;
        $model->type = $request->type;
        $model->stock_account = $request->stock_account;

        $model->save();

        return redirect()->back()->with('success', 'New Stock Category Added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $model =StockCategory::find($id);

        return Inertia::render('StockCategories/View',['model'=>$model]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
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
        $validate = $request->validate(

            [
               
                'description' => 'required',
                'type' => 'required',
                'stock_account' => 'nullable',

            ]

        );


        $model = StockCategory::find($id);

        $model->update($validate);
    
        return Redirect::route('sc.index')->with("Success", "Stock Category Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //use try since an error migth occur
       try{
        StockCategory::find($id)->delete();
        return Redirect::route('sc.index')->with('success', 'Stock Category deleted.');
       }catch (\Exception$e) {
     
        return Redirect::route('sc.index')->with('error', $e->getMessage());

    }
    }
}
