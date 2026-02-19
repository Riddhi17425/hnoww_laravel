@extends('layouts.email')

@section('content')
<tr>
    <td class="email-body">
        <p>Hello {{ $name ?? 'User' }},</p>

        <p>
            Thank you. <br/>
            We review bespoke enquiries slowly and intentionally. <br/>
            If your request aligns with our practice, a member of the Atelier will be in touch.
        </p>


        <p style="margin-top: 20px;">
            Thanks & Regards,<br>
            <strong>HNoWW</strong>
        </p>
    </td>
</tr>
@endsection
