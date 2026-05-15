@extends('layouts.email')

@section('content')
<tr>
    <td class="email-body">
        <p>Hello Admin,</p>

        <p>
            A new Ceremonial inquiry has been received. The details are provided below:
        </p>

        <table width="100%" cellpadding="8" cellspacing="0" border="1" style="border-collapse: collapse; margin-top: 15px;">
            <tr>
                <td width="30%"><strong>Name</strong></td>
                <td>{{ $name }}</td>
            </tr>
            <tr>
                <td><strong>Email</strong></td>
                <td>{{ $email }}</td>
            </tr>
            <tr>
                <td><strong>Contact No</strong></td>
                <td>{{ $contact_no }}</td>
            </tr>
            <tr>
                <td><strong>Ceremonial</strong></td>
                <td>{{ $ceremonial }}</td>
            </tr>
            <tr>
                <td><strong>Message</strong></td>
                <td>{{ $message_data ?? 'N/A' }}</td>
            </tr>
        </table>

        <p style="margin-top: 20px;">
            Thanks & Regards,<br>
            <strong>HNoWW</strong>
        </p>
    </td>
</tr>
@endsection
