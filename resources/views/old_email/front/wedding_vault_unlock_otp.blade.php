@extends('layouts.email')

@section('content')
<tr>
    <td class="email-body">
        <p>Hello,</p>

        <p>
            Your OTP for Unlock Wedding Vault is - {{ $otp }}
        </p>

        <p style="margin-top: 20px;">
            Thanks & Regards,<br>
            <strong>HNoWW</strong>
        </p>
    </td>
</tr>
@endsection
