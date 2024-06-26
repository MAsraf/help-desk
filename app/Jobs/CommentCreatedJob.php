<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\User;
use App\Notifications\CommentCreateNotification;
use App\Notifications\TicketCreatedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CommentCreatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Comment $comment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::whereNull('register_token')->get();
        foreach ($users as $u) {
            if ((
                auth()->user()->id !== $u->id               //exclude notification to current user
            )
            &&(
            (
                auth()->user()->can('View all tickets')
                && ($this->comment->ticket->owner_id === $u->id
                || $this->comment->ticket->responsible_id === $u->id)
            )
            ||
            (
                auth()->user()->can('View own tickets')
                && (
                    $this->comment->ticket->owner_id === $u->id
                    || $this->comment->ticket->responsible_id === $u->id
                )
                && $this->comment->ticket->owner_id !== $u->id
            )
            )
        ) {
            $u->notify(new CommentCreateNotification($this->comment, $u));
        }
        }

        
    }
}
