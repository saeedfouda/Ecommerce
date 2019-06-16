<?php

namespace App\Http\Controllers\Admin;
use App\Model\Shipping;
use App\DataTables\ShippingDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     * shippingController
     * @return \Illuminate\Http\Response
     */
    public function index(ShippingDatatable $trade)
    {
        return $trade->render('admin.shippings.index' , ['title' => trans('admin.shippings')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shippings.create',['title'=>trans('admin.add')]);
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
            'user_id'            => 'sometimes|numeric',
            'lat'                => 'sometimes|nullable',
            'lng'                => 'sometimes|nullable',
            'icon'               => 'sometimes|nullable|'.v_image(),

                ],[],[
                    'name_ar'        =>trans('admin.name_ar'),
                    'name_en'        =>trans('admin.name_en'),

                    'user_id'        =>trans('admin.user_id'),
                    'lat'            =>trans('admin.lat'),
                    'lng'            =>trans('admin.lng'),
                    'icon'           =>trans('admin.icon'),
                ]);


     if (request()->hasFile('logo')) {
            $data['logo'] = up()->upload([

                'file'               => 'icon',
                'path'               => 'shippings',
                'upload_type'        => 'single',
                 'delete_file'       =>'',

           ]);
    }
        Shipping::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('shippings'));
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
        $shipping =Shipping::find($id);
        $title = trans('admin.edit');
        return view('admin.shippings.edit' ,compact('shipping', 'title'));
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
            'user_id'            => 'sometimes|numeric',
            'lat'                => 'sometimes|nullable',
            'lng'                => 'sometimes|nullable',
            'icon'               => 'sometimes|nullable|'.v_image(),

                ],[],[
                    'name_ar'        =>trans('admin.name_ar'),
                    'name_en'        =>trans('admin.name_en'),

                    'user_id'        =>trans('admin.user_id'),
                    'lat'            =>trans('admin.lat'),
                    'lng'            =>trans('admin.lng'),
                    'icon'           =>trans('admin.icon'),
                ]);


                if (request()->hasFile('icon')) {
                $data['icon'] = up()->upload([

                    'file'            => 'icon',
                    'path'            => 'shippings',
                    'upload_type'     => 'single',
                    'delete_file'       => Shipping::find($id)->icon,

                ]);
                }
                Shipping::where('id',$id)->update($data);
                session()->flash('success',trans('admin.update_record'));
                return redirect(aurl('shippings'));


        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $shipping =  Shipping::find($id);
         Storage::delete($shipping->logo);
         $shipping->delete();
            session()->flash('success',trans('admin.delete_record'));
            return redirect(aurl('shippings'));
    }

    public function multi_delete()
        {
            if(is_array(request('item')))
            {
                foreach(request('item') as $id) {
                    $shipping =  Shipping::find($id);
                    Storage::delete($shipping->logo);
                    $shipping->delete();
                }
            }else{
                    $shipping =  Shipping::find(request('item'));
                    Storage::delete($shipping->logo);
                    $shipping->delete();
            }
            session()->flash('success',trans('admin.delete_record'));
                return redirect(aurl('shippings'));
        }
}
