<?php

namespace App\Http\Controllers;

use App\Models\MatchDetail;
use App\Models\MatchResult;
use App\Models\MatchStadium;
use App\Models\MatchType;
use App\Models\Team;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;

class MatchDetailController extends Controller
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
                $data = MatchDetail::latest()->where('completed', 0)->with('team1', 'team2', 'matchtype', 'stadium')->get();
                return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('team1', function($row){
                        $src = Storage::disk('uploads')->url($row->team1->logo);

                        $team1 = "<img src='$src' style='max-height:100px'> <br>" . $row->team1->name;
                        return $team1;
                    })
                    ->addColumn('team2', function($row){
                        $src = Storage::disk('uploads')->url($row->team2->logo);

                        $team2 = "<img src='$src' style='max-height:100px'> <br>" . $row->team2->name;
                        return $team2;
                    })
                    ->addColumn('matchtype', function($row){
                        return $row->matchtype->name;
                    })
                    ->addColumn('stadium', function($row){
                        return $row->stadium->name;
                    })
                    ->addColumn('datetime', function($row){
                        return date('d F, Y h:i', strtotime($row->datetime));
                    })

                    ->addColumn('action', function($row){
                        $createresulturl = route('match.createresult', $row->id);
                        $editurl = route('match.edit', $row->id);
                        $deleteurl = route('match.destroy', $row->id);
                        $csrf_token = csrf_token();
                        $btn = "
                                <a href='$createresulturl' class='edit btn btn-warning btn-sm'>Create Result</a>
                                <a href='$editurl' class='edit btn btn-primary btn-sm'>Edit</a>
                               <form action='$deleteurl' method='POST' style='display:inline;'>
                                <input type='hidden' name='_token' value='$csrf_token'>
                                <input type='hidden' name='_method' value='DELETE' />
                                   <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                               </form>
                               ";

                                return $btn;
                    })
                    ->rawColumns(['team1', 'team2', 'matchtype', 'stadium', 'datetime', 'action'])
                    ->make(true);
            }
            return view('backend.matchdetails.index');
        }else{
                return view('backend.permission.permission');
        }
    }

    public function completedindex(Request $request)
    {
        //
        if($request->user()->can('manage-match')){
            if ($request->ajax()) {
                $data = MatchDetail::latest()->where('completed', 1)->with('team1', 'team2', 'matchtype', 'stadium')->get();
                return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('team1', function($row){
                        $src = Storage::disk('uploads')->url($row->team1->logo);
                        $matchresult = MatchResult::where('matchdetail_id', $row->id)->first();
                        $team1 = "<img src='$src' style='max-height:100px'> <br>" . $row->team1->name . "<br> Score: " . $matchresult->team1_score;
                        return $team1;
                    })
                    ->addColumn('team2', function($row){
                        $src = Storage::disk('uploads')->url($row->team2->logo);
                        $matchresult = MatchResult::where('matchdetail_id', $row->id)->first();
                        $team2 = "<img src='$src' style='max-height:100px'> <br>" . $row->team2->name . "<br> Score: " . $matchresult->team2_score;
                        return $team2;
                    })
                    ->addColumn('matchtype', function($row){
                        return $row->matchtype->name;
                    })
                    ->addColumn('stadium', function($row){
                        return $row->stadium->name;
                    })
                    ->addColumn('datetime', function($row){
                        return date('d F, Y h:i', strtotime($row->datetime));
                    })

                    ->addColumn('action', function($row){
                        $editresulturl = route('match.editresult', $row->id);
                        $editurl = route('match.edit', $row->id);
                        $deleteurl = route('match.destroy', $row->id);
                        $csrf_token = csrf_token();
                        $btn = "
                                <a href='$editresulturl' class='edit btn btn-warning btn-sm'>Edit Result</a>
                                <a href='$editurl' class='edit btn btn-primary btn-sm'>Edit</a>
                               <form action='$deleteurl' method='POST' style='display:inline;'>
                                <input type='hidden' name='_token' value='$csrf_token'>
                                <input type='hidden' name='_method' value='DELETE' />
                                   <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                               </form>
                               ";

                                return $btn;
                    })
                    ->rawColumns(['team1', 'team2', 'matchtype', 'stadium', 'datetime', 'action'])
                    ->make(true);
            }
            return view('backend.matchdetails.completedindex');
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
            $matchtypes = MatchType::where('status', 1)->orderBy('name', 'asc')->get();
            $stadiums = MatchStadium::orderBy('name', 'asc')->get();
            return view('backend.matchdetails.create', compact('teams', 'matchtypes', 'stadiums'));
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
            'team1_id' => 'required',
            'team2_id' => 'required',
            'matchtype_id' => 'required',
            'datetime' => 'required',
            'stadium_id' => 'required',
        ]);

        $matchdetail = MatchDetail::create([
            'team1_id' => $data['team1_id'],
            'team2_id' => $data['team2_id'],
            'matchtype_id' => $data['matchtype_id'],
            'datetime' => $data['datetime'],
            'stadium_id' => $data['stadium_id'],
        ]);

        $matchdetail->save();

        return redirect()->route('match.index')->with('success', 'Match Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MatchDetail  $matchDetail
     * @return \Illuminate\Http\Response
     */
    public function show(MatchDetail $matchDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MatchDetail  $matchDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        if($request->user()->can('manage-team')){
            $matchdetail = MatchDetail::findorfail($id);
            $teams = Team::orderBy('name', 'asc')->get();
            $matchtypes = MatchType::where('status', 1)->orderBy('name', 'asc')->get();
            $stadiums = MatchStadium::orderBy('name', 'asc')->get();
            return view('backend.matchdetails.edit', compact('matchdetail', 'teams', 'matchtypes', 'stadiums'));
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MatchDetail  $matchDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $matchdetail = MatchDetail::findorfail($id);
        $data = $this->validate($request, [
            'team1_id' => 'required',
            'team2_id' => 'required',
            'matchtype_id' => 'required',
            'datetime' => 'required',
            'stadium_id' => 'required',
        ]);

        $matchdetail->update([
            'team1_id' => $data['team1_id'],
            'team2_id' => $data['team2_id'],
            'matchtype_id' => $data['matchtype_id'],
            'datetime' => $data['datetime'],
            'stadium_id' => $data['stadium_id'],
        ]);

        $matchdetail->save();

        return redirect()->route('match.index')->with('success', 'Match Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MatchDetail  $matchDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        if($request->user()->can('manage-match')){
            $matchdetail = MatchDetail::findorfail($id);
            $matchdetail->delete();
            return redirect()->back()->with('success', 'Match Deleted Successfully');
        }else{
            return view('backend.permission.permission');
        }
    }

    public function createresult(Request $request, $id)
    {
        if($request->user()->can('manage-match')){
            $matchdetail = MatchDetail::where('id', $id)->with('team1', 'team2', 'matchtype', 'stadium')->first();
            return view('backend.matchdetails.createresult', compact('matchdetail'));
        }else{
            return view('backend.permission.permission');
        }
    }

    public function storeresult(Request $request)
    {
        if($request->user()->can('manage-match')){
            $data = $this->validate($request, [
                'matchdetail_id' => 'required',
                'team1_score' => 'required|integer',
                'team2_score' => 'required|integer',
            ]);

            $existresult = MatchResult::where('matchdetail_id', $data['matchdetail_id'])->first();
            if($existresult)
            {
                return redirect()->back()->with('failure', 'Something went wrong');
            }
            $matchresult = MatchResult::create([
                'matchdetail_id' => $data['matchdetail_id'],
                'team1_score' => $data['team1_score'],
                'team2_score' => $data['team2_score'],
            ]);
            $matchresult->save();

            $matchdetail = MatchDetail::findorfail($data['matchdetail_id']);
            $matchdetail->update([
                'completed' => 1,
            ]);

            return redirect()->route('match.index')->with('success', 'Result Created');
        }else{
            return view('backend.permission.permission');
        }
    }

    public function editresult(Request $request, $id)
    {
        if($request->user()->can('manage-match')){
            $matchdetail = MatchDetail::where('id', $id)->with('team1', 'team2', 'matchtype', 'stadium')->first();
            $matchresult = MatchResult::where('matchdetail_id', $id)->first();
            return view('backend.matchdetails.editresult', compact('matchdetail', 'matchresult'));
        }else{
            return view('backend.permission.permission');
        }
    }

    public function updateresult(Request $request, $id)
    {
        $matchdetail = MatchDetail::findorfail($id);
        if($request['check'] == 1)
        {
            $matchresult = MatchResult::where('matchdetail_id', $matchdetail->id)->first();
            $matchresult->delete();
            $matchdetail->update([
                'completed' => 0,
            ]);
            return redirect()->route('match.index')->with('success', 'Result Reset');

        }
        else
        {
            $matchresult = MatchResult::where('matchdetail_id', $matchdetail->id)->first();
            $data = $this->validate($request, [
                'team1_score' => 'required|integer',
                'team2_score' => 'required|integer',
            ]);

            $matchresult->update([
                'team1_score' => $data['team1_score'],
                'team2_score' => $data['team2_score'],
            ]);

            return redirect()->route('match.completedindex')->with('success', 'Score Updated');
        }

    }
}
