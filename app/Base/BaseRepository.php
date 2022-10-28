<?php

namespace App\Base;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    abstract public function model(): string;

    protected Model $model;

    public function __construct()
    {
        $this->makeModel();
    }

    public function makeModel(): void
    {
        $this->model = app($this->model());
    }
}
