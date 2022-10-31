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
        $member->setUsername($request->get('username'))
            ->setEmail($request->get('email'))
            ->setPassword(Hash::make($request->get('password')))
            ->setName($request->get('name'))
            ->setPhoneNumber($request->get('phone_number'))
            ->setStatus($request->get('status'))
            ->setDob(convert_date_vn_to_en($request->get('dob')))
            ->save();

        return $member;
    }
}
