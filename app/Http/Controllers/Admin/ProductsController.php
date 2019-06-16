<?php

namespace App\Http\Controllers\Admin;
use App\Model\Product;
use App\DataTables\ProductsDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductsDatatable $product)
    {
        return $product->render('admin.products.index' , ['title' => trans('admin.products')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create',['title'=>trans('admin.create_products')]);
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
                'path'               => 'products',
                'upload_type'        => 'single',
                 'delete_file'       =>'',

           ]);
    }
         Product::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('products'));
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
        $products = Product::find($id);
        $title = trans('admin.edit');
        return view('admin.products.edit' ,compact('products', 'title'));
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
                    'delete_file'       =>  Product::find($id)->logo,

                ]);
                }
                 Product::where('id',$id)->update($data);
                session()->flash('success',trans('admin.update_record'));
                return redirect(aurl('products'));


        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $products =   Product::find($id);
         Storage::delete($products->logo);
         $products->delete();
            session()->flash('success',trans('admin.delete_record'));
            return redirect(aurl('products'));
    }

    public function multi_delete()
        {
            if(is_array(request('item')))
            {
                foreach(request('item') as $id) {
                    $products =   Product::find($id);
                    Storage::delete($products->logo);
                    $products->delete();
                }
            }else{
                    $products =   Product::find(request('item'));
                    Storage::delete($products->logo);
                    $products->delete();
            }
            session()->flash('success',trans('admin.delete_record'));
                return redirect(aurl('admin'));
        }
}
