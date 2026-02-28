@extends('layouts.email')

@section('content')
<tr>
    <td class="email-body">
        <p>Hello Admin,</p>

        <p>
            A new Newsletter Subscription has been received with Email Id - {{ $email }}
        </p>

        <p style="margin-top: 20px;">
            Thanks & Regards,<br>
            <strong>HNoWW</strong>
        </p>
    </td>
</tr>
@endsection
