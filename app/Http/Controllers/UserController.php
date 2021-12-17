<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserNameResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\User\UserFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UserController extends Controller
{
    private UserRepository $userRepository;
    private UserFactory $userFactory;

    public function __construct(UserRepository $userRepository, UserFactory $userFactory)
    {
        $this->userRepository = $userRepository;
        $this->userFactory = $userFactory;
    }

    /**
     * Renders view with paginated users list, 10 per page
     *
     * @return View
     */
    public function index(): View
    {
        $users = $this->userRepository->getAllPaginated();

        return view('users.index', ['data' => $users]);
    }

    /**
     * Renders view with empty new user form
     *
     * @return View
     */
    public function create(): View
    {
        $data= new User(['name' => 'Новый пользоваетль']);
        return view('users.edit', ['data' => $data]);
    }

    /**
     * Renders user edit form
     *
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        return view('users.edit', ['data' => $user]);
    }

    /**
     * Saves a new user record to database, checks email is unique
     *
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $user = $this->userFactory->createFromRequest($request->getData());

            DB::commit();

            return response()->json(UserResource::make($user));

        } catch (\Exception $e) {
            DB::rollBack();

            if ($this->userRepository->findByEmail($request->getEmail())) {
                return response()->json(['errors' => ['email' => ['Этот email уже используется']]], 400);
            }

            return response()->json([
                'message' => 'Ошибка создания пользователя!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Saves new user data to database, checks email is unique
     *
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function update(UserRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $user = $this->userRepository->findById($request->getUserId());
            $user->update($request->getData());

            DB::commit();

            return response()->json(UserResource::make($user));

        } catch (\Exception $e) {
            DB::rollBack();

            if ($this->userRepository->findByEmail($request->getEmail())) {
                return response()->json(['errors' => ['email' => ['Этот email уже используется']]], 400);
            }

            return response()->json([
                'message' => 'Ошибка создания пользователя!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Deletes a user record from database, returns users list URL
     *
     * @param User $user
     * @return string
     */
    public function delete(User $user): string
    {
        $user->delete();

        return route('users.index');
    }

    /**
     * Returns a simple user list with id and name parameters
     *
     * @return JsonResponse
     */
    public function usersList(): JsonResponse
    {
        $users = $this->userRepository->getAll();

        return response()->json(UserNameResource::collection($users));
    }

}
