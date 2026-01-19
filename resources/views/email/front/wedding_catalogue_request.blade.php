@extends('layouts.email')

@section('content')
<tr>
    <td class="email-body">
        <p>Hello {{ $name ?? 'User' }},</p>

        <p>
            Your Wedding Catalogue Request has been send Successfully.
        </p>

        <table width="100%" cellpadding="8" cellspacing="0" border="1" style="border-collapse: collapse; margin-top: 15px;">
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
        </table>

        <p style="margin-top: 20px;">
            Thanks & Regards,<br>
            <strong>HNoWW</strong>
        </p>
    </td>
</tr>
@endsection
