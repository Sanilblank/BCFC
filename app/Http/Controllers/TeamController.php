<?php

namespace App\Http\Controllers;

use App\Models\MatchDetail;
use App\Models\MatchType;
use App\Models\Team;
use App\Models\TeamMatchType;
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
                    ->addColumn('teammatchtype', function($row){
                        $teammatchtypes = TeamMatchType::where('team_id', $row->id)->with('matchtype')->get();
                        $matchtypes = '';
                        foreach($teammatchtypes as $teammatchtype)
                        {
                            $matchtypes .= '<span class="badge bg-green">' . $teammatchtype->matchtype->name . '</span>' . ' ';
                        }
                        return $matchtypes;
                    })

                    ->addColumn('action', function($row){
                        $editurl = route('team.edit', $row->id);
                        $deleteurl = route('team.destroy', $row->id);
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
                    ->rawColumns(['logo', 'teammatchtype', 'action'])
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
            $matchtypes = MatchType::orderBy('name', 'asc')->get();
            return view('backend.team.create', compact('matchtypes'));
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
            'name' => 'required|unique:teams,name',
            'logo' => 'required|mimes:png,jpg,jpeg',
            'matchtype' => 'required',
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

        foreach($data['matchtype'] as $matchtype_id)
        {
            $teammatchtype = TeamMatchType::create([
                'team_id' => $team->id,
                'matchtype_id' => $matchtype_id,
            ]);
            $teammatchtype->save();
        }

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
        if($request->user()->can('manage-team')){
            $team = Team::findorfail($id);
            $matchtypes = MatchType::orderBy('name', 'asc')->get();
            $selectedmatchtypes = TeamMatchType::where('team_id', $id)->get();
            $array_teammatchtypes = array();
            foreach($selectedmatchtypes as $selectedmatchtype)
            {
                $array_teammatchtypes[] = $selectedmatchtype->matchtype_id;
            }
            return view('backend.team.edit', compact('team', 'matchtypes', 'array_teammatchtypes'));
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $team = Team::findorfail($id);
        $data = $this->validate($request, [
            'name' => 'required|unique:teams,name,' . $id,
            'logo' => 'mimes:png,jpg,jpeg',
            'matchtype' => 'required',
        ]);

        $teamlogoimage = '';
        if($request->hasFile('logo'))
        {
            $photo = $request->file('logo');
            Storage::disk('uploads')->delete($team->logo);
            $teamlogoimage = $photo->store('team_logo', 'uploads');
        }
        else
        {
            $teamlogoimage = $team->logo;
        }

        $team->update([
            'name' => $data['name'],
            'logo' => $teamlogoimage,
        ]);

        $team->save();

        $teammatchtypes = TeamMatchType::where('team_id', $team->id)->get();
        foreach($teammatchtypes as $teammatchtype)
        {
            $teammatchtype->delete();
        }

        foreach($data['matchtype'] as $matchtype_id)
        {
            $matchtype = TeamMatchType::create([
                'team_id' => $team->id,
                'matchtype_id' => $matchtype_id,
            ]);
            $matchtype->save();
        }

        return redirect()->route('team.index')->with('success', 'Team Updated Successfully');
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
            $matchdetail = MatchDetail::where('team1_id', $id)->orWhere('team2_id', $id)->first();
            if($matchdetail)
            {
                return redirect()->back()->with('failure', 'Team is involved in matches');
            }
            $teammatchtypes = TeamMatchType::where('team_id', $team->id)->get();
            if(count($teammatchtypes) > 0)
            {
                foreach($teammatchtypes as $teammatchtype)
                {
                    $teammatchtype->delete();
                }
            }
            Storage::disk('uploads')->delete($team->logo);
            $team->delete();
            return redirect()->back()->with('success', 'Team Deleted Successfully');
        }else{
            return view('backend.permission.permission');
        }
    }
}
