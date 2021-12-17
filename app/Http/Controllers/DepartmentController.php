<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Repositories\DepartmentRepository;
use App\Services\Department\DepartmentFactory;
use App\Services\Department\DepartmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    private DepartmentRepository $departmentRepository;
    private DepartmentFactory $departmentFactory;
    private DepartmentService $departmentService;

    public function __construct(DepartmentRepository $departmentRepository, DepartmentFactory $departmentFactory, DepartmentService $departmentService)
    {
        $this->departmentRepository = $departmentRepository;
        $this->departmentFactory = $departmentFactory;
        $this->departmentService = $departmentService;
    }

    /**
     * Renders view with paginated departments list, 5 per page
     *
     * @return View
     */
    public function index(): View
    {
        $depts = $this->departmentRepository->getAllPaginatedWithUsers();

        return view('depts.index', ['data' => $depts]);

    }

    /**
     * Renders view with form for editing Department data
     *
     * @param Department $department
     * @return View
     */
    public function show(Department $department): View
    {

        return view('depts.edit', ['data' => $department->load('users')]);
    }


    /**
     * Renders view with empty form for creating new Department
     *
     * @return View
     */
    public function create(): View
    {
        $data= new Department(['name' => 'Новый отдел']);

        return view('depts.edit', ['data' => $data]);
    }

    /**
     * Saves new Department to database
     *
     * @param DepartmentRequest $request
     * @return JsonResponse
     */
    public function store(DepartmentRequest $request): JsonResponse
    {
        $dept = $this->departmentFactory->createFromRequest($request->getData());

        $this->departmentService->setUsersToDepartment($dept, collect($request->getUsers()));

        return response()->json(DepartmentResource::make($dept));
    }

    /**
     * Save new Department's data to database
     *
     * @param DepartmentRequest $request
     * @return JsonResponse
     */
    public function update(DepartmentRequest $request): JsonResponse
    {
        $dept = $this->departmentRepository->findById($request->getDepartmentId());

        $dept->update($request->getData());

            $this->departmentService->setUsersToDepartment($dept, collect($request->getUsers()));

        return response()->json(DepartmentResource::make($dept));
    }

    /**
     * Deletes Department record from database, returns a Department
     * index URL
     *
     * @param Department $department
     * @return string
     */
    public function delete(Department $department): string
    {
        $department->delete();

        return route('depts.index');
    }
}
