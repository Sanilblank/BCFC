<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Blog;
use App\Models\BlogTag;
use App\Models\Comment;
use App\Models\Photo;
use App\Models\Reply;
use App\Models\Slider;
use App\Models\TeamMember;
use App\Models\TeamPosition;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function index()
    {
        $latestblog = Blog::latest()->where('status', 1)->where('draft', 0)->first();
        $latestthreeblogs = Blog::latest()->where('status', 1)->where('id', '!=', $latestblog->id)->where('draft', 0)->take(2)->get();
        $latestblogs = Blog::latest()->where('status', 1)->where('draft', 0)->skip(3)->take(16)->get();
        $teammembers = TeamMember::latest()->where('status', 1)->with('teamposition')->get();
        $sliders = Slider::latest()->get();
        return view('frontend.index', compact('latestthreeblogs', 'latestblogs', 'latestblog', 'teammembers', 'sliders'));
    }

    public function getnews()
    {
        $blogs = Blog::latest()->where('status', 1)->where('draft', 0)->simplePaginate(5);
        $latesttags = BlogTag::latest()->take(10)->get();
        $latestblogs = Blog::latest()->where('status', 1)->where('draft', 0)->take(16)->get();

        return view('frontend.news', compact('blogs', 'latesttags', 'latestblogs'));
    }

    public function gettagnews($id, $slug)
    {
        $selectedtag = BlogTag::findorfail($id);
        $blogs = Blog::latest()->where('status', 1)->where('draft', 0)->whereJsonContains('tag', $id)->simplePaginate(5);
        $latesttags = BlogTag::latest()->take(10)->get();
        $latestblogs = Blog::latest()->where('status', 1)->where('draft', 0)->take(16)->get();

        return view('frontend.tagnews', compact('blogs', 'latesttags', 'selectedtag', 'latestblogs'));
    }

    public function getauthornews($name)
    {
        $blogs = Blog::latest()->where('status', 1)->where('authorname', $name)->simplePaginate(5);
        $latesttags = BlogTag::latest()->take(10)->get();
        $latestblogs = Blog::latest()->where('status', 1)->take(16)->get();

        return view('frontend.authornews', compact('blogs', 'latesttags', 'name', 'latestblogs'));
    }

    public function newsdetails($id, $slug)
    {
        $selectedblog = Blog::findorfail($id);
        $latesttags = BlogTag::latest()->take(10)->get();
        $previousblog = Blog::where('id', '<', $id)->orderBy('id', 'DESC')->where('status', 1)->where('draft', 0)->first();
        $nextblog = Blog::where('id', '>', $id)->orderBy('id', 'ASC')->where('status', 1)->where('draft', 0)->first();

        $selectedblog->update([
            'view_count' => $selectedblog->view_count + 1,
        ]);

        $latestblogs = Blog::latest()->where('status', 1)->where('draft', 0)->take(16)->get();

        $noofcomments = Comment::where('blog_id', $selectedblog->id)->where('status', 1)->count();
        $comments = Comment::latest()->where('blog_id', $selectedblog->id)->where('status', 1)->with('replies', 'enabledreplies')->take(10)->get();
        if($noofcomments > 10)
        {
            $othercomments = Comment::latest()->where('blog_id', $selectedblog->id)->where('status', 1)->with('replies', 'enabledreplies')->skip(1)->take($noofcomments - 10)->get();
        }
        else
        {
            $othercomments = "None";
        }

        return view('frontend.news-details', compact('selectedblog', 'latesttags', 'previousblog', 'nextblog', 'latestblogs', 'noofcomments', 'comments', 'othercomments'));
    }

    public function pageSearch(Request $request)
    {
        $this->validate($request,[
            'word'=>'required',
        ]);

        $searchword = $request['word'];
        $blogs = Blog::latest()->where('status', 1)->where('draft', 0)
        ->where(function ($query) use ($searchword) {
            $query->where('title', 'LIKE', '%' . $searchword . '%')
                  ->orWhere('details', 'LIKE', '%' . $searchword . '%');
        })
        ->simplePaginate(5);

        $latesttags = BlogTag::latest()->take(10)->get();
        $latestblogs = Blog::latest()->where('status', 1)->where('draft', 0)->take(16)->get();

        return view('frontend.searchednews', compact('blogs', 'latesttags', 'searchword', 'latestblogs'));
    }

    public function aboutus()
    {
        $latestblogs = Blog::latest()->where('status', 1)->where('draft', 0)->take(16)->get();
        return view('frontend.aboutus', compact('latestblogs'));
    }

    public function addComment(Request $request)
    {
        $data = $this->validate($request, [
            'blog_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'comment' => 'required',
        ]);

        $comment = Comment::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'comment' => $data['comment'],
            'status' => 1,
            'blog_id' => $data['blog_id']
        ]);

        $comment->save();
        return redirect()->back()->with('success', 'Comment Added.');
    }

    public function addReply(Request $request)
    {
        $data = $this->validate($request, [
            'comment_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'reply' => 'required',
        ]);

        $reply = Reply::create([
            'comment_id' => $data['comment_id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'reply' => $data['reply'],
            'status' => 1,
        ]);

        $reply->save();
        return redirect()->back()->with('success', 'Reply Added.');
    }

    public function teaminfo()
    {
        $teammembers = TeamMember::latest()->where('status', 1)->with('teamposition')->get();
        $teampositions = TeamPosition::latest()->get();
        $latestblogs = Blog::latest()->where('status', 1)->where('draft', 0)->take(16)->get();
        return view('frontend.team', compact('teammembers', 'teampositions', 'latestblogs'));
    }


    public function viewalbums()
    {
        $albums = Album::latest()->simplePaginate(12);
        return view('frontend.album', compact('albums'));
    }

    public function viewgallery($id, $slug)
    {
        $album = Album::findorfail($id);
        $photos = Photo::latest()->where('album_id', $id)->get();
        return view('frontend.gallery', compact('photos', 'album'));
    }

    public function sliderinfo($id, $slug)
    {
        $slider = Slider::findorfail($id);
        $latestblogs = Blog::latest()->where('status', 1)->where('draft', 0)->take(16)->get();
        return view('frontend.slider', compact('slider', 'latestblogs'));
    }

    public function viewmerch()
    {
        return view('frontend.merch');
    }
}
