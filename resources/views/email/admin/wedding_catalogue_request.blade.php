{{-- @extends('layouts.email')

@section('content')
<tr>
    <td class="email-body">
        <p>Hello Admin,</p>

        <p>
            A new Wedding Catalogue Request been received. The details are provided below:
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
@endsection --}}

@extends('layouts.email')

@section('content')
<!-- <tr>
    <td class="email-body">
        <p>Hello Admin,</p>

        <p>
            A new Wedding Consultation Request has been received. The details are provided below:
        </p>

        <table width="100%" cellpadding="8" cellspacing="0" border="1" style="border-collapse: collapse; margin-top: 15px;">
            
            <tr>
                <td width="30%"><strong>Full Name</strong></td>
                <td>{{ $full_name }}</td>
            </tr>

            {{-- <tr>
                <td><strong>Phone No.</strong></td>
                <td>{{ $phone }}</td>
            </tr> --}}

            <tr>
                <td><strong>Email</strong></td>
                <td>{{ $email }}</td>
            </tr>

            <tr>
                <td><strong>Role</strong></td>
                <td>{{ ucfirst($role) }}</td>
            </tr>

            <tr>
                <td><strong>Wedding Location</strong></td>
                <td>{{ $location ?? 'N/A' }}</td>
            </tr>

            <tr>
                <td><strong>Wedding Date</strong></td>
                <td>{{ $wedding_date }}</td>
            </tr>

            <tr>
                <td><strong>Looking For</strong></td>
                <td>{{ $looking_for }}</td>
            </tr>

            <tr>
                <td><strong>Guest Count</strong></td>
                <td>{{ $guest_count }}</td>
            </tr>

            <tr>
                <td><strong>Budget Band</strong></td>
                <td>{{ $budget_band }}</td>
            </tr>

            <tr>
                <td><strong>Message</strong></td>
                <td>{{ $message_note }}</td>
            </tr>

        </table>

        <p style="margin-top: 20px;">
            Thanks & Regards,<br>
            <strong>HNoWW</strong>
        </p>
    </td>
</tr> -->


<tr>
    <td style="padding: 40px;">

        <h1
            style="margin: 0 0 10px 0; font-family: 'Times New Roman', Times, serif; font-size: 28px; color: #222222; font-weight: bold;">
            Hello Admin,</h1>
        <p style="margin: 0 0 40px 0; font-family: Arial, sans-serif; font-size: 16px; color: #777777;">A request for a
            bespoke corporate proposal has arrived.</p>

        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 40px;">
            <tr>
                <td width="120" valign="top">
                    <img src="https://via.placeholder.com/120x120/1a2b3c/ffffff?text=Product" alt="The Gathering"
                        width="120" style="display: block; max-width: 120px; border: 1px solid #eeeeee;">
                </td>
                <td valign="top" style="padding-left: 20px;">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td align="left"
                                style="font-family: 'Times New Roman', Times, serif; font-size: 24px; color: #222222; font-weight: bold;">
                                The Gathering</td>
                            <td align="right"
                                style="font-family: Arial, sans-serif; font-size: 18px; color: #a58855; font-weight: bold;">
                                AED 750</td>
                        </tr>
                    </table>
                    <p style="margin: 10px 0 0 0; font-family: Arial, sans-serif; font-size: 15px; color: #777777;">A
                        sculptural vessel for shared presence.</p>
                </td>
            </tr>
        </table>

        <h2
            style="margin: 0 0 20px 0; font-family: 'Times New Roman', Times, serif; font-size: 24px; color: #222222; font-weight: bold;">
            Your Order Summary</h2>

        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%"
            style="border-collapse: collapse;">
            <tr>
                <td width="35%"
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">
                    Full Name:</td>
                <td width="65%"
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">
                    Oswald Test</td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">
                    Company Name:</td>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">
                    Test Company</td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">
                    Role / Designation:</td>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">
                    TESTT</td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">
                    Email:</td>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">
                    webdeveloper9.intelliworkz@gmail.com</td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">
                    Budget Comfort:</td>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">
                    20-50</td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">
                    Timeline:</td>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">
                    Under AED 300</td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">
                    Nature of Requirement:</td>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">
                    1-3 months</td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">
                    Message / Notes:</td>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">
                    Client / Partner Gifting, Leadership / Board Gifts, Employee Recognition</td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">
                    Email:</td>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">
                    TEST</td>
            </tr>
        </table>

    </td>
</tr>

@endsection