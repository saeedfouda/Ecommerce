<?php

namespace App\Http\Controllers\Admin;
use App\Model\Mall;
use App\DataTables\MallsDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MallsController extends Controller
{
    /**
     * Display a listing of the resource.
     * MallsDatatable
     * @return \Illuminate\Http\Response
     */
    public function index(MallsDatatable $trade)
    {
        return $trade->render('admin.malls.index' , ['title' => trans('admin.malls')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.malls.create',['title'=>trans('admin.add')]);
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
            'mobile'             =>'required|numeric',
            'email'              =>'required|email',
            'country_id'         =>'required|numeric',
            'address'            => 'sometimes|nullable',
            'facebook'           => 'sometimes|nullable',
            'website'            => 'sometimes|nullable',
            'twitter'            => 'sometimes|nullable',
            'contact_name'       => 'sometimes|nullable|string',
            'lat'                => 'sometimes|nullable',
            'lng'                => 'sometimes|nullable',
            'icon'               => 'sometimes|nullable|'.v_image(),

                ],[],[
                    'name_ar'        =>trans('admin.name_ar'),
                    'name_en'        =>trans('admin.name_en'),
                    'mobile'         =>trans('admin.mobile'),
                    'address'        =>trans('admin.address'),
                    'country_id'     =>trans('admin.country_id'),
                    'email'          =>trans('admin.email'),
                    'facebook'       =>trans('admin.facebook'),
                    'website'        =>trans('admin.website'),
                    'twitter'        =>trans('admin.twitter'),
                    'contact_name'   =>trans('admin.contact_name'),
                    'lat'            =>trans('admin.lat'),
                    'lng'            =>trans('admin.lng'),
                    'icon'           =>trans('admin.icon'),
                ]);


     if (request()->hasFile('logo')) {
            $data['logo'] = up()->upload([

                'file'               => 'icon',
                'path'               => 'malls',
                'upload_type'        => 'single',
                 'delete_file'       =>'',

           ]);
    }
        Mall::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('malls'));
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
        $mall =Mall::find($id);
        $title = trans('admin.edit');
        return view('admin.malls.edit' ,compact('mall', 'title'));
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
                    'mobile'             =>'required|numeric',
                    'email'              =>'required|email',
                    'country_id'         =>'required|numeric',
                    'address'            => 'sometimes|nullable',
                    'facebook'           => 'sometimes|nullable',
                    'website'            => 'sometimes|nullable',
                    'twitter'            => 'sometimes|nullable',
                    'contact_name'       => 'sometimes|nullable|string',
                    'lat'                => 'sometimes|nullable',
                    'lng'                => 'sometimes|nullable',
                    'icon'               => 'sometimes|nullable|'.v_image(),

                        ],[],[
                            'name_ar'        =>trans('admin.name_ar'),
                            'name_en'        =>trans('admin.name_en'),
                            'mobile'         =>trans('admin.mobile'),
                            'address'        =>trans('admin.address'),
                            'country_id'     =>trans('admin.country_id'),
                            'email'          =>trans('admin.email'),
                            'facebook'       =>trans('admin.facebook'),
                            'website'        =>trans('admin.website'),
                            'twitter'        =>trans('admin.twitter'),
                            'contact_name'   =>trans('admin.contact_name'),
                            'lat'            =>trans('admin.lat'),
                            'lng'            =>trans('admin.lng'),
                            'icon'           =>trans('admin.icon'),
                        ]);

                if (request()->hasFile('icon')) {
                $data['icon'] = up()->upload([

                    'file'            => 'icon',
                    'path'            => 'malls',
                    'upload_type'     => 'single',
                    'delete_file'       => Mall::find($id)->icon,

                ]);
                }
                Mall::where('id',$id)->update($data);
                session()->flash('success',trans('admin.update_record'));
                return redirect(aurl('malls'));


        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $malls =  Mall::find($id);
         Storage::delete($malls->logo);
         $malls->delete();
            session()->flash('success',trans('admin.delete_record'));
            return redirect(aurl('malls'));
    }

    public function multi_delete()
        {
            if(is_array(request('item')))
            {
                foreach(request('item') as $id) {
                    $malls =  Mall::find($id);
                    Storage::delete($malls->logo);
                    $malls->delete();
                }
            }else{
                    $malls =  Mall::find(request('item'));
                    Storage::delete($malls->logo);
                    $malls->delete();
            }
            session()->flash('success',trans('admin.delete_record'));
                return redirect(aurl('admin'));
        }
}
