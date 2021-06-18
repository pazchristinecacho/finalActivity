<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\StockCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stock = Stock::all();
        return Inertia::render('Stocks/Index',
        ['stock'=>$stock]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $stock_categorys = StockCategory::all();
        return Inertia::render('Stocks/Create', ['stock_categorys'=>$stock_categorys]);
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
                'id' => 'required|numeric|unique:stocks',
                'stock_categorys' => 'required',
                'description' => 'required',
                'uom' => 'required',
                'barcode' => 'required',
                'discontinued' => 'nullable',
                'photo_path' => 'nullable',

            ]

        );
        
        $model = new Stock();
        $model->id = $request->id;
        $model->stock_category_id = $request->stock_categorys;
        $model->description = $request->description;
        $model->uom = $request->uom;
        $model->barcode = $request->barcode;
        $model->discontinued = $request->discontinued;
        $model->photo_path = $request->photo_path;

        $model->save();

        return redirect()->back()->with('success', 'New Stocks Added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $stock_categorys = StockCategory::all();
        //return Inertia::render('Stocks/Create', ['stock_categorys'=>$stock_categorys]);
        $model =Stock::find($id);
        return Inertia::render('Stocks/View',
            ['model'=>$model, 'stock_categorys'=>$stock_categorys]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
        $validate = $request->validate(

            [
                'stock_category_id' => 'required',
                'description' => 'required',
                'uom' => 'required',
                'barcode' => 'required',
                'discontinued' => 'nullable',
                'photo_path' => 'nullable',
            ]

        );
        $model = Stock::find($id);
        $model->id = $request->id;
        $model->stock_category_id = $request->stock_category_id;
        $model->description = $request->description;
        $model->uom = $request->uom;
        $model->barcode = $request->barcode;
        $model->discontinued = $request->discontinued;
        $model->photo_path = $request->photo_path;

        $model->update();
    
        return Redirect::route('stock.index')->with("Success", "Stock Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try{
            Stock::find($id)->delete();
            return Redirect::route('stock.index')->with('success', 'Stock deleted.');
        }catch (\Exception$e) {
            return Redirect::route('stock.index')->with('error', $e->getMessage());
        }
    }
}
