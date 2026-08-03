@extends('layouts.email')

@section('content')

<!-- Header Area -->
<tr>
    <td align="center" style="padding: 60px 40px 20px; background-color: #ffffff;">
        <h2 style="margin: 0 0 10px 0; font-family: Arial, sans-serif; font-size: 13px; color: #1e3a5f; text-transform: uppercase; letter-spacing: 2px; font-weight: bold;">
            A Blessing Has Been Shared With You
        </h2>
        <p style="margin: 0 0 20px 0; font-family: 'Times New Roman', Times, serif; font-size: 16px; color: #555555; font-style: italic;">
            by {{ $from_name }}
        </p>
        <p style="margin: 0; font-family: Arial, sans-serif; font-size: 10px; color: #8c8a72; text-transform: uppercase; letter-spacing: 4px;">A Gift From The Heart</p>
        <div style="height: 1px; width: 40px; background-color: #8c8a72; margin: 20px auto;"></div>
        <h1 style="margin: 0; font-family: 'Times New Roman', Times, serif; font-size: 34px; color: #1e3a5f; font-weight: normal; font-style: italic; letter-spacing: 1px;">A Blessing Received</h1>
    </td>
</tr>

<!-- Blessing Display Area (The "Music Player" Card) -->
<tr>
    <td align="center" style="padding: 30px 50px 50px; background-color: #ffffff;">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="border: 1px solid #e5e1d8; background-color: #FAF8F5; border-radius: 12px; box-shadow: 0 15px 35px rgba(0,0,0,0.04);">
            <tr>
                <td align="center" style="padding: 25px 20px;">

                    <!-- Blessing Image -->
                    <div style="margin: 0 auto;">
                        <img src="{{ $blessing_image ?? asset('public/images/product-not-found.webp') }}"
                             alt="{{ $blessing_title }}" width="250"
                             style="display: block; border: 0; max-width: 250px; height: auto; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border-radius: 4px;">
                    </div>

                    <!-- Audio Wave Icon -->
                    <div style="margin: 20px 0 5px 0;">
                        <img src="https://img.icons8.com/ios/50/8c8a72/audio-wave.png" alt="Audio Wave" width="30" style="display: inline-block; vertical-align: middle; opacity: 0.8;">
                    </div>

                    @if(!empty($blessing_subtitle))
                    <p style="margin: 0 0 5px 0; font-family: Arial, sans-serif; font-size: 11px; color: #8c8a72; font-weight: bold; text-transform: uppercase; letter-spacing: 3px;">
                        {{ $blessing_subtitle }}
                    </p>
                    @endif

                    <h2 style="margin: 0 0 10px 0; font-family: 'Times New Roman', Times, serif; font-size: 30px; color: #1e3a5f; font-weight: normal; letter-spacing: 2px;">
                        {{ $blessing_title }}
                    </h2>

                    @if(!empty($blessing_description))
                    <p style="margin: 0 auto 15px; font-family: 'Times New Roman', Times, serif; font-size: 15px; color: #555555; line-height: 1.6; font-style: italic; max-width: 90%;">
                        "{{ \Illuminate\Support\Str::limit($blessing_description, 160) }}"
                    </p>
                    @endif

                    <!-- Play Button -->
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="margin: 10px auto 0;">
                        <tr>
                            <td align="center" style="background-color: #1e3a5f; border-radius: 30px; padding: 12px 25px;">
                                <a href="{{ $blessing_audio }}" style="display: block; font-family: Arial, sans-serif; font-size: 11px; color: #ffffff; text-decoration: none; text-transform: uppercase; letter-spacing: 2px;">
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
@if(!empty($message_note))
<tr>
    <td style="padding: 0 50px 50px; background-color: #ffffff;">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td align="center" style="padding: 40px 30px; border-top: 1px solid #e5e1d8; border-bottom: 1px solid #e5e1d8;">
                    <p style="margin: 0 0 20px 0; font-family: Arial, sans-serif; font-size: 11px; color: #8c8a72; text-transform: uppercase; font-weight: bold; letter-spacing: 3px;">
                        A Note From {{ $from_name }}
                    </p>
                    <p style="margin: 0; font-family: 'Times New Roman', Times, serif; font-size: 19px; color: #333333; font-style: italic; line-height: 1.8;">
                        "{{ $message_note }}"
                    </p>
                </td>
            </tr>
        </table>
    </td>
</tr>
@endif

<!-- Submission Details Area -->
<tr>
    <td style="padding: 0 50px 40px; background-color: #ffffff;">
        <p style="margin: 0 0 25px 0; font-family: Arial, sans-serif; font-size: 11px; color: #1e3a5f; text-transform: uppercase; letter-spacing: 3px; text-align: center;">Submission Details</p>
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td width="35%" style="padding: 15px 0; border-bottom: 1px solid #f4f4f4; font-family: Arial, sans-serif; font-size: 11px; color: #888888; text-transform: uppercase; letter-spacing: 1px;">Date</td>
                <td width="65%" align="right" style="padding: 15px 0; border-bottom: 1px solid #f4f4f4; font-family: 'Times New Roman', Times, serif; font-size: 15px; color: #333333;">{{ $order_date ?? '' }}</td>
            </tr>
            <tr>
                <td width="35%" style="padding: 15px 0; border-bottom: 1px solid #f4f4f4; font-family: Arial, sans-serif; font-size: 11px; color: #888888; text-transform: uppercase; letter-spacing: 1px;">Sender Name</td>
                <td width="65%" align="right" style="padding: 15px 0; border-bottom: 1px solid #f4f4f4; font-family: 'Times New Roman', Times, serif; font-size: 15px; color: #333333;">{{ $from_name }}</td>
            </tr>
            <tr>
                <td width="35%" style="padding: 15px 0; border-bottom: 1px solid #f4f4f4; font-family: Arial, sans-serif; font-size: 11px; color: #888888; text-transform: uppercase; letter-spacing: 1px;">Sender Email</td>
                <td width="65%" align="right" style="padding: 15px 0; border-bottom: 1px solid #f4f4f4; font-family: 'Times New Roman', Times, serif; font-size: 15px; color: #333333;">{{ $from_email }}</td>
            </tr>
            <tr>
                <td width="35%" style="padding: 15px 0; border-bottom: 1px solid #f4f4f4; font-family: Arial, sans-serif; font-size: 11px; color: #888888; text-transform: uppercase; letter-spacing: 1px;">Sender Phone</td>
                <td width="65%" align="right" style="padding: 15px 0; border-bottom: 1px solid #f4f4f4; font-family: 'Times New Roman', Times, serif; font-size: 15px; color: #333333;">{{ $from_phone }}</td>
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
