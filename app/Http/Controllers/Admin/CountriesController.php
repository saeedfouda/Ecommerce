<?php

namespace App\Http\Controllers\Admin;
use App\Model\Country;
use App\DataTables\CountryDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CountryDatatable $Country)
    {
        return $Country->render('admin.countries.index' , ['title' => trans('admin.countries')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.countries.create',['title'=>trans('admin.create_countries')]);
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
            'Country_name_ar'   =>'required',
            'Country_name_en'   =>'required',
            'mob'               =>'required',
            'code'              =>'required',
            'logo'              =>'required|'.v_image(),
            ],[],[
                'Country_name_ar'       =>trans('admin.Country_name_ar'),
                'Country_name_en'       =>trans('admin.Country_name_en'),
                'mob'                   =>trans('admin.mob'),
                'code'                  =>trans('admin.code'),
                'logo'                  =>trans('admin.country_flag'),
            ]);

     if (request()->hasFile('logo')) {
            $data['logo'] = up()->upload([

                'file'               => 'logo',
                'path'               => 'countries',
                'upload_type'        => 'single',
                 'delete_file'       =>'',

           ]);
    }
        Country::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('countries'));
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
        $country =Country::find($id);
        $title = trans('admin.edit');
        return view('admin.countries.edit' ,compact('country', 'title'));
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
                        'Country_name_ar'   =>'required',
                        'Country_name_en'   =>'required',
                        'mob'               =>'required',
                        'code'              =>'required',
                        'logo'              =>'sometimes|nullable|'.v_image(),
                        ],[],[
                            'Country_name_ar'   =>trans('admin.Country_name_ar'),
                            'Country_name_en'   =>trans('admin.Country_name_en'),
                            'mob'               =>trans('admin.mob'),
                            'code'              =>trans('admin.code'),
                            'logo'              =>trans('admin.country_flag'),
                        ]);

                if (request()->hasFile('logo')) {
                $data['logo'] = up()->upload([

                    'file'            => 'logo',
                    'path'            => 'countries',
                    'upload_type'     => 'single',
                    'delete_file'       => Country::find($id)->logo,

                ]);
                }
                Country::where('id',$id)->update($data);
                session()->flash('success',trans('admin.update_record'));
                return redirect(aurl('countries'));


        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $countries =  Country::find($id);
         Storage::delete($countries->logo);
         $countries->delete();
            session()->flash('success',trans('admin.delete_record'));
            return redirect(aurl('countries'));
    }

    public function multi_delete()
        {
            if(is_array(request('item')))
            {
                foreach(request('item') as $id) {
                    $countries =  Country::find($id);
                    Storage::delete($countries->logo);
                    $countries->delete();
                }
            }else{
                    $countries =  Country::find(request('item'));
                    Storage::delete($countries->logo);
                    $countries->delete();
            }
            session()->flash('success',trans('admin.delete_record'));
                return redirect(aurl('admin'));
        }
}
