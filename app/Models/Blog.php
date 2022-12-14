<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Member;

/**
 * @property integer id
 * @property string title
 * @property string content
 * @property integer view_count
 * @property integer like_count
 * @property Member member
 * @property integer created_at
 * @property integer updated_at
 */
class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'view_count',
        'like_count',
        'member_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'deleted_at',
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_id')->withTrashed();
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function setViewCount(int $viewCount): self
    {
        $this->view_count = $viewCount;

        return $this;
    }

    public function setLikeCount(int $likeCount): self
    {
        $this->like_count = $likeCount;

        return $this;
    }

    public function setMemberId(int $memberId): self
    {
        $this->member_id = $memberId;

        return $this;
    }
}
