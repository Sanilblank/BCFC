<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;

class MerchandiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->user()->can('manage-merchandise')){
            if ($request->ajax()) {
                $data = Merchandise::latest()->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function($row){
                        $src = Storage::disk('uploads')->url($row->image);

                        $image = "<img src='$src' style='max-height:100px'>";
                        return $image;
                    })
                    ->addColumn('link', function($row){
                        $link = "<a href = $row->link>Click Here</a>";
                        return $link;
                    })
                    ->addColumn('action', function($row){

                        $editurl = route('merchandise.edit', $row->id);
                        $deleteurl = route('merchandise.destroy', $row->id);
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
                    ->rawColumns(['image', 'link', 'action'])
                    ->make(true);
            }
            return view('backend.merchandise.index');
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
        if($request->user()->can('manage-merchandise')){
            $merch = Merchandise::first();
            return view('backend.merchandise.create', compact('merch'));
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
            'image' => 'required|mimes:png,jpg,jpeg',
            'price' => 'required',
            'link' => 'required'
        ]);

        $merchimage = '';
        if($request->hasFile('image'))
        {
            $photo = $request->file('image');
            $merchimage = $photo->store('merchandise_image', 'uploads');
        }

        $merchandise = Merchandise::create([
            'name' => $data['name'],
            'image' => $merchimage,
            'price' => $data['price'],
            'link' => $data['link'],
        ]);

        $merchandise->save();

        return redirect()->route('merchandise.index')->with('success', 'Merchandise Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Merchandise  $merchandise
     * @return \Illuminate\Http\Response
     */
    public function show(Merchandise $merchandise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Merchandise  $merchandise
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        if($request->user()->can('manage-merchandise')){
            $merch = Merchandise::findorfail($id);
            return view('backend.merchandise.edit', compact('merch'));
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Merchandise  $merchandise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $merchandise = Merchandise::findorfail($id);
        $data = $this->validate($request, [
            'name' => 'required',
            'image' => 'mimes:png,jpg,jpeg',
            'price' => 'required',
            'link' => 'required'
        ]);

        $merchimage = '';
        if($request->hasFile('image'))
        {
            $photo = $request->file('image');
            Storage::disk('uploads')->delete($merchandise->image);
            $merchimage = $photo->store('merchandise_image', 'uploads');
        }
        else
        {
            $merchimage = $merchandise->image;
        }

        $merchandise->update([
            'name' => $data['name'],
            'image' => $merchimage,
            'price' => $data['price'],
            'link' => $data['link'],
        ]);

        return redirect()->route('merchandise.index')->with('success', 'Merchandise Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Merchandise  $merchandise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        if($request->user()->can('manage-merchandise')) {
            $merchandise = Merchandise::findorfail($id);
            Storage::disk('uploads')->delete($merchandise->image);
            $merchandise->delete();
            return redirect()->back()->with('success', 'Merchandise Deleted Successfully.');
        }else{
            return view('backend.permission.permission');
        }
    }
}
