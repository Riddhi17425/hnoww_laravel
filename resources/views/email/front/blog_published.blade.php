@extends('layouts.email')

@section('content')
<tr>
    <td style="padding: 40px; font-family: Arial, sans-serif; color: #222222;">
        <h1 style="margin: 0 0 16px; font-family: 'Times New Roman', Times, serif; font-size: 30px;">A new blog is published</h1>
        <h2 style="margin: 0 0 16px; font-family: 'Times New Roman', Times, serif; font-size: 24px; font-weight: normal;">{{ $blog->title }}</h2>
        <p style="margin: 0 0 18px; font-size: 16px; line-height: 1.6;">{{ strip_tags($blog->short_description) }}</p>
        <p style="margin: 0 0 28px; font-size: 16px; line-height: 1.6;">Discover the latest story from HNOWW, exploring thoughtful design, gifting, and intentional living.</p>
        <a href="{{ route('front.blog.detail', ['url' => $blog->url]) }}" style="display: inline-block; padding: 14px 24px; background-color: #222222; color: #ffffff; text-decoration: none; font-size: 15px;">Read the blog</a>
    </td>
</tr>
@endsection