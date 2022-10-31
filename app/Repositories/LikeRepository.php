<?php

namespace App\Repositories;

use App\Models\Like;
use App\Base\BaseRepository;
use App\Events\LikeBlog;

class LikeRepository extends BaseRepository
{
    public function model(): string
    {
        return Like::class;
    }

    public function likeAndUnlike(int $blogId, int $memberId): void
    {
        $like = $this->mode->newQuery()->where('blog_id', $blogId)
            ->where('member_id', $memberId)->first();
        if ($like) {
            $like->delete();
        } else {
            /** @var Like $like */
            $like = new $this->model();
            $like
                ->setBlogId($blogId)
                ->setMemberId($memberId)
                ->save();

            }

        LikeBlog::dispatch($like);
    }

}
