@extends('layouts.email')

@section('content')
<tr>
    <td class="email-body">
        <p>Hello User,</p>

        <p>You requested a password reset.</p>
        <p><a href="{{ $link }}">Click here to reset your password</a></p>
        <p>If you didn’t request this, ignore this email.</p>

        <p style="margin-top: 20px;">
            Thanks & Regards,<br>
            <strong>HNoWW</strong>
        </p>
    </td>
</tr>

@endsection