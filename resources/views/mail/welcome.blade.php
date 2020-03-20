@component('mail::message')
# Welcome at cleanupcar {{$data['name']}} !

@component('mail::button', ['url' => 'http://cleanupcar.herokuapp.com/'])
Click here to login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

