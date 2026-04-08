@extends('layouts.email')

@section('content')
<tr>
    <td style="padding: 40px;">

        <h1
            style="margin: 0 0 10px 0; font-family: 'Times New Roman', Times, serif; font-size: 28px; color: #222222; font-weight: bold;">
            Hello Admin,</h1>
        <p style="margin: 0 0 40px 0; font-family: Arial, sans-serif; font-size: 16px; color: #777777;">New order has been placed. The details are provided below:</p>

        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 40px;">
            <tr>
                <td width="120" valign="top">
                    <img src="{{ asset('public/images/front/emails-card.png') }}" alt="The Gathering"
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
                    <p style="margin: 10px 0 0 0; font-family: Arial, sans-serif; font-size: 15px; color: #777777;">A sculptural vessel for shared presence.</p>
                </td>
            </tr>
        </table>

        <h2 style="margin: 0 0 20px 0; font-family: 'Times New Roman', Times, serif; font-size: 24px; color: #222222; font-weight: bold;">
            Your Order Summary</h2>

        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%"
            style="border-collapse: collapse;">
            <tr>
                <td width="35%"
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">
                    Full Name:</td>
                <td width="65%"
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">
                    {{ $name }}</td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">
                    Email:</td>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">
                    {{ $email }}</td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">
                    Order ID:</td>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">
                    {{ $order_id ?? '' }}</td>
            </tr>
            
            <tr>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">
                    Status</td>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">
                    {{ $status ?? '' }}</td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">
                    Order Total:</td>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">
                    {{ $order_total }}</td>
            </tr>
        </table>

    </td>
</tr>

@endsection