@component('mail::message')
# Hello

It would appear that your company doesn't have an active promotion.

@component('mail::button', ['url' => route('promotions.create')])
Create one now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
