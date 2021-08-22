<?php

namespace App\Http\Controllers;

use App\Models\MatchDetail;
use App\Models\MatchType;
use App\Models\Team;
use App\Models\TeamMatchType;
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
                    ->addColumn('teammatchtype', function($row){
                        $teammatchtypes = TeamMatchType::where('matchtype_id', $row->id)->with('team')->get();
                        $teams = '';
                        foreach($teammatchtypes as $teammatchtype)
                        {
                            $teams .= '<span class="badge bg-green">' . $teammatchtype->team->name . '</span>' . ' ';
                        }
                        return $teams;
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
                    ->rawColumns(['status', 'teammatchtype', 'action'])
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
            $teams = Team::orderBy('name', 'asc')->get();
            return view('backend.matchtype.create', compact('teams'));
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
            'team' => 'required',
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

        foreach($data['team'] as $team_id)
        {
            $teammatchtype = TeamMatchType::create([
                'team_id' => $team_id,
                'matchtype_id' => $matchtype->id,
            ]);
            $teammatchtype->save();
        }

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
            $teams = Team::orderBy('name', 'asc')->get();
            $selectedteams = TeamMatchType::where('matchtype_id', $id)->get();
            $array_teammatchtypes = array();
            foreach($selectedteams as $selectedteam)
            {
                $array_teammatchtypes[] = $selectedteam->team_id;
            }
            return view('backend.matchtype.edit', compact('matchtype', 'array_teammatchtypes', 'teams'));
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
            'team' => 'required',
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

        $teammatchtypes = TeamMatchType::where('matchtype_id', $matchtype->id)->get();
        foreach($teammatchtypes as $teammatchtype)
        {
            $teammatchtype->delete();
        }

        foreach($data['team'] as $team_id)
        {
            $teamtype = TeamMatchType::create([
                'team_id' => $team_id,
                'matchtype_id' => $matchtype->id,
            ]);
            $teamtype->save();
        }

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
            $matchdetail = MatchDetail::where('matchtype_id', $id)->first();
            if($matchdetail)
            {
                return redirect()->back()->with('failure', 'Match Type is being used in matches');
            }
            $teammatchtypes = TeamMatchType::where('matchtype_id', $matchtype->id)->get();
            foreach($teammatchtypes as $teammatchtype)
            {
                $teammatchtype->delete();
            }
            $matchtype->delete();
            return redirect()->back()->with('success', 'Match Type Deleted Successfully');
        }else{
            return view('backend.permission.permission');
        }
    }
}
