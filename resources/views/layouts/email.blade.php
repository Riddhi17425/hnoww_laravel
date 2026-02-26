<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HNOWW - Order Summary</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4; font-family: Arial, sans-serif;">

    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f4f4f4;">
        <tr>
            <td align="center" style="padding: 20px 0;">
                
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; width: 600px; max-width: 600px; border-collapse: collapse; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                    
                    <tr>
                        <td align="center">
                            <img src="{{ asset('public/images/front/emails-banner.png') }}" alt="HNOWW The Ritual of Artful Giving" width="600" style="display: block; width: 100%; max-width: 600px; height: auto;">
                        </td>
                    </tr>

                @yield('content')

                <!-- Footer -->
                 <tr>
                        <td style="background-color: #222222; padding: 30px 20px; text-align: center;">
                            <p style="margin: 0 0 15px 0; font-family: Arial, sans-serif; font-size: 16px; color: #ffffff;">If you have any urgent questions, feel free to contact us</p>
                            
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center" style="font-family: Arial, sans-serif; font-size: 15px; color: #ffffff;">
                                        <span style="display: inline-block; vertical-align: middle; color: #ffffff;">&#9993; studio@hnoww.com</span>
                                        <span style="display: inline-block; color: #666666; margin: 0 15px; vertical-align: middle;">|</span>
                                        <span style="display: inline-block; vertical-align: middle; color: #ffffff;">&#128222; +971 50 950 927</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="background-color: #ffffff; padding: 20px; text-align: center; border-top: 1px solid #eeeeee;">
                            <p style="margin: 0; font-family: Arial, sans-serif; font-size: 12px; color: #999999;">All Rights Reserved. &copy;HNOWW 2026. Designed in Dubai.</p>
                        </td>
                    </tr>

                </table>
                </td>
        </tr>
    </table>
</body>
</html>