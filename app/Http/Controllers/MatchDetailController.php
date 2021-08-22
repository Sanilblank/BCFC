<?php

namespace App\Http\Controllers;

use App\Models\MatchDetail;
use App\Models\MatchResult;
use App\Models\MatchScoreDetail;
use App\Models\MatchStadium;
use App\Models\MatchType;
use App\Models\Team;
use App\Models\TeamMatchType;
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

        $canbemade = TeamMatchType::where('team_id', $data['team1_id'])->where('matchtype_id', $data['matchtype_id'])->first();
        if(!$canbemade)
        {
            return redirect()->back()->with('failure', 'Selected Team cannot play in selected matchtype. Please update from teams or matchtype page first.');
        }

        $canbemade2 = TeamMatchType::where('team_id', $data['team2_id'])->where('matchtype_id', $data['matchtype_id'])->first();
        if(!$canbemade2)
        {
            return redirect()->back()->with('failure', 'Selected Team cannot play in selected matchtype. Please update from teams or matchtype page first.');
        }

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

        $canbemade = TeamMatchType::where('team_id', $data['team1_id'])->where('matchtype_id', $data['matchtype_id'])->first();
        if(!$canbemade)
        {
            return redirect()->back()->with('failure', 'Selected Team cannot play in selected matchtype. Please update from teams or matchtype page first.');
        }

        $canbemade2 = TeamMatchType::where('team_id', $data['team2_id'])->where('matchtype_id', $data['matchtype_id'])->first();
        if(!$canbemade2)
        {
            return redirect()->back()->with('failure', 'Selected Team cannot play in selected matchtype. Please update from teams or matchtype page first.');
        }

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
            $playernamecount1 = count($request['playername']);
            $timecount1 = count($request['time']);
            $playernamecount2 = count($request['playername2']);
            $timecount2 = count($request['time2']);

            $existresult = MatchResult::where('matchdetail_id', $data['matchdetail_id'])->first();
            if($existresult)
            {
                return redirect()->back()->with('failure', 'Something went wrong');
            }

            if($data['team1_score'] > 0)
            {
                if($playernamecount1 != $data['team1_score'] || $timecount1 != $data['team1_score'])
                {
                    return redirect()->back()->with('failure', 'No of goals made and details given do not match for team1');
                }
            }

            if($data['team2_score'] > 0)
            {
                if($playernamecount2 != $data['team2_score'] || $timecount2 != $data['team2_score'])
                {
                    return redirect()->back()->with('failure', 'No of goals made and details given do not match for team2');
                }
            }

            if($data['team1_score'] > 0)
            {
                for($i=0;$i<$playernamecount1;$i++)
                {
                    if($request['playername'][$i] == null)
                    {
                        return redirect()->back()->with('failure', 'Field cannot be empty');
                    }
                }
                for($i=0;$i<$timecount1;$i++)
                {
                    if($request['time'][$i] == null)
                    {
                        return redirect()->back()->with('failure', 'Field cannot be empty');
                    }
                }
            }

            if($data['team2_score'] > 0)
            {
                for($i=0;$i<$playernamecount2;$i++)
                {
                    if($request['playername2'][$i] == null)
                    {
                        return redirect()->back()->with('failure', 'Field cannot be empty');
                    }
                }
                for($i=0;$i<$timecount2;$i++)
                {
                    if($request['time2'][$i] == null)
                    {
                        return redirect()->back()->with('failure', 'Field cannot be empty');
                    }
                }
            }

            $matchresult = MatchResult::create([
                'matchdetail_id' => $data['matchdetail_id'],
                'team1_score' => $data['team1_score'],
                'team2_score' => $data['team2_score'],
            ]);
            $matchresult->save();

            if($data['team1_score'] > 0)
            {
                for($i=0;$i<$playernamecount1;$i++)
                {
                    $team1scoredetails = MatchScoreDetail::create([
                        'matchdetail_id' => $data['matchdetail_id'],
                        'team' => 1,
                        'name' => $request['playername'][$i],
                        'time' => $request['time'][$i],
                    ]);
                    $team1scoredetails->save();
                }
            }

            if($data['team2_score'] > 0)
            {
                for($i=0;$i<$playernamecount2;$i++)
                {
                    $team2scoredetails = MatchScoreDetail::create([
                        'matchdetail_id' => $data['matchdetail_id'],
                        'team' => 2,
                        'name' => $request['playername2'][$i],
                        'time' => $request['time2'][$i],
                    ]);
                    $team2scoredetails->save();
                }
            }
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
            $team1scoredetails = MatchScoreDetail::where('matchdetail_id', $id)->where('team', 1)->orderBy('time', 'asc')->get();
            $team2scoredetails = MatchScoreDetail::where('matchdetail_id', $id)->where('team', 2)->orderBy('time', 'asc')->get();
            return view('backend.matchdetails.editresult', compact('matchdetail', 'matchresult', 'team1scoredetails', 'team2scoredetails'));
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
            $teamscoredetails = MatchScoreDetail::where('matchdetail_id', $matchdetail->id)->get();
            if(count($teamscoredetails) > 0)
            {
                foreach($teamscoredetails as $teamscoredetail)
                {
                    $teamscoredetail->delete();
                }
            }
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

            if(($data['team1_score'] != $matchresult->team1_score && $request['team1scorereset'] != 1) || ($data['team2_score'] != $matchresult->team2_score && $request['team2scorereset'] != 1))
            {
                return redirect()->back()->with('failure', 'You need to reset the score result if you want to change no of goals.');
            }

            if($request['team1scorereset'] == 1)
            {
                $playernamecount1 = count($request['playername']);
                $timecount1 = count($request['time']);

                if($data['team1_score'] > 0)
                {
                    if($playernamecount1 != $data['team1_score'] || $timecount1 != $data['team1_score'])
                    {
                        return redirect()->back()->with('failure', 'No of goals made and details given do not match for team1');
                    }
                }

                if($data['team1_score'] > 0)
                {
                    for($i=0;$i<$playernamecount1;$i++)
                    {
                        if($request['playername'][$i] == null)
                        {
                            return redirect()->back()->with('failure', 'Field cannot be empty');
                        }
                    }
                    for($i=0;$i<$timecount1;$i++)
                    {
                        if($request['time'][$i] == null)
                        {
                            return redirect()->back()->with('failure', 'Field cannot be empty');
                        }
                    }
                }

                $team1scoredetails = MatchScoreDetail::where('matchdetail_id', $matchdetail->id)->where('team', 1)->get();
                if(count($team1scoredetails) > 0)
                {
                    foreach($team1scoredetails as $team1scoredetail)
                    {
                        $team1scoredetail->delete();
                    }
                }

                if($data['team1_score'] > 0)
                {
                    for($i=0;$i<$playernamecount1;$i++)
                    {
                        $team1scoredetails = MatchScoreDetail::create([
                            'matchdetail_id' => $matchdetail->id,
                            'team' => 1,
                            'name' => $request['playername'][$i],
                            'time' => $request['time'][$i],
                        ]);
                        $team1scoredetails->save();
                    }
                }

            }

            if($request['team2scorereset'] == 1)
            {
                $playernamecount2 = count($request['playername2']);
                $timecount2 = count($request['time2']);

                if($data['team2_score'] > 0)
                {
                    if($playernamecount2 != $data['team2_score'] || $timecount2 != $data['team2_score'])
                    {
                        return redirect()->back()->with('failure', 'No of goals made and details given do not match for team2');
                    }
                }

                if($data['team2_score'] > 0)
                {
                    for($i=0;$i<$playernamecount2;$i++)
                    {
                        if($request['playername2'][$i] == null)
                        {
                            return redirect()->back()->with('failure', 'Field cannot be empty');
                        }
                    }
                    for($i=0;$i<$timecount2;$i++)
                    {
                        if($request['time2'][$i] == null)
                        {
                            return redirect()->back()->with('failure', 'Field cannot be empty');
                        }
                    }
                }

                $team2scoredetails = MatchScoreDetail::where('matchdetail_id', $matchdetail->id)->where('team', 2)->get();
                if(count($team2scoredetails) > 0)
                {
                    foreach($team2scoredetails as $team2scoredetail)
                    {
                        $team2scoredetail->delete();
                    }
                }

                if($data['team2_score'] > 0)
                {
                    for($i=0;$i<$playernamecount2;$i++)
                    {
                        $team2scoredetails = MatchScoreDetail::create([
                            'matchdetail_id' => $matchdetail->id,
                            'team' => 1,
                            'name' => $request['playername2'][$i],
                            'time' => $request['time2'][$i],
                        ]);
                        $team2scoredetails->save();
                    }
                }

            }

            $matchresult->update([
                'team1_score' => $data['team1_score'],
                'team2_score' => $data['team2_score'],
            ]);

            return redirect()->route('match.completedindex')->with('success', 'Score Updated');
        }

    }
}
