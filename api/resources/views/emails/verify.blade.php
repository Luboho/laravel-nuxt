@component('mail::message')
Hi, {{ $data['name']  }}

Please verify your E-mail address by clicking the link below.

@component('mail::button', ["url" => "http://localhost:3000/auth/verify/" . $data['email_verification_code'] . '-' . $data['id']])
Verify E-mail
@endcomponent

{{-- If the button not work, please click on this url: {{ "http://localhost:3000/auth/verify/" . $data['email_verification_code'] . '-' . $data['id']] }} --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent