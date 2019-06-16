<?php

namespace App\Http\Controllers\Admin;
use App\Model\Weight;
use App\DataTables\WeightsDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WeightsController extends Controller
{
    /**
     * Display a listing of the resource.
     * weightsDatatable
     * @return \Illuminate\Http\Response
     */
    public function index(WeightsDatatable $trade)
    {
        return $trade->render('admin.weights.index' , ['title' => trans('admin.weights')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.weights.create',['title'=>trans('admin.add')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = $this->validate(request(),
        [
            'name_ar'            =>'required',
            'name_en'            =>'required',


                ],[],[
                    'name_ar'        =>trans('admin.weights_name_ar'),
                    'name_en'        =>trans('admin.weights_name_en'),

                ]);


    Weight::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('weights'));
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
        $weight =Weight::find($id);
        $title = trans('admin.edit');
        return view('admin.weights.edit' ,compact('weight', 'title'));
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
        $data = $this->validate(request(),
        [
            'name_ar'            =>'required',
            'name_en'            =>'required',


                ],[],[
                    'name_ar'        =>trans('admin.weights_name_ar'),
                    'name_en'        =>trans('admin.weights_name_en'),

                ]);


                Weight::where('id',$id)->update($data);
                session()->flash('success',trans('admin.update_record'));
                return redirect(aurl('weights'));


        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $weights =  Weight::find($id);
         $weights->delete();
            session()->flash('success',trans('admin.delete_record'));
            return redirect(aurl('weights'));
    }

    public function multi_delete()
        {
            if(is_array(request('item')))
            {
                foreach(request('item') as $id) {
                    $weights =  Weight::find($id);
                    $weights->delete();
                }
            }else{
                    $weights =  Weight::find(request('item'));
                    $weights->delete();
            }
            session()->flash('success',trans('admin.delete_record'));
                return redirect(aurl('admin'));
        }
}
