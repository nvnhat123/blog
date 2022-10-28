<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;

class Member extends User
{
    use HasFactory, HasApiTokens, SoftDeletes;

    protected $fillable = [
        'username',
        'email',
        'password',
        'name',
        'phone_number',
        'status',
        'dob',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'deleted_at',
    ];

    public function findForPassport(string $username): ?Member
    {
        $member = $this->newQuery()->where('username', $username)->first();

        if (!$member) {
            return null;
        }

        return $member;
    }
}
