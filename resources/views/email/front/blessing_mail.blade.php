@extends('layouts.email')

@section('content')

<!-- Header Area -->
<tr>
    <td align="center" style="padding: 60px 40px 20px; background-color: #ffffff;">
        <p style="margin: 0; font-family: Arial, sans-serif; font-size: 10px; color: #8c8a72; text-transform: uppercase; letter-spacing: 4px;">A Gift From The Heart</p>
        <div style="height: 1px; width: 40px; background-color: #8c8a72; margin: 20px auto;"></div>
        <h1 style="margin: 0; font-family: 'Times New Roman', Times, serif; font-size: 34px; color: #1e3a5f; font-weight: normal; font-style: italic; letter-spacing: 1px;">A Blessing Received</h1>
    </td>
</tr>

<!-- Blessing Display Area (The "Music Player" Card) -->
<tr>
    <td align="center" style="padding: 30px 50px 50px; background-color: #ffffff;">
        <!-- Card container -->
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="border: 1px solid #e5e1d8; background-color: #FAF8F5; border-radius: 12px; box-shadow: 0 15px 35px rgba(0,0,0,0.04);">
            <tr>
                <td align="center" style="padding: 25px 20px;">
                    
                    <!-- Album Cover Style Image -->
                    <div style="margin: 0 auto;">
                        <img src="{{ asset('public/images/admin/blessing/images/SANDHYA%20(1).jpg') }}" alt="Sandhya Blessing" width="250" style="display: block; border: 0; max-width: 250px; height: auto; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border-radius: 4px;">
                    </div>
                    
                    <!-- Audio Wave Icon -->
                    <div style="margin: 20px 0 5px 0;">
                        <img src="https://img.icons8.com/ios/50/8c8a72/audio-wave.png" alt="Audio Wave" width="30" style="display: inline-block; vertical-align: middle; opacity: 0.8;">
                    </div>
                    
                    <p style="margin: 0 0 5px 0; font-family: Arial, sans-serif; font-size: 11px; color: #8c8a72; font-weight: bold; text-transform: uppercase; letter-spacing: 3px;">Track 01 &bull; Between Day and Night</p>
                    <h2 style="margin: 0 0 10px 0; font-family: 'Times New Roman', Times, serif; font-size: 30px; color: #1e3a5f; font-weight: normal; letter-spacing: 2px;">Sandhya</h2>
                    
                    <p style="margin: 0 auto 15px; font-family: 'Times New Roman', Times, serif; font-size: 15px; color: #555555; line-height: 1.6; font-style: italic; max-width: 90%;">
                        "A blessing for the in-between. Where presence is enough. and stillness holds."
                    </p>
                    
                    <!-- Audio Player Timeline (Email Safe) -->
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="85%" style="margin: 0 auto 20px;">
                        <tr>
                            <td width="12%" style="font-family: Arial, sans-serif; font-size: 10px; color: #aaaaaa; text-align: left;">0:00</td>
                            <td width="76%" style="padding: 0 10px; vertical-align: middle;">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <!-- Played part -->
                                        <td width="45%" style="height: 3px; background-color: #8c8a72; line-height: 3px; font-size: 3px;">&nbsp;</td>
                                        <!-- The knob -->
                                        <td width="1%" style="line-height: 0; font-size: 0;"><img src="https://img.icons8.com/ios-filled/50/8c8a72/filled-circle.png" width="9" height="9" style="display: block; max-width: 9px; min-width: 9px;"></td>
                                        <!-- Unplayed part -->
                                        <td width="54%" style="height: 3px; background-color: #e5e1d8; line-height: 3px; font-size: 3px;">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="12%" style="font-family: Arial, sans-serif; font-size: 10px; color: #aaaaaa; text-align: right;">3:45</td>
                        </tr>
                    </table>
                    
                    <!-- Play Button -->
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
                        <tr>
                            <td align="center" style="background-color: #1e3a5f; border-radius: 30px; padding: 12px 25px;">
                                <a href="@Blessing_Link" style="display: block; font-family: Arial, sans-serif; font-size: 11px; color: #ffffff; text-decoration: none; text-transform: uppercase; letter-spacing: 2px;">
                                    <span style="font-size: 12px; vertical-align: middle; margin-right: 6px;">&#9658;</span> Listen To Blessing
                                </a>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>
    </td>
</tr>

<!-- Sender's Note Area -->
<tr>
    <td style="padding: 0 50px 50px; background-color: #ffffff;">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td align="center" style="padding: 40px 30px; border-top: 1px solid #e5e1d8; border-bottom: 1px solid #e5e1d8;">
                    <p style="margin: 0 0 20px 0; font-family: Arial, sans-serif; font-size: 11px; color: #8c8a72; text-transform: uppercase; font-weight: bold; letter-spacing: 3px;">
                        A Note From @Sender_Name
                    </p>
                    <p style="margin: 0; font-family: 'Times New Roman', Times, serif; font-size: 19px; color: #333333; font-style: italic; line-height: 1.8;">
                        "@Sender_Note"
                    </p>
                </td>
            </tr>
        </table>
    </td>
</tr>

<!-- Submission Details Area -->
<tr>
    <td style="padding: 0 50px 40px; background-color: #ffffff;">
        <p style="margin: 0 0 25px 0; font-family: Arial, sans-serif; font-size: 11px; color: #1e3a5f; text-transform: uppercase; letter-spacing: 3px; text-align: center;">Submission Details</p>
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td width="35%" style="padding: 15px 0; border-bottom: 1px solid #f4f4f4; font-family: Arial, sans-serif; font-size: 11px; color: #888888; text-transform: uppercase; letter-spacing: 1px;">Date</td>
                <td width="65%" align="right" style="padding: 15px 0; border-bottom: 1px solid #f4f4f4; font-family: 'Times New Roman', Times, serif; font-size: 15px; color: #333333;">@Order_Date</td>
            </tr>
            <tr>
                <td width="35%" style="padding: 15px 0; border-bottom: 1px solid #f4f4f4; font-family: Arial, sans-serif; font-size: 11px; color: #888888; text-transform: uppercase; letter-spacing: 1px;">Sender Details</td>
                <td width="65%" align="right" style="padding: 15px 0; border-bottom: 1px solid #f4f4f4; font-family: 'Times New Roman', Times, serif; font-size: 15px; color: #333333;">@Sender_Name/Email/Phone</td>
            </tr>
        </table>
    </td>
</tr>

<!-- Footer CTA Area -->
<tr>
    <td align="center" style="padding: 10px 50px 60px; background-color: #ffffff;">
        <p style="margin: 0 0 20px 0; font-family: 'Times New Roman', Times, serif; font-size: 17px; color: #777777; font-style: italic;">
            Looking to share a meaningful moment?
        </p>
        <a href="{{ route('front.blessings.library') }}" style="display: inline-block; padding: 14px 35px; font-family: Arial, sans-serif; font-size: 11px; color: #ffffff; background-color: #8c8a72; text-decoration: none; text-transform: uppercase; letter-spacing: 2px;">
            Explore The Library
        </a>
    </td>
</tr>
@endsection
