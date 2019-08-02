<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\StoreCategory;
class StoreController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        if($request->ajax()){
            $stores=Store::with('category:id,name')->paginate(15,['*'],'page',$request->get('page'));
            $html=html_entity_decode(trim(preg_replace('/\s\s+/', ' ',$stores->links())));
            return [
                "stores"=>$stores,
                "html"=>$html
            ];
        }else{
             $stores=Store::with('category:id,name')->paginate(15);
             return view('store.index',compact('stores'));
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories_options= StoreCategory::select('id','name')->get();
        return view('store.form',compact('categories_options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $store = new Store();
        $store->fill($request->all());
        $store->save();
        return redirect('stores')->with('success', 'Store Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        return view('store.show',["store"=>$store]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        $categories_options= StoreCategory::select('id','name')->get();
        return view('store.form',["store"=>$store,"categories_options"=>$categories_options]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, Store $store)
    {
        $store->fill($request->all());
        $store->save();
        return redirect('stores')->with('success', 'Store Details Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Store $store)
    {
        if($request->ajax()){
            $ids=$request->input('ids');
            Store::destroy(collect($ids));
            return 'success';
        }else{
            $store->delete();
            return redirect('stores')->with('success', 'Store Deleted');
        }
    }
}
