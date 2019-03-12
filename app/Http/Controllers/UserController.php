<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Repositories\GroupRepository;
use App\Repositories\UserRepository;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $repository;
    protected $transformer;

    public function __construct(UserRepository $repository, UserTransformer $transformer)
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
     * @param StoreUserRequest $request
     * @return mixed
     * @throws \Exception
     */
    public function store(StoreUserRequest $request)
    {
        try {
            return $this->respondSuccess([
                'message' => 'User created successfully',
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
            $user = $this->repository->find($id);
            if (!$user)
                return $this->respondError(['message' => 'User not found']);

            if ($this->repository->delete($id)) {
                return $this->respondSuccess(['message' => 'User deleted successfully']);
            }

        } catch (\Exception $exception) {
            return $this->respondError(['message' => $exception->getMessage()]);
        }
    }

    /**
     * Assign user to group
     * @param $user_id
     * @param $group_id
     * @param GroupRepository $groupRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignToGroup($user_id, $group_id, GroupRepository $groupRepository)
    {
        try {
            $user = $this->repository->find($user_id);
            if (!$user)
                return $this->respondError(['message' => 'User not found'], 404);

            $group = $groupRepository->find($group_id);
            if (!$group)
                return $this->respondError(['message' => 'Group not found'], 404);

            if ($user->groups->contains($group->id))
                return $this->respondError(['message' => 'User already assigned to this group']);

            $user->groups()->attach($group);

            return $this->respondSuccess(['message' => 'User assigned successfully']);
        } catch (\Exception $exception) {
            return $this->respondError(['message' => $exception->getMessage()]);
        }
    }

    /**
     * Remove user from group
     * @param $user_id
     * @param $group_id
     * @param GroupRepository $groupRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeFromGroup($user_id, $group_id, GroupRepository $groupRepository)
    {
        try {
            $user = $this->repository->find($user_id);
            if (!$user)
                return $this->respondError(['message' => 'User not found'], 404);

            $group = $groupRepository->find($group_id);
            if (!$group)
                return $this->respondError(['message' => 'Group not found'], 404);

            if (!$user->groups->contains($group->id))
                return $this->respondError(['message' => 'User not assigned to this group']);

            $user->groups()->detach($group);

            return $this->respondSuccess(['message' => 'User removed from group successfully']);
        } catch (\Exception $exception) {
            return $this->respondError(['message' => $exception->getMessage()]);
        }
    }
}
