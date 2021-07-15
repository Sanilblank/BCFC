<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->user()->can('manage-album')){
            if ($request->ajax()) {
                $data = Album::latest()->with('photos')->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('cover_image', function($row){
                        $src = Storage::disk('uploads')->url($row->cover_image);

                        $image = "<img src='$src' style='max-height:100px'>";
                        return $image;
                    })
                    ->addColumn('date', function($row){
                        return date('d F, Y', strtotime($row->date));
                    })

                    ->addColumn('action', function($row){
                        $showurl = route('album.show', $row->id);
                        $editurl = route('album.edit', $row->id);
                        $deleteurl = route('album.destroy', $row->id);
                        $csrf_token = csrf_token();
                        $btn = "<a href='$showurl' class='edit btn btn-warning btn-sm'>Show</a>
                                <a href='$editurl' class='edit btn btn-primary btn-sm'>Edit</a>
                               <form action='$deleteurl' method='POST' style='display:inline;'>
                                <input type='hidden' name='_token' value='$csrf_token'>
                                <input type='hidden' name='_method' value='DELETE' />
                                   <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                               </form>
                               ";

                                return $btn;
                    })
                    ->rawColumns(['cover_image', 'date', 'action'])
                    ->make(true);
            }
            return view('backend.album.index');
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
        if($request->user()->can('manage-album')){

            return view('backend.album.create');
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
            'title' => 'required',
            'date' => 'required|date',
            'cover_image' => 'required|mimes:png,jpg,jpeg',
        ]);

        $exists = Album::where('title', $data['title'])->first();
        if($exists)
        {
            return redirect()->back()->with('failure', 'Album Already Exists');
        }

        $albumcovername = '';
        if($request->hasFile('cover_image'))
        {
            $cover_image = $request->file('cover_image');
            $albumcovername = $cover_image->store('albumcover_image', 'uploads');
        }

        $album = Album::create([
            'title' => $data['title'],
            'cover_image' => $albumcovername,
            'date' => $data['date']
        ]);

        $album->save();

        return redirect()->route('album.index')->with('success', 'Album Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        if($request->user()->can('manage-album')){
            $album = Album::findorfail($id);

            if ($request->ajax()) {
                $data = Photo::latest()->where('album_id', $id)->with('album')->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function($row){
                        $src = Storage::disk('uploads')->url($row->image);

                        $image = "<img src='$src' style='max-height:100px'>";
                        return $image;
                    })

                    ->addColumn('action', function($row){


                        $deleteurl = route('photo.destroy', $row->id);
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
                    ->rawColumns(['image', 'action'])
                    ->make(true);
            }

            return view('backend.album.show', compact('album'));
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        if($request->user()->can('manage-album')){

            $album = Album::findorfail($id);
            return view('backend.album.edit', compact('album'));
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $album = Album::findorfail($id);
        $data = $this->validate($request, [
            'title' => 'required',
            'date' => 'required|date',
            'cover_image' => 'mimes:png,jpg,jpeg',
        ]);

        $albumcovername = '';
        if($request->hasFile('cover_image'))
        {
            Storage::disk('uploads')->delete($album->cover_image);
            $cover_image = $request->file('cover_image');
            $albumcovername = $cover_image->store('albumcover_image', 'uploads');
        }
        else
        {
            $albumcovername = $album->cover_image;
        }

        $album->update([
            'title' => $data['title'],
            'cover_image' => $albumcovername,
            'date' => $data['date']
        ]);



        return redirect()->route('album.index')->with('success', 'Album Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        if($request->user()->can('manage-album')){
            $album = Album::findorfail($id);
            Storage::disk('uploads')->delete($album->cover_image);
            $photos = Photo::where('album_id', $id)->get();
            foreach($photos as $photo)
            {
                Storage::disk('uploads')->delete($photo->image);
                $photo->delete();
            }
            $album->delete();
            return redirect()->back()->with('success', 'Album & its Photos Deleted Successfully');
        }else{
            return view('backend.permission.permission');
        }
    }
}
