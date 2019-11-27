<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentWasLikedMail extends Mailable
{
    use Queueable, SerializesModels;
    private $post_owner;
    private $post_name;
    private $post_liker;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($post_name, $post_liker, $post_owner)
    {
        $this->post_name = $post_name;
        $this->post_owner = $post_owner;
        $this->post_liker = $post_liker;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Mail.comment_was_liked')
            ->subject(__('Comment liked'))
            ->from(env('SERVICE_EMAIL'))
            ->with([
                'post_owner'=>$this->post_owner,
                'post_name'=>$this->post_name,
                'post_liker'=>$this->post_liker

            ]);
    }
}
