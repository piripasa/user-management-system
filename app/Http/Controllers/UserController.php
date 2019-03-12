<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
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
}
