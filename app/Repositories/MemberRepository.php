<?php

namespace App\Repositories;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Base\BaseRepository;

class MemberRepository extends BaseRepository
{
    public function model(): string
    {
        return Member::class;
    }

    public function index(Request $request): Collection
    {
        return $this->model->newQuery()->get();
    }
}
