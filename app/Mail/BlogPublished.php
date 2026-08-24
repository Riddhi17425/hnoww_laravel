<?php

namespace App\Mail;

use App\Models\Blog;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BlogPublished extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Blog $blog)
    {
    }

    public function build()
    {
        return $this->subject('A new blog has been published on HNOWW')
            ->view('email.front.blog_published');
    }
}