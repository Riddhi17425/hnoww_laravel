@extends('layouts.email')

@section('content')
<tr>
    <td style="padding: 40px;">

        <p style="margin: 0 0 25px 0; font-family: Arial, sans-serif; font-size: 14px; color: #555555; line-height: 1.6;">
            A physical blessing gift order was submitted on <strong>{{ $order_date ?? now()->format('d M Y') }}</strong>. Action required: prepare and dispatch to recipient address below.
        </p>

        @if(!empty($add_flowers))
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #FFF6DE; border: 1px solid #f0d98c; border-radius: 6px; margin-bottom: 30px;">
            <tr>
                <td style="padding: 18px 20px; font-family: Arial, sans-serif;">
                    <p style="margin: 0 0 6px 0; font-size: 13px; color: #8a6d1f; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">
                        &#9873; Flowers Add-on Selected — AED {{ $flower_budget_range ?? '199' }}
                    </p>
                    <p style="margin: 0; font-size: 13px; color: #8a6d1f; line-height: 1.5;">
                        Sender requested flowers to accompany this gift. Arrange florist dispatch to the recipient address below alongside the blessing item.
                    </p>
                </td>
            </tr>
        </table>
        @endif

        <!-- BLESSING -->
        <p style="margin: 0 0 12px 0; font-family: Arial, sans-serif; font-size: 12px; color: #1e3a5f; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">Blessing</p>
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 25px;">
            <tr>
                <td width="30%" style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; font-family: Arial, sans-serif; font-size: 13px; color: #888888;">Name</td>
                <td width="70%" style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; font-family: Arial, sans-serif; font-size: 13px; color: #333333;">{{ $blessing_title }} @if(!empty($blessing_subtitle))({{ $blessing_subtitle }})@endif</td>
            </tr>
            <tr>
                <td width="30%" style="padding: 8px 0; font-family: Arial, sans-serif; font-size: 13px; color: #888888;">URL</td>
                <td width="70%" style="padding: 8px 0; font-family: Arial, sans-serif; font-size: 13px;"><a href="{{ $shareLink }}" style="color: #1e3a5f;">{{ $shareLink }}</a></td>
            </tr>
        </table>

        <!-- SENDER -->
        <p style="margin: 0 0 12px 0; font-family: Arial, sans-serif; font-size: 12px; color: #1e3a5f; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">Sender (Your Details)</p>
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 25px;">
            <tr>
                <td width="30%" style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; font-family: Arial, sans-serif; font-size: 13px; color: #888888;">Name</td>
                <td width="70%" style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; font-family: Arial, sans-serif; font-size: 13px; color: #333333;">{{ $from_name }}</td>
            </tr>
            <tr>
                <td width="30%" style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; font-family: Arial, sans-serif; font-size: 13px; color: #888888;">Email</td>
                <td width="70%" style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; font-family: Arial, sans-serif; font-size: 13px; color: #333333;">{{ $from_email }}</td>
            </tr>
            <tr>
                <td width="30%" style="padding: 8px 0; font-family: Arial, sans-serif; font-size: 13px; color: #888888;">Phone</td>
                <td width="70%" style="padding: 8px 0; font-family: Arial, sans-serif; font-size: 13px; color: #333333;">{{ $from_phone }}</td>
            </tr>
        </table>

        <!-- RECIPIENT -->
        <p style="margin: 0 0 12px 0; font-family: Arial, sans-serif; font-size: 12px; color: #1e3a5f; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">Recipient (Delivery Details)</p>
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 25px;">
            <tr>
                <td width="30%" style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; font-family: Arial, sans-serif; font-size: 13px; color: #888888;">Name</td>
                <td width="70%" style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; font-family: Arial, sans-serif; font-size: 13px; color: #333333;">{{ $to_name }}</td>
            </tr>
            <tr>
                <td width="30%" style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; font-family: Arial, sans-serif; font-size: 13px; color: #888888;">Email</td>
                <td width="70%" style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; font-family: Arial, sans-serif; font-size: 13px; color: #333333;">{{ $to_email }}</td>
            </tr>
            <tr>
                <td width="30%" style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; font-family: Arial, sans-serif; font-size: 13px; color: #888888;">Phone</td>
                <td width="70%" style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; font-family: Arial, sans-serif; font-size: 13px; color: #333333;">{{ $to_phone }}</td>
            </tr>
            <tr>
                <td width="30%" style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; font-family: Arial, sans-serif; font-size: 13px; color: #888888;">Address Line 1</td>
                <td width="70%" style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; font-family: Arial, sans-serif; font-size: 13px; color: #333333;">{{ $address_line1 ?? '' }}</td>
            </tr>
            <tr>
                <td width="30%" style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; font-family: Arial, sans-serif; font-size: 13px; color: #888888;">Address Line 2</td>
                <td width="70%" style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; font-family: Arial, sans-serif; font-size: 13px; color: #333333;">{{ $address_line2 ?? '' }}</td>
            </tr>
            <tr>
                <td width="30%" style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; font-family: Arial, sans-serif; font-size: 13px; color: #888888;">Emirate</td>
                <td width="70%" style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; font-family: Arial, sans-serif; font-size: 13px; color: #333333;">{{ $emirate ?? '' }}</td>
            </tr>
            <tr>
                <td width="30%" style="padding: 8px 0; font-family: Arial, sans-serif; font-size: 13px; color: #888888;">Landmark</td>
                <td width="70%" style="padding: 8px 0; font-family: Arial, sans-serif; font-size: 13px; color: #333333;">{{ $landmark ?? '' }}</td>
            </tr>
        </table>

        <!-- MESSAGE / NOTES -->
        <p style="margin: 0 0 12px 0; font-family: Arial, sans-serif; font-size: 12px; color: #1e3a5f; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">Message / Notes</p>
        <p style="margin: 0 0 25px 0; font-family: 'Times New Roman', Times, serif; font-size: 14px; color: #555555; font-style: italic;">
            "{{ $message_note ?? '-' }}"
        </p>

        <!-- ADD-ONS -->
        <p style="margin: 0 0 12px 0; font-family: Arial, sans-serif; font-size: 12px; color: #1e3a5f; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">Add-ons</p>
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 30px;">
            <tr>
                <td width="30%" style="padding: 8px 0; font-family: Arial, sans-serif; font-size: 13px; color: #888888;">Flowers Add-On</td>
                <td width="70%" style="padding: 8px 0; font-family: Arial, sans-serif; font-size: 13px; color: #333333;">
                    {{ $add_flowers_label ?? 'No' }}@if(!empty($add_flowers) && !empty($flower_budget_range)) (AED {{ $flower_budget_range }})@endif
                </td>
            </tr>
        </table>

        <p style="margin: 0 0 35px 0; font-family: Arial, sans-serif; font-size: 11px; color: #aaaaaa; border-top: 1px solid #f0f0f0; padding-top: 15px;">
            Automated notification from hnoww.com Gift This Blessing order form. This message is for internal fulfilment use only.
        </p>

        <!-- Blessing Image Card -->
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="border: 1px solid #e5e1d8; background-color: #FAF8F5; border-radius: 12px;">
            <tr>
                <td align="center" style="padding: 25px 20px;">

                    <div style="margin: 0 auto;">
                        <img src="{{ $blessing_image ?? asset('public/images/product-not-found.webp') }}"
                             alt="{{ $blessing_title }}" width="200"
                             style="display: block; border: 0; max-width: 200px; height: auto; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border-radius: 4px;">
                    </div>

                    <div style="margin: 18px 0 5px 0;">
                        <img src="https://img.icons8.com/ios/50/8c8a72/audio-wave.png" alt="Audio Wave" width="26" style="display: inline-block; vertical-align: middle; opacity: 0.8;">
                    </div>

                    @if(!empty($blessing_subtitle))
                    <p style="margin: 0 0 5px 0; font-family: Arial, sans-serif; font-size: 10px; color: #8c8a72; font-weight: bold; text-transform: uppercase; letter-spacing: 3px;">
                        {{ $blessing_subtitle }}
                    </p>
                    @endif

                    <h2 style="margin: 0 0 15px 0; font-family: 'Times New Roman', Times, serif; font-size: 24px; color: #1e3a5f; font-weight: normal; letter-spacing: 1px;">
                        {{ $blessing_title }}
                    </h2>

                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
                        <tr>
                            <td align="center" style="background-color: #1e3a5f; border-radius: 30px; padding: 10px 22px;">
                                <a href="{{ $shareLink }}" style="display: block; font-family: Arial, sans-serif; font-size: 10px; color: #ffffff; text-decoration: none; text-transform: uppercase; letter-spacing: 2px;">
                                    <span style="font-size: 11px; vertical-align: middle; margin-right: 6px;">&#9658;</span> Listen To Blessing
                                </a>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>

    </td>
</tr>
@endsection
