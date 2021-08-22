<?php

namespace App\Jobs;

use App\Mail\SubscriberMail;
use App\Models\Blog;
use App\Models\Setting;
use App\Models\Subscriber;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class SendSubscriberMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 1;
    private $blog_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($blog_id)
    {
        //
        $this->blog_id = $blog_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        try{
            $blog = Blog::findorfail($this->blog_id);
            $url = 'http://127.0.0.1:8000/newsdetails/' . $blog->id . '/' . Str::slug($blog->title);
            $setting = Setting::first();
            $mailData = [
                'blog' => $blog,
                'url' => $url,
                'setting' => $setting,
            ];
            $subscribers = Subscriber::where('is_verified', 1)->get();
            foreach($subscribers as $subscriber)
            {
                Mail::to($subscriber->email)->send(new SubscriberMail($mailData));
            }
        } catch(Exception $e)
        {
            Log::error($e->getMessage);
        }
    }
}
