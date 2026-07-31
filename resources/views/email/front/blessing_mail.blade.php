@extends('layouts.email')

@section('content')

<!-- <tr>
    <td style="padding: 40px;">
        <h1 style="margin: 0 0 10px 0; font-family: 'Times New Roman', Times, serif; font-size: 28px; color: #222222; font-weight: bold;">Hello USER,</h1>
        <p style="margin: 0 0 40px 0; font-family: Arial, sans-serif; font-size: 16px; color: #777777;">Your product inquiry has been send Successfully.</p>

        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%"
            style="border-collapse: collapse;">
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">Name:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">TEST NAME</td>
            </tr>
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">Email:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">TEST EMAIL</td>
            </tr>
            <tr>
                <td width="35%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #888888;">Contact No:</td>
                <td width="65%" style="border: 1px solid #dddddd; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; color: #555555;">CONTACT NAME</td>
            </tr>
        </table>
    </td>
</tr> -->
<tr>
    <td style="padding: 30px; background-color: #F3EFE8;">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td width="50%" style="vertical-align: middle;">
                    <!-- Aapki di gayi image yahan use ki gayi hai -->
                    <img src="{{ asset('public/images/admin/blessing/images/SANDHYA%20(1).jpg') }}" alt="Sandhya" width="100%" style="display: block; border: 0; max-width: 100%; height: auto;">
                </td>
                <td width="50%" style="vertical-align: middle; padding-left: 20px; text-align: center;">
                    <h2 style="margin: 0 0 5px 0; font-family: 'Times New Roman', Times, serif; font-size: 26px; color: #1e3a5f; font-weight: normal;">Sandhya</h2>
                    <p style="margin: 0 0 20px 0; font-family: Arial, sans-serif; font-size: 14px; color: #555555; font-weight: bold;">Between Day and Night</p>
                    <p style="margin: 0; font-family: Arial, sans-serif; font-size: 13px; color: #666666; line-height: 1.6;">
                        A blessing for the in-between. Where presence is enough. and stillness holds.
                    </p>
                </td>
            </tr>
        </table>
    </td>
</tr>
@endsection
