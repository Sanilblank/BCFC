<?php

namespace App\Http\Controllers;

use App\Jobs\SendSubscriberMail;
use App\Mail\ContactMail;
use App\Mail\RegisterSubscriber;
use App\Models\Album;
use App\Models\Blog;
use App\Models\BlogTag;
use App\Models\Comment;
use App\Models\MatchDetail;
use App\Models\MatchStanding;
use App\Models\MatchType;
use App\Models\Partner;
use App\Models\Photo;
use App\Models\Reply;
use App\Models\Slider;
use App\Models\Subscriber;
use App\Models\TeamMember;
use App\Models\TeamPosition;
use App\Notifications\NewSubscriberNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $nextmatch = MatchDetail::where('completed', 0)->orderBy('datetime', 'asc')->with('team1', 'team2', 'matchtype', 'stadium', 'matchresult')->first();
        $lastmatch = MatchDetail::where('completed', 1)->orderBy('datetime', 'desc')->with('team1', 'team2', 'matchtype', 'stadium', 'matchresult')->first();
        $matchtype = MatchType::first();
        $standings = MatchStanding::where('matchtype_id', $matchtype->id)->with('team', 'matchtype')->get();
        $pictures = Photo::with('album')->inRandomOrder()->limit(6)->get();
        $partners = Partner::latest()->get();
        return view('frontend.index', compact('latestthreeblogs', 'latestblogs', 'latestblog', 'teammembers', 'sliders', 'nextmatch', 'lastmatch', 'standings', 'pictures', 'partners'));
    }

    public function getnews()
    {
        $blogs = Blog::latest()->where('status', 1)->where('draft', 0)->simplePaginate(5);
        $latesttags = BlogTag::latest()->take(10)->get();
        $latestblogs = Blog::latest()->where('status', 1)->where('draft', 0)->take(16)->get();
        $partners = Partner::latest()->get();

        return view('frontend.news', compact('blogs', 'latesttags', 'latestblogs', 'partners'));
    }

    public function gettagnews($id, $slug)
    {
        $selectedtag = BlogTag::findorfail($id);
        $blogs = Blog::latest()->where('status', 1)->where('draft', 0)->whereJsonContains('tag', $id)->simplePaginate(5);
        $latesttags = BlogTag::latest()->take(10)->get();
        $latestblogs = Blog::latest()->where('status', 1)->where('draft', 0)->take(16)->get();
        $partners = Partner::latest()->get();

        return view('frontend.tagnews', compact('blogs', 'latesttags', 'selectedtag', 'latestblogs', 'partners'));
    }

    public function getauthornews($name)
    {
        $blogs = Blog::latest()->where('status', 1)->where('authorname', $name)->simplePaginate(5);
        $latesttags = BlogTag::latest()->take(10)->get();
        $latestblogs = Blog::latest()->where('status', 1)->take(16)->get();
        $partners = Partner::latest()->get();

        return view('frontend.authornews', compact('blogs', 'latesttags', 'name', 'latestblogs', 'partners'));
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
        $partners = Partner::latest()->get();
        return view('frontend.news-details', compact('selectedblog', 'latesttags', 'previousblog', 'nextblog', 'latestblogs', 'noofcomments', 'comments', 'othercomments', 'partners'));
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
        $partners = Partner::latest()->get();

        return view('frontend.searchednews', compact('blogs', 'latesttags', 'searchword', 'latestblogs', 'partners'));
    }

    public function aboutus()
    {
        $latestblogs = Blog::latest()->where('status', 1)->where('draft', 0)->take(16)->get();
        $partners = Partner::latest()->get();
        $teammembers = TeamMember::latest()->where('status', 1)->with('teamposition')->get();
        $teampositions = TeamPosition::latest()->get();

        return view('frontend.aboutus', compact('latestblogs', 'partners', 'teampositions', 'teammembers'));
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
        $partners = Partner::latest()->get();
        return view('frontend.team', compact('teammembers', 'teampositions', 'latestblogs', 'partners'));
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
        $partners = Partner::latest()->get();
        return view('frontend.slider', compact('slider', 'latestblogs', 'partners'));
    }

    public function viewmerch()
    {
        return view('frontend.merch');
    }

    public function getmatches()
    {
        $latestblogs = Blog::latest()->where('status', 1)->where('draft', 0)->take(16)->get();
        if(request()->has('match'))
        {
            if(request()->get('match') == "Upcoming")
            {
                $matches = MatchDetail::latest()->with('team1', 'team2', 'matchtype', 'stadium')->where('completed', 0)->simplePaginate(4);
            }
            elseif(request()->get('match') == "Completed")
            {
                $matches = MatchDetail::latest()->with('team1', 'team2', 'matchtype', 'stadium')->where('completed', 1)->simplePaginate(4);
            }
            elseif(request()->get('match') == "All")
            {
                $matches = MatchDetail::latest()->with('team1', 'team2', 'matchtype', 'stadium')->simplePaginate(4);
            }
        }
        else
        {
            $matches = MatchDetail::latest()->with('team1', 'team2', 'matchtype', 'stadium')->simplePaginate(4);
        }
        $partners = Partner::latest()->get();
        return view('frontend.matches', compact('latestblogs', 'matches', 'partners'));
    }

    public function viewStandings()
    {
        $latestblogs = Blog::latest()->where('status', 1)->where('draft', 0)->take(16)->get();
        $matchtypes = MatchType::orderBy('name', 'asc')->where('status', 1)->get();
        if(request()->has('matchtype_id'))
        {
            $matchtype = MatchType::where('id', request()->get('matchtype_id'))->first();
        }
        else
        {
            $matchtype = MatchType::first();
        }
        $partners = Partner::latest()->get();
        $standings = MatchStanding::where('matchtype_id', $matchtype->id)->with('team', 'matchtype')->get();

        return view('frontend.standings', compact('latestblogs', 'standings', 'matchtype', 'matchtypes', 'partners'));
    }

    public function viewPartners()
    {
        $latestblogs = Blog::latest()->where('status', 1)->where('draft', 0)->take(16)->get();
        $partners = Partner::latest()->get();
        return view('frontend.partners', compact('latestblogs', 'partners'));
    }

    public function contactus()
    {
        $latestblogs = Blog::latest()->where('status', 1)->where('draft', 0)->take(16)->get();
        return view('frontend.contact', compact('latestblogs'));
    }

    public function contactMail(Request $request)
    {
        $email = "blancmanandhar@gmail.com";
        $data = $this->validate($request, [
            'fullname'=>'required',
            'email'=>'required',
            'message'=>'required',
            'subject' => 'required',
        ]);

        $mailData = [
            'fullname' => $request['fullname'],
            'email' => $request['email'],
            'message' => $request['message'],
            'subject' => $request['subject']
        ];

        Mail::to($email)->send(new ContactMail($mailData));

        return redirect()->back()->with('success', 'Thank you for messaging us. We will get back to you soon.');
    }

    public function registerSubscriber(Request $request)
    {
        $data = $this->validate($request, [
            'email'=>'required|email',
        ]);

        $exsitingsubscriber = Subscriber::where('email', $data['email'])->first();
        if($exsitingsubscriber)
        {
            return redirect()->route('index')->with('success', 'You have already subscribed. Thank you!!');
        }
        else{
            $subscriber = Subscriber::create([
                'email'=>$data['email'],
                'is_verified'=>0,
                'verification_code'=>sha1(time())
            ]);
            $subscriber->save();
            $mailData = [
                'verification_code' => $subscriber->verification_code,
            ];
            Mail::to($data['email'])->send(new RegisterSubscriber($mailData));

            return redirect()->route('index')->with('success', 'We have sent a confirmation code to your email account for subscription. Please Check your email.');
        }
    }

    public function subscriberconfirm()
    {
        $verification_code = \Illuminate\Support\Facades\Request::get('code');
        $subscriber = Subscriber::where('verification_code', $verification_code)->first();
        if( $subscriber != null)
        {
            $subscriber->is_verified = 1;
            $subscriber->save();
            $subscriber->notify(new NewSubscriberNotification($subscriber));
            return redirect()->route('index')->with('success', 'Thank you for subscribing.');
        }
        return redirect()->route('index')->with('failure', 'Sorry, Your subscribtion is not confirmed. Please try again!');
    }
}
