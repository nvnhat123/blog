<?php

namespace App\Listeners;

use App\Events\LikeBlog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Like;

class UpdateLikeCount
{
    /**
     * Create the event listener.
     *
     * @return void
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\LikeBlog  $event
     * @return void
     */
    public function handle(LikeBlog $event)
    {
        $like = $event->getLike();
    }
}
