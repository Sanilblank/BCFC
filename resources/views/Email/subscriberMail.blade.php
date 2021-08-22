@component('mail::message')
<center><img src="{{Storage::disk('uploads')->url($mailData['setting']->headerImage)}}" alt="{{$mailData['setting']->sitename}}" style="max-width: 200px; margin-bottom: 2rem;"></center>

<center style="font-size: 2rem; font-weight:bold; margin-bottom: 1.5rem;">{{$mailData['blog']->title}}</center>

<img src="{{Storage::disk('uploads')->url($mailData['blog']->image)}}" alt="{{$mailData['blog']->title}}" style="max-width: 100%;">

@component('mail::button', ['url' => $mailData['url'], 'color' => 'green'])
    Take a look.
@endcomponent
@endcomponent
