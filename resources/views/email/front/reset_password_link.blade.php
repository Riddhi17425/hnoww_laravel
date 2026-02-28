@extends('layouts.email')

@section('content')
<tr>
    <td style="padding: 40px;">
        <h1 style="margin: 0 0 10px 0; font-family: 'Times New Roman', Times, serif; font-size: 28px; color: #222222; font-weight: bold;">Hello User,</h1>
        <p style="margin: 0 0 40px 0; font-family: Arial, sans-serif; font-size: 16px; color: #777777;">You requested a password reset. </br><a href="{{ $link }}">Click here to reset your password</a></br>If you didn’t request this, ignore this email.</p>
    </td>
</tr>

@endsection