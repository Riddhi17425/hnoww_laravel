@extends('layouts.email')

@section('content')
<tr>
    <td style="padding: 40px;">
        <h1 style="margin: 0 0 10px 0; font-family: 'Times New Roman', Times, serif; font-size: 28px; color: #222222; font-weight: bold;">Hello {{ $name ?? 'User' }},</h1>
        <p style="margin: 0 0 40px 0; font-family: Arial, sans-serif; font-size: 16px; color: #777777;">Thank you.<br/>
            Our Wedding Concierge will review your details and reach out if aligned.
            {{-- <br/>
            Vault access is shared only after an initial conversation.</p> --}}

        {{-- <table width="100%" cellpadding="8" cellspacing="0" border="1" style="border-collapse: collapse; margin-top: 15px;">
            <tr>
                <td width="30%"><strong>Full Name</strong></td>
                <td>{{ $name }}</td>
            </tr>
            <tr>
                <td><strong>Company Name</strong></td>
                <td>{{ $company_name }}</td>
            </tr>
            <tr>
                <td><strong>Phone No.</strong></td>
                <td>{{ $phone }}</td>
            </tr>
            <tr>
                <td><strong>Email</strong></td>
                <td>{{ $email }}</td>
            </tr>
            <tr>
                <td><strong>Product Of Interest</strong></td>
                <td>{{ $product_of_interest ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Quantity Range</strong></td>
                <td>{{ $quantity_range }}</td>
            </tr>
             <tr>
                <td><strong>Budget</strong></td>
                <td>{{ $budget }}</td>
            </tr>
            <tr>
                <td><strong>Branding Requirements</strong></td>
                <td>{{ $branding_requirements }}</td>
            </tr>
            <tr>
                <td><strong>Delivery Date</strong></td>
                <td>{{ $delivery_date }}</td>
            </tr>
            <tr>
                <td><strong>Message</strong></td>
                <td>{{ $message_data ?? 'N/A' }}</td>
            </tr>
        </table> --}}
    </td>
</tr>
@endsection
