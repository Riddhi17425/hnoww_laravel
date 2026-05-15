@extends('layouts.email')

@section('content')
<tr>
    <td class="email-body">
        <p>Hello {{ $name ?? 'User' }},</p>

        <p>
            Thank you. </br>A member of the HNOWW Corporate Concierge will review your request and respond if aligned.
        </p>

        <p style="margin-top: 20px;">
            Thanks & Regards,<br>
            <strong>HNoWW</strong>
        </p>
    </td>
</tr>
@endsection
