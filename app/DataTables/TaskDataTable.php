<?php

namespace App\DataTables;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TaskDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $dataTable = (new EloquentDataTable($query))
            ->addColumn('team', function ($data) {
                return $data->user->name;
            })
            ->addColumn('project', function ($data) {
                return $data->project->name;
            })
            ->addColumn('task_status', function ($data) {
                return '<input type="checkbox" class="completed-checkbox" data-id="' . $data->id . '" ' . ($data->task_status ? 'checked' : '') . '>';
            })
            ->setRowId('id')
            ->escapeColumns([]);
            
            if(\Auth::user()->user_type == 'Team Member') {
                $dataTable->addColumn('status', function ($data) {                
                    return $data->task_status == '0' ? 'Pending' : 'Completed';
                });
            } else {
                $dataTable->addColumn('action', function ($data) {                
                    return '<a href="'.url('edit_task/'.$data->id).'" class="btn btn-primary">Edit</a> <a href="'.url('delete_task/'.$data->id).'" class="btn btn-danger">Delete</a>';
                });
            }
            return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Task $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Task $model): QueryBuilder
    {        
        $model = Task::with('user');
        return $model;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('task-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('end_date'),
            Column::make('team'),
            Column::make('project'),
            Column::computed('task_status')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60),
            \Auth::user()->user_type != 'Team Member' ?
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
            :
            Column::make('status')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Task_' . date('YmdHis');
    }
}
