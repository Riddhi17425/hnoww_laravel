@extends('layouts.email')

@section('content')
<tr>
    <td style="padding: 40px;">
        <h1 style="margin: 0 0 10px 0; font-family: 'Times New Roman', Times, serif; font-size: 28px; color: #222222; font-weight: bold;">Hello Admin,</h1>
        <p style="margin: 0 0 40px 0; font-family: Arial, sans-serif; font-size: 16px; color: #777777;">A new Gift Blesing Request has been received. The details are provided below:</p>

        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%"
            style="border-collapse: collapse;">
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">Blessing Title:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">{{ $blessing_title }}</td>
            </tr>
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">From Name:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">{{ $from_name }}</td>
            </tr>
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">From Email:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">{{ $from_email }}</td>
            </tr>
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">From Phone:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">{{ $from_phone }}</td>
            </tr>
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">To Name:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">{{ $to_name }}</td>
            </tr>
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">To Email:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">{{ $to_email }}</td>
            </tr>
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">To Phone:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">{{ $to_phone }}</td>
            </tr>
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">Address Line 1:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">{{ $address_line1 ?? ''}}</td>
            </tr>
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">Address Line 2:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">{{ $address_line2 ?? '' }}</td>
            </tr>
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">Emirate:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">{{ $emirate ?? '' }}</td>
            </tr>
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">Landmark:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">{{ $landmark ?? '' }}</td>
            </tr>
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">Would you like to add beutiful Flowers ?</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">{{ $add_flowers_label ?? 'No' }}</td>
            </tr>
            @if(!empty($flower_budget_range))
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">Flower Budget Range:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">{{ $flower_budget_range }}</td>
            </tr>
            @endif
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">Message / Notes:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">{{ $message_note ?? '' }}</td>
            </tr>
        </table>
    </td>
</tr>
@endsection
