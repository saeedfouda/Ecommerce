<?php
namespace App\DataTables;
use App\Model\City;
use Yajra\DataTables\Services\DataTable;


class CityDatatable  extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query) {
		return datatables($query)
			->addColumn('checkbox', 'admin.cities.btn.checkbox')
			->addColumn('edit', 'admin.cities.btn.edit')
            ->addColumn('delete', 'admin.cities.btn.delete')

			->rawColumns([
				'edit',
				'delete',
				'checkbox',
			]);
	}
  /**
	 * Get query source of dataTable.
	 *
	 * @param \App\City $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query() {
		return City::query()->with('country_id')->select('cities.*');
	}




    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this
        ->builder()
        ->columns($this->getColumns())
        ->minifiedAjax()
      //  ->addAction(['width' => '80px'])
        // ->parameters($this->getBuilderParameters());
        ->parameters([
                        'dom'          => 'Blfrtip',
                        'lengthMenu'   => [[10, 25, 50, 100],[10,25,50, trans('admin.all_record')]],
                        'buttons'      =>[
        ['extend' => 'print', 'className' => 'btn btn-primary', 'text' => '<i class="fa fa-print" aria-hidden="true"></i>' ],

        [
            'text' =>  '<i class="fa fa-plus"></i>' .trans('admin.create_users'),
            'className' => 'btn btn-info', "action"=>"function(){

                window.location.href = '".\URL::current()."/create';
            }"],


        ['extend' => 'excel', 'className' => 'btn btn-success','text' => '<i class="fa fa-file-excel-o" aria-hidden="true"></i>'.trans('admin.excel_admin')],
        ['extend' => 'reload', 'className' => 'btn btn-info' , 'text' => '<i class="fa fa-refresh" aria-hidden="true"></i>'],
        [
            'text' =>  '<i class="fa fa-trash"></i>' .trans('admin.delete_all'),
            'className' => 'btn btn-danger dlBtn'
        ]
        ],

        'initComplete' => "function () {
            this.api().columns([2,3,4]).every(function () {
                var column = this;
                var input = document.createElement(\"input\");
                $(input).appendTo($(column.footer()).empty())
                .on('keyup', function () {
                    column.search($(this).val(), false, false, true).draw();
                });
            });
        }",
            'language' => datatable_lang(),

    ]);

    }

    /**
	 * Get columns.
	 *
	 * @return array
	 */
	protected function getColumns() {
		return [
			[
				'name'       => 'checkbox',
				'data'       => 'checkbox',
				'title'      => '<input type="checkbox" class="check_all" onclick="check_all()" />',
				'exportable' => false,
				'printable'  => false,
				'orderable'  => false,
				'searchable' => false,
			], [
				'name'  => 'id',
				'data'  => 'id',
				'title' => '#',
			], [
				'name'  => 'city_name_ar',
				'data'  => 'city_name_ar',
				'title' => trans('admin.city_name_ar'),
			], [
				'name'  => 'city_name_en',
				'data'  => 'city_name_en',
				'title' => trans('admin.city_name_en'),
			], [
				'name'  => 'country_id.Country_name_'.session('lang'),
				'data'  => 'country_id.Country_name_'.session('lang'),
				'title' => trans('admin.country_id'),

			], [
				'name'  => 'created_at',
				'data'  => 'created_at',
				'title' => trans('admin.created_at'),
			], [
				'name'  => 'updated_at',
				'data'  => 'updated_at',
				'title' => trans('admin.updated_at'),
			], [
				'name'       => 'edit',
				'data'       => 'edit',
				'title'      => trans('admin.edit'),
				'exportable' => false,
				'printable'  => false,
				'orderable'  => false,
				'searchable' => false,
			], [
				'name'       => 'delete',
				'data'       => 'delete',
				'title'      => trans('admin.delete'),
				'exportable' => false,
				'printable'  => false,
				'orderable'  => false,
				'searchable' => false,
			],
		];
	}
	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename() {
		return 'cities_'.date('YmdHis');
	}
}
