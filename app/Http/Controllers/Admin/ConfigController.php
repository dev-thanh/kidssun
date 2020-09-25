<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rank;
use App\Models\Quyenloi;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Rank::all();
        return view('backend.config.cap-bac',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rank = Rank::all();
        return view('backend.config.them-cap-bac',compact('rank'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $array = [
            [
                'id'=>$request->id_1,
                'name'=>$request->name1,          
                'total'=>$request->total1,
                
            ],
            [
                'id'=>$request->id_2,
                'name'=>$request->name2,
                'total'=>$request->total2,
               
            ],
        ];
            
        foreach ($array as $value) {
            Rank::find($value['id'])->update($value);
        }

        flash('Cập nhập thành công.')->success();
        return redirect()->route('config.index');
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
    }

    public function lisQuyenLoi(){
        $quyenloi = Quyenloi::first();
        return view('backend.config.quyen-loi',compact('quyenloi'));
    }

    public function updateQuyenloi(Request $request){
        $quyenloi = Quyenloi::first();
        if($quyenloi){
            $quyenloi->update($request->all());
        }else{
            Quyenloi::create($request->all());
        }
        flash('Cập nhập thành công.')->success();

        return redirect()->route('config.quyenloi');
    }
}
