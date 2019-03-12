<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Repositories\GroupRepository;
use App\Transformers\GroupTransformer;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    protected $repository;
    protected $transformer;

    public function __construct(GroupRepository $repository, GroupTransformer $transformer)
    {
        $this->repository = $repository;
        $this->transformer = $transformer;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function index(Request $request)
    {
        try {
            return $this->respondSuccess(['data' =>
                    $this->transformer->transformCollection($this->repository->paginate())
                ]
            );
        } catch (\Exception $exception) {
            return $this->respondError(['message' => $exception->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGroupRequest $request
     * @return mixed
     * @throws \Exception
     */
    public function store(StoreGroupRequest $request)
    {
        try {
            return $this->respondSuccess([
                'message' => 'Group created successfully',
                'data' => $this->transformer->transform($this->repository->create($request->all()))
            ]);
        } catch (\Exception $exception) {
            return $this->respondError(['message' => $exception->getMessage()]);
        }
    }

    /**
     * Delete the specified resource in storage.
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function destroy($id)
    {
        try {
            $group = $this->repository->find($id);
            if (!$group)
                return $this->respondError(['message' => 'Group not found']);

            if ($group->users->count() > 0)
                return $this->respondError(['message' => 'Non empty group can not be deleted']);

            if ($this->repository->delete($id))
                return $this->respondSuccess(['message' => 'Group deleted successfully']);

        } catch (\Exception $exception) {
            return $this->respondError(['message' => $exception->getMessage()]);
        }
    }
}
