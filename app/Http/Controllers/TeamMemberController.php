<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Models\TeamPosition;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TeamMemberController extends Controller
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
                $data = TeamMember::latest()->with('teamposition')->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('photo', function($row){
                        $src = Storage::disk('uploads')->url($row->photo);

                        $image = "<img src='$src' style='max-height:100px'>";
                        return $image;
                    })
                    ->addColumn('position', function($row){
                        return $row->teamposition->name;
                    })

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

                        $editurl = route('teammember.edit', $row->id);
                        $deleteurl = route('teammember.destroy', $row->id);
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
                    ->rawColumns(['photo', 'position', 'date', 'status', 'action'])
                    ->make(true);
            }
            return view('backend.teammember.index');
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
            $positions = TeamPosition::latest()->get();
            return view('backend.teammember.create', compact('positions'));
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
            'photo' => 'required|mimes:png,jpg,jpeg',
            'teamposition_id' => 'required',
            'shirtno' => 'required|integer',
            'hometown' => 'required',
        ]);

        if($request['status'] == null)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        $memberimagename = '';
        if($request->hasFile('photo'))
        {
            $photo = $request->file('photo');
            $memberimagename = $photo->store('teammember_photo', 'uploads');
        }

        $teammember = TeamMember::create([
            'name' => $data['name'],
            'photo' => $memberimagename,
            'shirtno' => $data['shirtno'],
            'hometown' => $data['hometown'],
            'teamposition_id' => $data['teamposition_id'],
            'slug' => Str::slug($data['name']),
            'status' => $status,
        ]);

        $teammember->save();

        return redirect()->route('teammember.index')->with('success', 'Member Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function show(TeamMember $teamMember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        if($request->user()->can('manage-team')){
            $teammember = TeamMember::findorfail($id);
            $positions = TeamPosition::latest()->get();
            return view('backend.teammember.edit', compact('positions', 'teammember'));
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $teammember = TeamMember::findorfail($id);
        $data = $this->validate($request, [
            'name' => 'required',
            'photo' => 'mimes:png,jpg,jpeg',
            'teamposition_id' => 'required',
            'shirtno' => 'required|integer',
            'hometown' => 'required',
        ]);

        if($request['status'] == null)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        $memberimagename = '';
        if($request->hasFile('photo'))
        {
            $photo = $request->file('photo');
            Storage::disk('uploads')->delete($teammember->photo);
            $memberimagename = $photo->store('teammember_photo', 'uploads');
        }
        else
        {
            $memberimagename = $teammember->photo;
        }

        $teammember->update([
            'name' => $data['name'],
            'photo' => $memberimagename,
            'shirtno' => $data['shirtno'],
            'hometown' => $data['hometown'],
            'teamposition_id' => $data['teamposition_id'],
            'slug' => Str::slug($data['name']),
            'status' => $status,
        ]);

        return redirect()->route('teammember.index')->with('success', 'Member Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        if($request->user()->can('manage-team')){
            $teammember = TeamMember::findorfail($id);
            Storage::disk('uploads')->delete($teammember->photo);
            $teammember->delete();
            return redirect()->back()->with('success', 'Member Deleted Successfully');
        }else{
            return view('backend.permission.permission');
        }
    }
}
