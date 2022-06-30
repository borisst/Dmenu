@component('mail::message')
# Hi there!

Welcome to your menu thingie.

@component('mail::button', ['url' => 'dmenu.test/companies'])
Make your first company
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
