<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogTag;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function index()
    {
        $latestblog = Blog::latest()->where('status', 1)->where('draft', 0)->first();
        $latestthreeblogs = Blog::latest()->where('status', 1)->where('id', '!=', $latestblog->id)->where('draft', 0)->take(2)->get();
        $latestblogs = Blog::latest()->where('status', 1)->where('draft', 0)->skip(3)->take(16)->get();
        return view('frontend.index', compact('latestthreeblogs', 'latestblogs', 'latestblog'));
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

        return view('frontend.news-details', compact('selectedblog', 'latesttags', 'previousblog', 'nextblog', 'latestblogs'));
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
        return view('frontend.aboutus');
    }

    public function teaminfo()
    {
        return view('frontend.team');
    }
}
