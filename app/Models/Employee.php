<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;

class Employee extends User
{
    use HasFactory, HasApiTokens, SoftDeletes;

    protected $fillable = [
        'username',
        'email',
        'password',
        'name',
        // 'phone_number',
        // 'status',
        // 'dob',
    ];

    public function findForPassport(string $username): ?Employee
    {
        $employee = $this->newQuery()->where('username', $username)->first();

        if (!$employee) {
            return null;
        }

        return $employee;
    }
}
