<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\OrderDataTable;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\OrderSheetImport;

use DataTables;

class OrderController extends BackEndDatatableController
{
    public function __construct(Order $model, OrderDataTable $orderDataTable)
    {
        parent::__construct($model, $orderDataTable);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'order_sheet'   => 'required|mimes:xlsx',
            'store_id'      => 'required|exists:stores,id'
        ];
        $request->validate($rules);

        # Create order 
        $order = Order::create([
            'from_id'   => auth()->user()->id,
            'to_id'     => $request->store_id,
            'status'    => 'waiting',
        ]);

        # Create order products
        Excel::import(new OrderSheetImport($order->id), $request->order_sheet);

        if( count($order->orderProducts) == 0 )
        {
            $order->delete();
            session()->flash('error', __('site.order_failed'));

        }else{
            session()->flash('success', __('site.order_sent_successfuly'));

            # Save log for super_admin
            $this->addLog([
                'log_type'	=> $this->getClassNameFromModel(),
                'log_id'  	=> $order->id,
                'message' 	=> $this->getSingularModelName().'_has_been_updated',
                'action_by'	=> auth()->user()->id,
                ]);

            # Notify store owner
            // not yet
        }

        return redirect()->route('dashboard.stores.products', ['store'=>$request->store_id]);
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
}
