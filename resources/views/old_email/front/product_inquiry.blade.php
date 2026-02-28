@extends('layouts.email')

@section('content')
<tr>
    <td class="email-body">
        <p>Hello {{ $name ?? 'User' }},</p>

        <p>
            Your product inquiry has been send Successfully.
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
                <td><strong>Product</strong></td>
                <td>{{ $product_name }}</td>
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
