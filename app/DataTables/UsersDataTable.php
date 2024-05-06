<?php

namespace App\DataTables;
use App\Models\User;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return '<a href="'.url('edit_user/'.$data->id).'" class="btn btn-primary">Edit</a> <a href="'.url('delete/'.$data->id).'" class="btn btn-danger">Delete</a>';
            })
            ->rawColumns(['action'])
            ;
    }
    public function query(User $model)
    {
        return $model->newQuery();
    }
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '80px'])
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => ['export', 'print', 'reset', 'reload'],
            ]);
    }
    public function getColumns()
    {
        return [
            'id',
            'name',
            'email',
            'status',
            'user_type'
        ];
    }
    public function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}