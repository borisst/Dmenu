@component('mail::message')
# Hello,

It would appear that your company doesn't have an event.

@component('mail::button', ['url' => 'dmenu.test/events/create'])
    Create one now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
