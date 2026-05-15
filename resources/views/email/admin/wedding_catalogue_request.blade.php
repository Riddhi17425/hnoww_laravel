@extends('layouts.email')

@section('content')

<tr>
    <td style="padding: 40px;">

        <h1
            style="margin: 0 0 10px 0; font-family: 'Times New Roman', Times, serif; font-size: 28px; color: #222222; font-weight: bold;">
            Hello Admin,</h1>
        <p style="margin: 0 0 40px 0; font-family: Arial, sans-serif; font-size: 16px; color: #777777;">A new Wedding Consultation Request has been received. The details are provided below:</p>
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%"
            style="border-collapse: collapse;">
            <tr>
                <td width="35%"
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">
                    Full Name:</td>
                <td width="65%"
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">
                    {{ $full_name }}</td>
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
                    Role.</td>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">
                    {{ $role }}</td>
            </tr>
            
            <tr>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">
                    Wedding Location</td>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">
                    {{ $location ?? '' }}</td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">
                    Wedding Date:</td>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">
                    {{ $wedding_date }}</td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">
                    Looking For:</td>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">
                    {{ $looking_for }}</td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">
                    Approximate Guest Count:</td>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">
                    {{ $guest_count }}</td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">
                    Budget Band (overall):</td>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">
                    {{ $budget_band }}</td>
            </tr>
            <tr>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">
                    Message:</td>
                <td
                    style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">
                    {{ $message_note ?? '' }}</td>
            </tr>
        </table>

    </td>
</tr>

@endsection