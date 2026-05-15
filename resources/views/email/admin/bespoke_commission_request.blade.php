@extends('layouts.email')

@section('content')
<tr>
    <td style="padding: 40px;">
        <h1 style="margin: 0 0 10px 0; font-family: 'Times New Roman', Times, serif; font-size: 28px; color: #222222; font-weight: bold;">Hello Admin,</h1>
        <p style="margin: 0 0 40px 0; font-family: Arial, sans-serif; font-size: 16px; color: #777777;">A new Bespoke Commission Request has been received. The details are provided below:</p>

        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%"
            style="border-collapse: collapse;">
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">Full Name:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">{{ $full_name }}</td>
            </tr>
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">Email:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">{{ $email }}</td>
            </tr>
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">Phone No.:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">{{ $phone ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">Type of Commission:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">{{ $type_of_commission }}</td>
            </tr>
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">Customer hoping to create:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">{{ $customer_hoping_to_create ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">Intended Timeline:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">{{ $timeline ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">Budget Comfort Range:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">{{ $budget ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">Anything else we should know:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">{{ $additional_message ?? '' }}</td>
            </tr>
        </table>

    </td>
</tr>
@endsection
