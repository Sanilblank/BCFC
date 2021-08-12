<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\SliderImage;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->user()->can('manage-setting')){
            if ($request->ajax()) {
                $data = Slider::latest()->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('images', function($row){
                            $src = Storage::disk('uploads')->url($row->images);

                        $image = "<img src='$src' style='max-height:100px'>";
                        return $image;
                    })
                    ->addColumn('description', function($row){
                        $description = substr($row->description, 0, 16) .  '....';
                        return $description;
                    })
                    ->addColumn('action', function($row){
                        $showurl = route('slider.show', $row->id);
                        $editurl = route('slider.edit', $row->id);
                        $deleteurl = route('slider.destroy', $row->id);
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
                    ->rawColumns(['images', 'description', 'action'])
                    ->make(true);
            }

            return view('backend.slider.index');
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
        if($request->user()->can('manage-setting')){
            $images = SliderImage::where('user_id', Auth::user()->id)->where('slider_id',0)->get();
            return view('backend.slider.create', compact('images'));
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
        if($request->user()->can('manage-setting')){
            if ($request->ajax()) {
                $this->validate($request,[
                    'file'=>'required|max:500'
                ]);

                $name = $request->file->store('sliderdescription_images','uploads');

                $i = new SliderImage;
                $i->location = $name;
                $i->slider_id = 0;
                $i->user_id = Auth::user()->id;
                $i->title = '';
                $i->save();

                return response()->json(['url'=>Storage::disk('uploads')->url($name),'id'=>$i->id]);
            };

            $data = $this->validate($request, [
                'subtitle' => 'required',
                'title' =>'required',
                'description'=>'required',
                'images' =>'required|mimes:png,jpg,jpeg',

            ]);

            $imagename = '';
            if($request->hasfile('images')){
                $images = $request->file('images');

                    $imagename = $images->store('slider_images', 'uploads');
            }
            $slider = Slider::create([
                'subtitle' => $data['subtitle'],
                'title' => $data['title'],
                'description' => $data['description'],
                'images' => $imagename,
            ]);
            $slider->save();


                    $images = SliderImage::where('user_id',Auth::user()->id)->where('slider_id',0)->get();
                foreach($images as $image){
                    $image->title = $data['title'];
                    $image->slider_id = $slider->id;
                    $image->save();
                }


            return redirect()->route('slider.index')->with('success', 'Slider Created Successfully');
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        if($request->user()->can('manage-setting')){
            $slider = Slider::findorfail($id);

            return view('backend.slider.show', compact('slider'));
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        if($request->user()->can('manage-setting')){
            $slider = Slider::findorfail($id);

            return view('backend.slider.edit', compact('slider'));
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if($request->user()->can('manage-setting')){
            if ($request->ajax()) {
                $this->validate($request,[
                    'file'=>'required|max:500'
                ]);

                $name = $request->file->store('sliderdescription_images','uploads');

                $i = new SliderImage;
                $i->location = $name;
                $i->slider_id = 0;
                $i->user_id = Auth::user()->id;
                $i->title = '';
                $i->save();

                return response()->json(['url'=>Storage::disk('uploads')->url($name),'id'=>$i->id]);

            };

            $slider = Slider::findorfail($id);
            $data = $this->validate($request, [
                'subtitle' => 'required',
                'title' =>'required',
                'description'=>'required',
                'images' =>'mimes:png,jpg,jpeg',

            ]);
            $imagename = '';
            if($request->hasfile('images')){
                $images = $request->file('images');

                $imagename = $images->store('slider_images', 'uploads');
            }
            else
            {
                $imagename = $slider->images;
            }


            $slider->update([
                'subtitle' => $data['subtitle'],
                'title' => $data['title'],
                'description' => $data['description'],
                'images' => $imagename,
            ]);

            $images = SliderImage::where('user_id',Auth::user()->id)->where('slider_id',0)->get();
                foreach($images as $image){
                    $image->title = $data['title'];
                    $image->slider_id = $slider->id;
                    $image->save();
                }

            return redirect()->route('slider.index')->with('success', 'Slider Contents Updated');

        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        if($request->user()->can('manage-setting')){
            $slider = Slider::findorfail($id);
            Storage::disk('uploads')->delete($slider->images);

            $slider->delete();

            $sliderImages = SliderImage::where('slider_id', $id)->get();
            if(count($sliderImages) > 0)
            {
                foreach ($sliderImages as $sliderImage) {
                    Storage::disk('uploads')->delete($sliderImage->location);
                    $sliderImage->delete();
                }
            }

            return redirect()->back()->with('success', 'Slider Contents Deleted Successfully');
        }else{
            return view('backend.permission.permission');
        }
    }
}
