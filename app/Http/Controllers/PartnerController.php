<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->user()->can('manage-partner')){
            if ($request->ajax()) {
                $data = Partner::latest()->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('logo', function($row){
                        $src = Storage::disk('uploads')->url($row->logo);

                        $image = "<img src='$src' style='max-height:100px'>";
                        return $image;
                    })
                    ->addColumn('link', function($row){
                        $link = "<a href='$row->link' target='_blank'>Click Here</a>";
                        return $link;
                    })

                    ->addColumn('action', function($row){
                        $editurl = route('partner.edit', $row->id);
                        $deleteurl = route('partner.destroy', $row->id);
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
                    ->rawColumns(['logo', 'link', 'action'])
                    ->make(true);
            }
            return view('backend.partner.index');
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
        if($request->user()->can('manage-partner')){
            return view('backend.partner.create');
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
            'name' => 'required|unique:partners,name',
            'logo' => 'required|mimes:png,jpg,jpeg',
            'link' => 'required',
        ]);

        $partnerlogoimage = '';
        if($request->hasFile('logo'))
        {
            $photo = $request->file('logo');
            $partnerlogoimage = $photo->store('partner_logo', 'uploads');
        }

        $partner = Partner::create([
            'name' => $data['name'],
            'logo' => $partnerlogoimage,
            'link' => $data['link'],
        ]);

        $partner->save();

        return redirect()->route('partner.index')->with('success', 'Partner Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        if($request->user()->can('manage-partner')){
            $partner = Partner::findorfail($id);
            return view('backend.partner.edit', compact('partner'));
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $partner = Partner::findorfail($id);
        $data = $this->validate($request, [
            'name' => 'required|unique:partners,name,' . $id,
            'logo' => 'mimes:png,jpg,jpeg',
            'link' => 'required',
        ]);

        $partnerlogoimage = '';
        if($request->hasFile('logo'))
        {
            $photo = $request->file('logo');
            Storage::disk('uploads')->delete($partner->logo);
            $partnerlogoimage = $photo->store('partner_logo', 'uploads');
        }
        else
        {
            $partnerlogoimage = $partner->logo;
        }

        $partner->update([
            'name' => $data['name'],
            'logo' => $partnerlogoimage,
            'link' => $data['link'],
        ]);

        return redirect()->route('partner.index')->with('success', 'Partner Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        if($request->user()->can('manage-partner')){
            $partner = Partner::findorfail($id);

            Storage::disk('uploads')->delete($partner->logo);
            $partner->delete();
            return redirect()->back()->with('success', 'Partner Deleted Successfully');
        }else{
            return view('backend.permission.permission');
        }
    }
}
