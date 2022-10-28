<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Repositories\MemberRepository;
use App\Transformers\Member\IndexResource as MemberIndexResource;

class MemberController extends Controller
{
    protected MemberRepository $repository;

    public function __construct(MemberRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request): JsonResponse
    {
        $members = $this->repository->index($request);
        $collection = MemberIndexResource::collection($members);

        return responder()->getSuccess($collection);
    }
}
