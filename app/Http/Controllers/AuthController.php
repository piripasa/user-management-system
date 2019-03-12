<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Exceptions\AuthException;


class AuthController extends Controller
{
    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * The repository instance.
     *
     * @var \App\Repositories\UserRepository
     */
    private $repository;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\UserRepository  $repository
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(UserRepository $repository,  Request $request) {
        $this->repository = $repository;
        $this->request = $request;
    }

    /**
     * Create a new token.
     *
     * @param  $user
     * @return string
     */
    private function jwt($user) {
        $payload = [
            'iss' => env('JWT_SECRET'), // Issuer of the token
            'sub' => $user['id'], // Subject of the token
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + env('JWT_EXPIRATION_TIME') // Expiration time
        ];

        return JWT::encode($payload, env('JWT_SECRET'));
    }

    /**
     * Login a user and return the token if the provided credentials are correct.
     *
     * @return mixed
     */
    public function login()
    {
        $user = $this->repository->findBy(
            'email',
            $this->request->input('email')
        );
        if(empty($user)) {
            throw new AuthException("These credentials do not match our records.");
        }

        if(app('hash')->check($this->request->input('password'), $user->password)) {
            return $this->respondSuccess([
                'data' => [
                    'token' => $this->jwt($user->toArray())
                ]
            ]);
        }

        throw new AuthException("These credentials do not match our records.");

    }
}

