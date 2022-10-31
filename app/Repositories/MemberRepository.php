<?php

namespace App\Repositories;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Base\BaseRepository;
use Illuminate\Support\Facades\Hash;

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

    public function store(Request $request): Member
    {
        /** @var Member $member */
        $member = new $this->model();
        if ($request->hasFile('avatar')) {
            $member->addMedia($request->file('avatar'))->toMediaCollection(Member::AVATAR_MEMBER);
        }
        $member
            ->setEmail($request->get('email'))
            ->setPassword(Hash::make($request->get('password')))
            ->setName($request->get('name'))
            ->save();

        return $member;
    }
}
