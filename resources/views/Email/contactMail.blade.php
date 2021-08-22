@component('mail::message')
<b>You have received a message</b><br><hr>
From: <b>{{$mailData['fullname']}}</b><br>
Email: <b>{{$mailData['email']}}</b><br>
Message:

<p>{{$mailData['message']}}</p>


