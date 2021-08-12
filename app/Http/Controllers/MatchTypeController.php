<?php

namespace App\Http\Controllers;

use App\Models\MatchType;
use Illuminate\Http\Request;
use DataTables;

class MatchTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->user()->can('manage-match')){
            if ($request->ajax()) {
                $data = MatchType::latest()->get();
                return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('status', function ($row) {
                        if($row->status == 0)
                        {
                            $status = "Not Active";
                        }
                        else
                        {
                            $status = "Active";
                        }

                        return $status;
                    })
                    ->addColumn('action', function($row){

                        $editurl = route('matchtype.edit', $row->id);
                        $deleteurl = route('matchtype.destroy', $row->id);
                        $csrf_token = csrf_token();
                        $btn = "
                                <a href='$editurl' class='edit btn btn-primary btn-sm'>Edit</a>
                               <form action='$deleteurl' method='POST' style='display:inline;'>
                                <input type='hidden' name='_token' value='$csrf_token'>
                                <input type='hidden' name='_method' value='DELETE' />
                                   <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                               </form>
                               ";

                                return $btn;
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
            }
            return view('backend.matchtype.index');
        }else{
                return view('backend.permission.permission');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        if($request->user()->can('manage-match')){
            return view('backend.matchtype.create');
        }else{
            return view('backend.permission.permission');
        }
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
        $data = $this->validate($request, [
            'name' => 'required|unique:match_types,name',
        ]);

        if($request['status'] == null)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }


        $matchtype = MatchType::create([
            'name' => $data['name'],
            'status' => $status,
        ]);

        $matchtype->save();

        return redirect()->route('matchtype.index')->with('success', 'Matchtype Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MatchType  $matchType
     * @return \Illuminate\Http\Response
     */
    public function show(MatchType $matchType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MatchType  $matchType
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        if($request->user()->can('manage-match')){
            $matchtype = MatchType::findorfail($id);
            return view('backend.matchtype.edit', compact('matchtype'));
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MatchType  $matchType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $matchtype = MatchType::findorfail($id);
        $data = $this->validate($request, [
            'name' => 'required|unique:match_types,name,' . $id,
        ]);

        if($request['status'] == null)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }


        $matchtype->update([
            'name' => $data['name'],
            'status' => $status,
        ]);

        $matchtype->save();

        return redirect()->route('matchtype.index')->with('success', 'Matchtype Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MatchType  $matchType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        if($request->user()->can('manage-match')){
            $matchtype = MatchType::findorfail($id);
            $matchtype->delete();
            return redirect()->back()->with('success', 'Match Type Deleted Successfully');
        }else{
            return view('backend.permission.permission');
        }
    }
}
