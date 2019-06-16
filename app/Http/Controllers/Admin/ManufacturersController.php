<?php

namespace App\Http\Controllers\Admin;
use App\Model\Manufacturers;
use App\DataTables\ManuFactsDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManufacturersController extends Controller
{
    /**
     * Display a listing of the resource.
     * manufactsDatatable
     * @return \Illuminate\Http\Response
     */
    public function index(ManuFactsDatatable $trade)
    {
        return $trade->render('admin.manufacturers.index' , ['title' => trans('admin.manufacturers')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manufacturers.create',['title'=>trans('admin.add')]);
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
                'path'               => 'manufacturers',
                'upload_type'        => 'single',
                 'delete_file'       =>'',

           ]);
    }
        Manufacturers::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('manufacturers'));
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
        $manufacturers =Manufacturers::find($id);
        $title = trans('admin.edit');
        return view('admin.manufacturers.edit' ,compact('manufacturers', 'title'));
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
                    'path'            => 'manufacturers',
                    'upload_type'     => 'single',
                    'delete_file'       => Manufacturers::find($id)->icon,

                ]);
                }
                Manufacturers::where('id',$id)->update($data);
                session()->flash('success',trans('admin.update_record'));
                return redirect(aurl('manufacturers'));


        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $manufacturers =  Manufacturers::find($id);
         Storage::delete($manufacturers->logo);
         $manufacturers->delete();
            session()->flash('success',trans('admin.delete_record'));
            return redirect(aurl('manufacturers'));
    }

    public function multi_delete()
        {
            if(is_array(request('item')))
            {
                foreach(request('item') as $id) {
                    $manufacturers =  Manufacturers::find($id);
                    Storage::delete($manufacturers->logo);
                    $manufacturers->delete();
                }
            }else{
                    $manufacturers =  Manufacturers::find(request('item'));
                    Storage::delete($manufacturers->logo);
                    $manufacturers->delete();
            }
            session()->flash('success',trans('admin.delete_record'));
                return redirect(aurl('admin'));
        }
}
