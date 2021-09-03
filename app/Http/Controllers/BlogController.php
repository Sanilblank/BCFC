<?php

namespace App\Http\Controllers;

use App\Jobs\SendSubscriberMail;
use App\Models\Blog;
use App\Models\BlogImage;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function Symfony\Component\VarDumper\Dumper\esc;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->user()->can('manage-blog')){
            if ($request->ajax()) {
                $data = Blog::latest()->where('draft', 0)->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function($row){
                        $src = Storage::disk('uploads')->url($row->image);

                        $image = "<img src='$src' style='max-height:100px'>";
                        return $image;
                    })
                    ->addColumn('tag', function ($row) {
                        $tags = $row->tag;
                        $reqtag = '';
                        foreach ($tags as $tag) {
                            $tagname = BlogTag::where('id', $tag)->first();
                            $reqtag .= '<span class="badge bg-green" style="background-color: green";>' . $tagname->name . '</span>' . ' ';
                        }
                        return $reqtag;
                    })
                    ->addColumn('date', function ($row) {
                        $date = date('Y/m/d h:i a', strtotime($row->date));
                        return $date;
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
                        $showurl = route('blog.show', $row->id);
                        $editurl = route('blog.edit', $row->id);
                        $deleteurl = route('blog.destroy', $row->id);
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
                    ->rawColumns(['image', 'tag', 'date', 'status', 'action'])
                    ->make(true);
            }
            return view('backend.blogs.index');
        }else{
                return view('backend.permission.permission');
        }
    }

    public function draftblog(Request $request)
    {
        //
        if($request->user()->can('manage-blog')){
            if ($request->ajax()) {
                $data = Blog::latest()->where('draft', 1)->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('title', function($row){
                        if($row->title != null)
                        {
                            $title = $row->title;
                        }
                        else
                        {
                            $title = "Empty";
                        }
                        return $title;
                    })
                    ->addColumn('image', function($row){
                        if($row->image != null)
                        {
                            $src = Storage::disk('uploads')->url($row->image);

                            $image = "<img src='$src' style='max-height:100px'>";
                        }
                        else
                        {
                            $image = "Empty";
                        }

                        return $image;
                    })
                    ->addColumn('tag', function ($row) {
                        if($row->tag != null)
                        {
                            $tags = $row->tag;
                            $reqtag = '';
                            foreach ($tags as $tag) {
                                $tagname = BlogTag::where('id', $tag)->first();
                                $reqtag .= '<span class="badge bg-green" style="background-color: green";>' . $tagname->name . '</span>' . ' ';
                            }
                        }
                        else
                        {
                            $reqtag = "Empty";
                        }

                        return $reqtag;
                    })
                    ->addColumn('date', function ($row) {
                        if($row->date != null)
                        {
                            $date = date('Y/m/d h:i a', strtotime($row->date));

                        }
                        else
                        {
                            $date = "Empty";
                        }
                        return $date;
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
                        $editurl = route('draftblog.edit', $row->id);
                        $deleteurl = route('blog.destroy', $row->id);
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
                    ->rawColumns(['title', 'image', 'tag', 'date', 'status', 'action'])
                    ->make(true);
            }
            return view('backend.blogs.draftblogindex');
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
        if($request->user()->can('manage-blog')){
            $images = BlogImage::where('user_id', Auth::user()->id)->where('blog_id',0)->get();
            return view('backend.blogs.create', compact('images'));
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
        if($request->user()->can('manage-blog')){
            if ($request->ajax()) {
                $this->validate($request,[
                    'file'=>'required|max:500'
                ]);

                $name = $request->file->store('blog_images','uploads');

                $i = new BlogImage;
                $i->location = $name;
                $i->blog_id = 0;
                $i->user_id = Auth::user()->id;
                $i->title = '';
                $i->save();

                return response()->json(['url'=>Storage::disk('uploads')->url($name),'id'=>$i->id]);
            };

            // $data = $this->validate($request, [
            //     'title'=>'required',
            //     'image'=>'required|mimes:png,jpg,jpeg',
            //     'tag'=>'required',
            //     'date'=>'required',
            //     'smalldesc'=>'required',
            //     'details'=>'required',
            //     'authorname'=>'required',
            //     'authorimage'=>'required|mimes:png,jpg,jpeg',
            // ]);

            if(empty($request['title']) || empty($request['image']) || empty($request['tag']) || empty($request['date']) || empty($request['smalldesc']) || empty($request['details']) || empty($request['authorname']) || empty($request['authorimage']) || $request->has('draft'))
            {
                $draft = 1;
            }
            else
            {
                $draft = 0;
            }

            if($request['status'] == null)
            {
                $status = 0;
            }
            else
            {
                $status = 1;
            }

            if(!empty($request['tag']))
            {
                $tags = explode(",", $request['tag']);
                $blogtags = array();
                foreach($tags as $tag)
                {
                    $existstag = BlogTag::where('name', $tag)->first();
                    if(!$existstag)
                    {
                        $inserttag = BlogTag::create([
                            'name'=>$tag,
                            'slug'=>Str::slug($tag),
                        ]);
                        $inserttag->save();
                    }
                }

                foreach($tags as $tag)
                {
                    $puttag = BlogTag::where('name', $tag)->first();
                    $blogtags[] = "$puttag->id";
                }
            }
            else
            {
                $blogtags = null;
            }


            if(!empty($request['image']))
            {
                $imagename = '';
                $image = $request->file('image');
                $imagename = $image->store('blog_photo', 'uploads');
            }
            else
            {
                $imagename = null;
            }

            if(!empty($request['authorimage']))
            {
                $authorimagename = '';
                $authorimage = $request->file('authorimage');
                $authorimagename = $authorimage->store('blogauthor_photo', 'uploads');
            }
            else
            {
                $authorimagename = null;
            }


                    $blog = Blog::create([
                        'title'=>$request['title'],
                        'image'=>$imagename,
                        'tag'=>$blogtags,
                        'date'=>$request['date'],
                        'smalldesc'=>$request['smalldesc'],
                        'details'=>$request['details'],
                        'authorname'=>$request['authorname'],
                        'authorimage'=>$authorimagename,
                        'status'=>$status,
                        'draft'=>$draft,
                    ]);
                    $blog->save();


                    $images = BlogImage::where('user_id',Auth::user()->id)->where('blog_id',0)->get();
                foreach($images as $image){
                    $image->title = $request['title'];
                    $image->blog_id = $blog->id;
                    $image->save();
                }

                if($draft == 0)
                {
                    SendSubscriberMail::dispatch($blog->id);
                    return redirect()->route('blog.index')->with('success', 'Created Successfully');
                }
                else
                {
                    return redirect()->route('blog.index')->with('success', 'Some fields were empty so stored as draft.');
                }

        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        if($request->user()->can('manage-blog')){
            $blog = Blog::findorfail($id);

            $tags = '';
            foreach($blog->tag as $tagid)
            {
                $reqtag = BlogTag::where('id', $tagid)->first();
                $tags .= $reqtag->name . ', ';
            }

            return view('backend.blogs.show', compact('blog', 'tags'));
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        if($request->user()->can('manage-blog')){
            $blog = Blog::findorfail($id);
            $tag = '';
            foreach($blog->tag as $foundtag)
            {
                $reqtag = BlogTag::where('id', $foundtag)->first();
                $tag .= $reqtag->name . ',';
            }
            return view('backend.blogs.edit', compact('blog', 'tag'));
        }else{
            return view('backend.permission.permission');
        }
    }

    public function draftblogedit(Request $request, $id)
    {
        //
        if($request->user()->can('manage-blog')){
            $blog = Blog::findorfail($id);
            if($blog->tag != null)
            {
                $tag = '';
                foreach($blog->tag as $foundtag)
                {
                    $reqtag = BlogTag::where('id', $foundtag)->first();
                    $tag .= $reqtag->name . ',';
                }
            }
            else
            {
                $tag = '';
            }

            return view('backend.blogs.draftblogedit', compact('blog', 'tag'));
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if($request->user()->can('manage-blog')){
            if ($request->ajax()) {
                $this->validate($request,[
                    'file'=>'required|max:500'
                ]);

                $name = $request->file->store('blog_images','uploads');

                $i = new BlogImage;
                $i->location = $name;
                $i->blog_id = 0;
                $i->user_id = Auth::user()->id;
                $i->title = '';
                $i->save();

                return response()->json(['url'=>Storage::disk('uploads')->url($name),'id'=>$i->id]);

            };

            $blog = Blog::findorfail($id);
            $data = $this->validate($request, [
                'title'=>'required',
                'tag'=>'required',
                'date'=>'required',
                'smalldesc'=>'required',
                'details'=>'required',
                'authorname'=>'required',
            ]);

            if($request['status'] == null)
            {
                $status = 0;
            }
            else
            {
                $status = 1;
            }

            $tags = explode(",", $data['tag']);
            $blogtags = array();
            foreach($tags as $tag)
            {
                $existstag = BlogTag::where('name', $tag)->first();
                if(!$existstag)
                {
                    $inserttag = BlogTag::create([
                        'name'=>$tag,
                        'slug'=>Str::slug($tag),
                    ]);
                    $inserttag->save();
                }
            }

            foreach($tags as $tag)
            {
                $puttag = BlogTag::where('name', $tag)->first();
                $blogtags[] = "$puttag->id";
            }

                $image_name = '';
                if ($request->hasfile('image')) {
                    $blogimage = $request->file('image');

                    Storage::disk('uploads')->delete($blog->image);
                    $image_name = $blogimage->store('blog_photo', 'uploads');
                } else {
                    $image_name = $blog->image;
                }

                $authorimage_name = '';
                if ($request->hasfile('authorimage')) {
                    $blogauthorimage = $request->file('authorimage');

                    Storage::disk('uploads')->delete($blog->authorimage);
                    $authorimage_name = $blogauthorimage->store('blogauthor_photo', 'uploads');
                } else {
                    $authorimage_name = $blog->authorimage;
                }

            $blog->update([
                'title'=>$data['title'],
                'image'=>$image_name,
                'tag'=>$blogtags,
                'date'=>$data['date'],
                'smalldesc'=>$data['smalldesc'],
                'details'=>$data['details'],
                'authorname'=>$data['authorname'],
                'authorimage'=>$authorimage_name,
                'status'=>$status,
            ]);

            $images = BlogImage::where('user_id',Auth::user()->id)->where('blog_id',0)->get();
                foreach($images as $image){
                    $image->title = $data['title'];
                    $image->blog_id = $blog->id;
                    $image->save();
                }

            return redirect()->route('blog.index')->with('success', 'Blog Contents Updated');

        }else{
            return view('backend.permission.permission');
        }
    }

    public function draftblogupdate(Request $request, $id)
    {
        //
        if($request->user()->can('manage-blog')){
            if ($request->ajax()) {
                $this->validate($request,[
                    'file'=>'required|max:500'
                ]);

                $name = $request->file->store('blog_images','uploads');

                $i = new BlogImage;
                $i->location = $name;
                $i->blog_id = 0;
                $i->user_id = Auth::user()->id;
                $i->title = '';
                $i->save();

                return response()->json(['url'=>Storage::disk('uploads')->url($name),'id'=>$i->id]);

            };

            $blog = Blog::findorfail($id);
            // $data = $this->validate($request, [
            //     'title'=>'required',
            //     'tag'=>'required',
            //     'date'=>'required',
            //     'smalldesc'=>'required',
            //     'details'=>'required',
            //     'authorname'=>'required',
            // ]);

            if(empty($request['title']) || empty($request['tag']) || empty($request['date']) || empty($request['smalldesc']) || empty($request['details']) || empty($request['authorname']) || $request->has('draft'))
            {
                $draft = 1;
            }
            else
            {
                $draft = 0;
            }

            if($request['status'] == null)
            {
                $status = 0;
            }
            else
            {
                $status = 1;
            }

            if(!empty($request['tag']))
            {
                $tags = explode(",", $request['tag']);
                $blogtags = array();
                foreach($tags as $tag)
                {
                    $existstag = BlogTag::where('name', $tag)->first();
                    if(!$existstag)
                    {
                        $inserttag = BlogTag::create([
                            'name'=>$tag,
                            'slug'=>Str::slug($tag),
                        ]);
                        $inserttag->save();
                    }
                }

                foreach($tags as $tag)
                {
                    $puttag = BlogTag::where('name', $tag)->first();
                    $blogtags[] = "$puttag->id";
                }
            }
            else
            {
                $blogtags = null;
            }



                $image_name = '';
                if ($request->hasfile('image')) {
                    $blogimage = $request->file('image');

                    Storage::disk('uploads')->delete($blog->image);
                    $image_name = $blogimage->store('blog_photo', 'uploads');
                } else {
                    $image_name = $blog->image;
                }

                if($image_name == null)
                {
                    $draft = 1;
                }

                $authorimage_name = '';
                if ($request->hasfile('authorimage')) {
                    $blogauthorimage = $request->file('authorimage');

                    Storage::disk('uploads')->delete($blog->authorimage);
                    $authorimage_name = $blogauthorimage->store('blogauthor_photo', 'uploads');
                } else {
                    $authorimage_name = $blog->authorimage;
                }

                if($authorimage_name == null)
                {
                    $draft = 1;
                }

            $blog->update([
                'title'=>$request['title'],
                'image'=>$image_name,
                'tag'=>$blogtags,
                'date'=>$request['date'],
                'smalldesc'=>$request['smalldesc'],
                'details'=>$request['details'],
                'authorname'=>$request['authorname'],
                'authorimage'=>$authorimage_name,
                'status'=>$status,
                'draft'=>$draft,
            ]);

            $images = BlogImage::where('user_id',Auth::user()->id)->where('blog_id',0)->get();
                foreach($images as $image){
                    $image->title = $request['title'];
                    $image->blog_id = $blog->id;
                    $image->save();
                }

                if($draft == 0)
                {
                    return redirect()->route('blog.index')->with('success', 'Contents Updated as non draft');
                }
                else
                {
                    return redirect()->route('draftblog.index')->with('success', 'Some fields were empty so stored as draft');
                }


        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        if($request->user()->can('manage-blog')){
            $blog = Blog::findorfail($id);
            Storage::disk('uploads')->delete($blog->image);
            Storage::disk('uploads')->delete($blog->authorimage);
            $blog->delete();

            $blogImages = BlogImage::where('blog_id', $id)->get();
            if(count($blogImages) > 0)
            {
                foreach ($blogImages as $blogImage) {
                    Storage::disk('uploads')->delete($blogImage->location);
                    $blogImage->delete();
                }
            }

            return redirect()->back()->with('success', 'Blog Deleted Successfully');
        }else{
            return view('backend.permission.permission');
        }
    }

    public function draftblogdestroy(Request $request, $id)
    {
        //
        if($request->user()->can('manage-blog')){
            $blog = Blog::findorfail($id);
            Storage::disk('uploads')->delete($blog->image);
            Storage::disk('uploads')->delete($blog->authorimage);
            $blog->delete();

            $blogImages = BlogImage::where('blog_id', $id)->get();
            if(count($blogImages) > 0)
            {
                foreach ($blogImages as $blogImage) {
                    Storage::disk('uploads')->delete($blogImage->location);
                    $blogImage->delete();
                }
            }

            return redirect()->back()->with('success', 'Deleted Successfully');
        }else{
            return view('backend.permission.permission');
        }
    }
}
