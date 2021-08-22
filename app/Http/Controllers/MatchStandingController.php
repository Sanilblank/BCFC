<?php

namespace App\Http\Controllers;

use App\Models\MatchStanding;
use App\Models\MatchType;
use App\Models\Team;
use App\Models\TeamMatchType;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;

class MatchStandingController extends Controller
{
    //
    public function index(Request $request)
    {
        if($request->user()->can('manage-match')){
            $matchtypes = MatchType::orderBy('name', 'asc')->where('status', 1)->get();

            return view('backend.standing.index', compact('matchtypes'));
        }else{
                return view('backend.permission.permission');
        }

    }

    public function viewStanding(Request $request)
    {
        if($request->user()->can('manage-match')){
            $matchtypes = MatchType::orderBy('name', 'asc')->where('status', 1)->get();
            $reqmatchtype = MatchType::where('id',request()->get('matchtype_id'))->first();
            $standing = MatchStanding::latest()->where('matchtype_id', request()->get('matchtype_id'))->first();
            if ($request->ajax()) {
                $data = MatchStanding::where('matchtype_id', request()->get('matchtype_id'))->orderBy('points', 'desc')->get();
                return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('team_id', function($row){
                        $src = Storage::disk('uploads')->url($row->team->logo);

                        $team = "<img src='$src' style='max-height:100px'> <br>" . $row->team->name;
                        return $team;
                    })
                    ->addColumn('action', function($row){

                        $editurl = route('standing.edit', $row->id);
                        $deleteurl = route('standing.destroy', $row->id);
                        $csrf_token = csrf_token();
                        $btn = "
                                <a href='$editurl' class='edit btn btn-primary btn-sm'>Update</a>
                               <form action='$deleteurl' method='POST' style='display:inline;'>
                                <input type='hidden' name='_token' value='$csrf_token'>
                                <input type='hidden' name='_method' value='DELETE' />
                                   <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                               </form>
                               ";

                                return $btn;
                    })
                    ->rawColumns(['team_id', 'action'])
                    ->make(true);
            }
            return view('backend.standing.viewStanding', compact('matchtypes', 'standing', 'reqmatchtype'));
        }else{
                return view('backend.permission.permission');
        }

    }

    public function initialize(Request $request)
    {
        $data = $this->validate($request, [
            'matchtype_id' =>'required',
        ]);

        $teammatchtypes = TeamMatchType::where('matchtype_id', $data['matchtype_id'])->get();
        if(count($teammatchtypes) > 0)
        {
            foreach($teammatchtypes as $teammatchtype)
            {
                $standing = MatchStanding::create([
                    'matchtype_id' => $data['matchtype_id'],
                    'team_id' => $teammatchtype->team_id,
                    'played' => 0,
                    'win' => 0,
                    'draw' => 0,
                    'loss' => 0,
                    'goalsscored' => 0,
                    'goalsagainst' => 0,
                    'goaldifferential' => 0,
                    'points' => 0,
                ]);

                $standing->save();
            }

            return redirect()->back()->with('success', 'Initialized Successfully');
        }
        else
        {
            return redirect()->back()->with('failure', 'Create Teams First');
        }
    }

    public function create(Request $request, $id)
    {
        if($request->user()->can('manage-match')){
            $reqmatchtype = MatchType::findorfail($id);
            $teammatchtypes = TeamMatchType::where('matchtype_id', $id)->get();
            return view('backend.standing.create', compact('teammatchtypes', 'reqmatchtype'));
        }else{
            return view('backend.permission.permission');
        }
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'matchtype_id' => 'required',
            'team_id' => 'required',
            'played' => 'required|integer',
            'win' => 'required|integer',
            'draw' => 'required|integer',
            'loss' => 'required|integer',
            'goalsscored' => 'required|integer',
            'goalsagainst' => 'required|integer',
        ]);

        $exists = MatchStanding::where('matchtype_id', $data['matchtype_id'])->where('team_id', $data['team_id'])->first();
        if($exists)
        {
            return redirect()->back()->with('failure', 'Standings for the selected team already exists. Please update the standings.');
        }

        if($data['played'] != ($data['win'] + $data['draw'] + $data['loss']))
        {
            return redirect()->back()->with('failure', 'No of played matches is incorrect.');
        }
        $goaldifferential = $data['goalsscored'] - $data['goalsagainst'];
        $points = $data['win'] * 3 + $data['draw'];
        $standing = MatchStanding::create([
            'matchtype_id' => $data['matchtype_id'],
            'team_id' => $data['team_id'],
            'played' => $data['played'],
            'win' => $data['win'],
            'draw' => $data['draw'],
            'loss' => $data['loss'],
            'goalsscored' => $data['goalsscored'],
            'goalsagainst' => $data['goalsagainst'],
            'goaldifferential' => $goaldifferential,
            'points' => $points,
        ]);
        $standing->save();

        return redirect()->to(route('standing.viewStanding') . '?matchtype_id=' . $data['matchtype_id'])->with('success', 'Standings for the team created successfully');

    }

    public function edit(Request $request, $id)
    {
        if($request->user()->can('manage-match')){
            $standing = MatchStanding::where('id', $id)->with('team', 'matchtype')->first();
            return view('backend.standing.edit', compact('standing'));
        }else{
            return view('backend.permission.permission');
        }
    }

    public function update(Request $request, $id)
    {
        $standing = MatchStanding::findorfail($id);
        $data = $this->validate($request, [
            'matchtype_id' => 'required',
            'team_id' => 'required',
            'played' => 'required|integer',
            'win' => 'required|integer',
            'draw' => 'required|integer',
            'loss' => 'required|integer',
            'goalsscored' => 'required|integer',
            'goalsagainst' => 'required|integer',
        ]);

        if($data['played'] != ($data['win'] + $data['draw'] + $data['loss']))
        {
            return redirect()->back()->with('failure', 'No of played matches is incorrect.');
        }
        $goaldifferential = $data['goalsscored'] - $data['goalsagainst'];
        $points = $data['win'] * 3 + $data['draw'];

        $standing->update([
            'matchtype_id' => $data['matchtype_id'],
            'team_id' => $data['team_id'],
            'played' => $data['played'],
            'win' => $data['win'],
            'draw' => $data['draw'],
            'loss' => $data['loss'],
            'goalsscored' => $data['goalsscored'],
            'goalsagainst' => $data['goalsagainst'],
            'goaldifferential' => $goaldifferential,
            'points' => $points,
        ]);

        return redirect()->to(route('standing.viewStanding') . '?matchtype_id=' . $data['matchtype_id'])->with('success', 'Standings for the team updated successfully');

    }

    public function destroy(Request $request, $id)
    {
        if($request->user()->can('manage-match')){
            $standing = MatchStanding::findorfail($id);
            $standing->delete();
            return redirect()->back()->with('success', 'Standing Deleted Successfully');
        }else{
            return view('backend.permission.permission');
        }
    }

    public function destroyall(Request $request, $id)
    {
        if($request->user()->can('manage-match')){
            $standings = MatchStanding::where('matchtype_id', $id)->get();
            if(count($standings) > 0)
            {
                foreach($standings as $standing)
                {
                    $standing->delete();
                }
            }
            return redirect()->back()->with('success', 'Standings Deleted Successfully');
        }else{
            return view('backend.permission.permission');
        }
    }

}
