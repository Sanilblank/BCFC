<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
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
                $data = Team::latest()->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('logo', function($row){
                        $src = Storage::disk('uploads')->url($row->logo);

                        $image = "<img src='$src' style='max-height:100px'>";
                        return $image;
                    })

                    ->addColumn('action', function($row){
                        $deleteurl = route('team.destroy', $row->id);
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
                    ->rawColumns(['logo', 'action'])
                    ->make(true);
            }
            return view('backend.team.index');
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
            return view('backend.team.create');
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
            'name' => 'required',
            'logo' => 'required|mimes:png,jpg,jpeg',
        ]);

        $teamlogoimage = '';
        if($request->hasFile('logo'))
        {
            $photo = $request->file('logo');
            $teamlogoimage = $photo->store('team_logo', 'uploads');
        }

        $team = Team::create([
            'name' => $data['name'],
            'logo' => $teamlogoimage,
        ]);

        $team->save();

        return redirect()->route('team.index')->with('success', 'Team Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        if($request->user()->can('manage-team')){
            $team = Team::findorfail($id);
            Storage::disk('uploads')->delete($team->logo);
            $team->delete();
            return redirect()->back()->with('success', 'Team Deleted Successfully');
        }else{
            return view('backend.permission.permission');
        }
    }
}
