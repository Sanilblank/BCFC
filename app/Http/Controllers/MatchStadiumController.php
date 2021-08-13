<?php

namespace App\Http\Controllers;

use App\Models\MatchDetail;
use App\Models\MatchStadium;
use Illuminate\Http\Request;
use DataTables;

class MatchStadiumController extends Controller
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
                $data = MatchStadium::latest()->get();
                return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('action', function($row){

                        $editurl = route('stadium.edit', $row->id);
                        $deleteurl = route('stadium.destroy', $row->id);
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
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('backend.stadium.index');
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
            return view('backend.stadium.create');
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
            'name' => 'required|unique:match_stadia,name',
            'location' => 'required'
        ]);


        $stadium = MatchStadium::create([
            'name' => $data['name'],
            'location' => $data['location'],
        ]);

        $stadium->save();

        return redirect()->route('stadium.index')->with('success', 'Stadium Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MatchStadium  $matchStadium
     * @return \Illuminate\Http\Response
     */
    public function show(MatchStadium $matchStadium)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MatchStadium  $matchStadium
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        if($request->user()->can('manage-match')){
            $stadium = MatchStadium::findorfail($id);
            return view('backend.stadium.edit', compact('stadium'));
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MatchStadium  $matchStadium
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $stadium = MatchStadium::findorfail($id);
        $data = $this->validate($request, [
            'name' => 'required|unique:match_stadia,name,' . $stadium->id,
            'location' => 'required'
        ]);


        $stadium->update([
            'name' => $data['name'],
            'location' => $data['location'],
        ]);

        $stadium->save();

        return redirect()->route('stadium.index')->with('success', 'Stadium Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MatchStadium  $matchStadium
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        if($request->user()->can('manage-match')){
            $stadium = MatchStadium::findorfail($id);
            $matchdetail = MatchDetail::where('stadium_id', $id)->first();
            if($matchdetail)
            {
                return redirect()->back()->with('failure', 'Stadium is being used in matches');
            }
            $stadium->delete();
            return redirect()->back()->with('success', 'Stadium Deleted Successfully');
        }else{
            return view('backend.permission.permission');
        }
    }
}
