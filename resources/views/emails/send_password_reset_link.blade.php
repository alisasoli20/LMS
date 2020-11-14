@component('mail::message')
# Hi {{$user->name}}

@component('mail::panel')
A request to reset your password has been made. If you did not make this request, simply ignore this email. If you did make this request, please reset your password:
@endcomponent


@component('mail::button', ['url' => route('reset_password_link', $user->reset_token)])
Reset Password
@endcomponent

or

past below URL to your browser.

<p>{{route('forgot_password', $user->reset_token)}}</p>

Thanks,<br>
{{ get_option('site_name') }}
@endcomponent
