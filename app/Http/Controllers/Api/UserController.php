<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return response()->json($this->repository->all());
    }

    public function show(int $id)
    {
        $user = $this->repository->find($id);
        if (!$user) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        return response()->json($user);
    }
}
