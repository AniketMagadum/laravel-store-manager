<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
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
            $stores=Store::paginate(15,['*'],'page',$request->get('page'));
            $html=html_entity_decode(trim(preg_replace('/\s\s+/', ' ',$stores->links())));
            return [
                "stores"=>$stores,
                "html"=>$html
            ];
        }else{
             $stores=Store::paginate(15);
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
        return view('store.form');
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
        return redirect('stores');
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
        return view('store.form',["store"=>$store]);
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
        return redirect('stores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        $store->delete();
        return redirect('stores');
    }
}
