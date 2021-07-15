<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'album_id' => 'required',
            'images' =>'required',
            'images.*' => 'mimes:jpg,jpeg,png'
        ]);

        $imagename = '';
        if($request->hasfile('images')){
            $images = $request->file('images');
            foreach($images as $image){
                $imagename = $image->store('album_images', 'uploads');

                $photo = Photo::create([
                    'album_id' => $data['album_id'],
                    'image' => $imagename,
                ]);
                $photo->save();
            }
        }

        return redirect()->route('album.show', $data['album_id'])->with('success', 'Photos Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
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
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        if($request->user()->can('manage-album')){
            $photo = Photo::findorfail($id);
            Storage::disk('uploads')->delete($photo->image);
            $photo->delete();
            return redirect()->back()->with('success', 'Photo Deleted Successfully');
        }else{
            return view('backend.permission.permission');
        }
    }
}
