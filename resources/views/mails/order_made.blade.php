@component('mail::message')

{{ $user->name }} you successfully made order! Wait ours until moderators and admin approve your order, please.

@component('mail::button', ['url' => "http://127.0.0.1:8000/users/{$user->id}"])
    Check your orders' statuses in your profile page.
@endcomponent

@endcomponent