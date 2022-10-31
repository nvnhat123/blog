<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Repositories\MemberRepository;
use App\Http\Requests\Member\StoreRequest;
use App\Transformers\Member\MemberResource;

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
        $collection = MemberResource::collection($members);

        return responder()->getSuccess($collection);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $member = $this->repository->store($request);
        $resource = new MemberResource($member);

        return responder()->getSuccess($resource);
    }
}
