<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->user()->can('manage-subscriber')){

            $newsubscriber = DB::table('notifications')->where('type', 'App\Notifications\NewSubscriberNotification')->where('is_read', 0)->get();
            foreach ($newsubscriber as $subscriber) {
                DB::update('update notifications set is_read = 1 where id = ?', [$subscriber->id]);
            }
            if ($request->ajax()) {
                $data = Subscriber::latest()->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('date', function ($row) {
                        $date = date('Y/m/d', strtotime($row->created_at));
                        return $date;
                    })
                    ->addColumn('is_verified', function ($row) {
                        if($row->is_verified == 1)
                        {
                            $is_verified = '<span class="badge bg-green" style="background-color: green";>Verified</span>';
                        }
                        else
                        {
                            $is_verified = '<span class="badge bg-danger" style="color: white";>Not Verified</span>';
                        }
                        return $is_verified;
                    })
                    ->addColumn('action', function($row){

                        $deleteurl = route('subscriber.destroy', $row->id);
                        $csrf_token = csrf_token();
                        $btn = "
                               <form action='$deleteurl' method='POST' style='display:inline;'>
                                <input type='hidden' name='_token' value='$csrf_token'>
                                <input type='hidden' name='_method' value='DELETE' />
                                   <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                               </form>
                               ";

                                return $btn;
                    })
                    ->rawColumns(['date', 'is_verified', 'action'])
                    ->make(true);
            }
            return view('backend.subscriber.index');
        }else{
                return view('backend.permission.permission');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function show(Subscriber $subscriber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscriber $subscriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscriber $subscriber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $subscriber)
    {
        //
    }
}
