<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Models\TeamPosition;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;

class TeamPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->user()->can('manage-team')){
            if ($request->ajax()) {
                $data = TeamPosition::latest()->get();
                return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('action', function($row){

                        $editurl = route('teamposition.edit', $row->id);
                        $deleteurl = route('teamposition.destroy', $row->id);
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
            return view('backend.teamposition.index');
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
        if($request->user()->can('manage-team')){
            return view('backend.teamposition.create');
        }
        else{
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
        if($request->user()->can('manage-team')){
            $data = $this->validate($request,[
                'name'=>'required',
            ]);
            $exists = TeamPosition::where('slug', Str::slug($data['name']))->first();
            if($exists)
            {
                return redirect()->back()->with('failure', 'Position Already Exists');
            }

            $teamposition = TeamPosition::create([
                'name'=> $data['name'],
                'slug'=>Str::slug($data['name']),
            ]);
            $teamposition->save();
            return redirect()->route('teamposition.index')->with('success', 'Position Successfully Created');
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeamPosition  $teamPosition
     * @return \Illuminate\Http\Response
     */
    public function show(TeamPosition $teamPosition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeamPosition  $teamPosition
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        if($request->user()->can('manage-team')){
            $teamposition = TeamPosition::findorfail($id);
            return view('backend.teamposition.edit', compact('teamposition'));
        }
        else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeamPosition  $teamPosition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if($request->user()->can('manage-team')){
            $teamposition = TeamPosition::findorfail($id);
            $data = $this->validate($request,[
                'name'=>'required',
            ]);
            $exists = TeamPosition::where('slug', Str::slug($data['name']))->first();
            if($exists)
            {
                return redirect()->back()->with('failure', 'Position Already Exists');
            }

            $teamposition->update([
                'name'=> $data['name'],
                'slug'=>Str::slug($data['name']),
            ]);

            return redirect()->route('teamposition.index')->with('success', 'Position Successfully Updated');
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeamPosition  $teamPosition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        if($request->user()->can('manage-team')){
            $teamposition = TeamPosition::findorfail($id);
            $players = TeamMember::where('teamposition_id', $id)->first();
            if($players)
            {
                return redirect()->route('teamposition.index')->with('failure', 'Player with the position exists');
            }
            $teamposition->delete();
            return redirect()->route('teamposition.index')->with('success', 'Position Successfully Deleted');
        }
        else{
            return view('backend.permission.permission');
        }
    }
}
