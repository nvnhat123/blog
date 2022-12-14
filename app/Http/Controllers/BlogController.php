<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Repositories\BlogRepository;
use App\Transformers\Blog\BlogResource;
use App\Http\Requests\Blog\StoreRequest;
use App\Http\Requests\Blog\UpdateRequest;

class BlogController extends Controller
{
    protected BlogRepository $repository;

    public function __construct(BlogRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request): JsonResponse
    {
        $blogs = $this->repository->index($request);
        $collection = BlogResource::collection($blogs);

        return responder()->getSuccess($collection);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $blog = $this->repository->store($request);
        $resource = new BlogResource($blog);

        return responder()->getSuccess($resource);
    }

    public function show(Request $request, int $id): JsonResponse
    {
        $blog = $this->repository->show($id);
        $resource = new BlogResource($blog);

        return responder()->getSuccess($resource);
    }

    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        $blog = $this->repository->update($request, $id);
        $resource = new BlogResource($blog);

        return responder()->getSuccess($resource);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->repository->destroy($id);

        return responder()->getSuccess();
    }
}
