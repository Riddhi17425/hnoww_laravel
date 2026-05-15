@extends('layouts.email')

@section('content')
<tr>
    <td style="padding: 40px;">
        <h1 style="margin: 0 0 10px 0; font-family: 'Times New Roman', Times, serif; font-size: 28px; color: #222222; font-weight: bold;">Hello {{ $name ?? 'User' }},,</h1>
        <p style="margin: 0 0 40px 0; font-family: Arial, sans-serif; font-size: 16px; color: #777777;">Thank you. </br> A member of the HNOWW Corporate Concierge will review your request and respond if aligned.</p>
        

        {{-- <table width="100%" cellpadding="8" cellspacing="0" border="1" style="border-collapse: collapse; margin-top: 15px;">
            <tr>
                <td width="30%"><strong>Full Name</strong></td>
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
                <td><strong>Enquiry Type</strong></td>
                <td>{{ $inquiry_type }}</td>
            </tr>
            <tr>
                <td><strong>Message</strong></td>
                <td>{{ $message_data ?? 'N/A' }}</td>
            </tr>
        </table> --}}

    </td>
</tr>
@endsection
