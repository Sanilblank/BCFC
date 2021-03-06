<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Reply;
use DataTables;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->user()->can('manage-comment')){
            if ($request->ajax()) {
                $data = Comment::latest()->with('blog')->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', function ($row) {
                        $status = $row->status;
                        if ($status == 1) {
                            $status = "Approved";
                        } else {
                            $status = "Not Approved";
                        }
                        return $status;
                    })
                    ->addColumn('blog_id', function ($row) {
                        return $row->blog->title;
                    })
                    ->addColumn('action', function ($row) {

                        $replies = route('comment.reply', $row->id);
                        $disable = route('comment.disablecomment', $row->id);
                        $enable = route('comment.enablecomment', $row->id);
                        $csrf_token = csrf_token();
                        if($row->status == 1)
                        {
                            $btn = "<a href='$replies' class='edit btn btn-primary btn-sm'>View Replies</a>
                            <form action='$disable' method='POST' style='display:inline;'>
                                    <input type='hidden' name='_token' value='$csrf_token'>
                                    <input type='hidden' name='_method' value='PUT' />
                                        <button type='submit' class='btn btn-danger btn-sm'>Disable</button>
                                </form>"
                            ;
                        }
                        else
                        {
                            $btn = "<a href='$replies' class='edit btn btn-primary btn-sm'>View Replies</a>
                            <form action='$enable' method='POST' style='display:inline;'>
                                    <input type='hidden' name='_token' value='$csrf_token'>
                                    <input type='hidden' name='_method' value='PUT' />
                                        <button type='submit' class='btn btn-success btn-sm'>Enable</button>
                                </form>";
                        }


                        return $btn;
                    })
                    ->rawColumns(['status', 'blog_id' , 'action'])
                    ->make(true);
            }
            return view('backend.comments.index');
        }else{
                return view('backend.permission.permission');
        }
    }

    public function disablecomment(Request $request, $id)
    {
        if($request->user()->can('manage-comment')){
            $comment = Comment::findorfail($id);
            $comment->update([
                'status' => 0,
            ]);

            return redirect()->back()->with('success', 'Comment Disabled');
        }else{
            return view('backend.permission.permission');
        }
    }

    public function enablecomment(Request $request, $id)
    {
        if($request->user()->can('manage-comment')){
            $comment = Comment::findorfail($id);
            $comment->update([
                'status' => 1,
            ]);

            return redirect()->back()->with('success', 'Comment Enabled');
        }else{
            return view('backend.permission.permission');
        }
    }

    public function viewreplies(Request $request, $id)
    {
        if($request->user()->can('manage-comment')){
            if ($request->ajax()) {
                $data = Reply::where('comment_id', $id)->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', function ($row) {
                        $status = $row->status;
                        if ($status == 1) {
                            $status = "Approved";
                        } else {
                            $status = "Not Approved";
                        }
                        return $status;
                    })
                    ->addColumn('action', function ($row) {
                        $disable = route('comment.disablereply', $row->id);
                        $enable = route('comment.enablereply', $row->id);
                        $csrf_token = csrf_token();
                        if($row->status == 1)
                        {
                            $btn = "
                            <form action='$disable' method='POST' style='display:inline-block;'>
                                    <input type='hidden' name='_token' value='$csrf_token'>
                                    <input type='hidden' name='_method' value='PUT' />
                                        <button type='submit' class='btn btn-danger btn-sm'>Disable</button>
                                </form>"
                            ;
                        }
                        else
                        {
                            $btn = "
                            <form action='$enable' method='POST' style='display:inline-block;'>
                                    <input type='hidden' name='_token' value='$csrf_token'>
                                    <input type='hidden' name='_method' value='PUT' />
                                        <button type='submit' class='btn btn-success btn-sm'>Enable</button>
                                </form>";
                        }


                        return $btn;
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
            }
            $comment = Comment::findorfail($id);

            return view('backend.comments.reply', compact('comment'));

        } else{
            return view('backend.permission.permission');
        }

    }

    public function disablereply(Request $request, $id)
    {
        if($request->user()->can('manage-comment')){
            $reply = Reply::findorfail($id);
            $reply->update([
                'status' => 0,
            ]);

            return redirect()->back()->with('success', 'Reply Disabled');

        } else {
            return view('backend.permissions.permission');
        }
    }

    public function enablereply(Request $request, $id)
    {
        if($request->user()->can('manage-comment')){


            $reply = Reply::findorfail($id);
            $reply->update([
                'status' => 1,
            ]);

            return redirect()->back()->with('success', 'Reply Enabled');


        } else {
            return view('backend.permissions.permission');
        }
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
