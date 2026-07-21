<?php
namespace App\Http\Controllers\Web\V1\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\V1\User\UserCreateRequest;
use App\Http\Requests\Web\V1\User\UserUpdateRequest;
use App\Models\User;
use App\Services\Web\V1\User\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class UserManagementController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View | JsonResponse
    {
        if ($request->ajax()) {
            $query = User::query()->latest();

            return DataTables::of($query)
                ->addColumn('avatar', function (User $user) {
                    $fullName = e(trim($user->first_name . ' ' . ($user->last_name ?? '')));
                    $initials = strtoupper(substr($user->first_name, 0, 1));
                    if ($user->avatar) {
                        $avatarUrl = asset($user->avatar);
                        return '<div class="w-14 h-14 rounded-xl bg-white dark:bg-gray-800 shadow-md ring-1 ring-gray-200 dark:ring-gray-700 overflow-hidden flex items-center justify-center">
                            <img src="' . $avatarUrl . '" alt="' . $fullName . '"
                                class="w-full h-full object-cover"
                                onerror="this.style.display=\'none\';this.nextElementSibling.style.display=\'flex\'">
                            <div class="w-full h-full bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center text-white text-base font-bold" style="display:none">' . $initials . '</div>
                        </div>';
                    }
                    return '<div class="w-14 h-14 rounded-xl bg-gradient-to-br from-primary-400 to-primary-600 shadow-md ring-1 ring-primary-200 dark:ring-primary-800 flex items-center justify-center text-white text-base font-bold">' . $initials . '</div>';
                })
                ->addColumn('name', function (User $user) {
                    return e(trim($user->first_name . ' ' . ($user->last_name ?? '')));
                })
                ->addColumn('created_at', function ($data) {
                    return $data->created_at ? $data->created_at->format('d-m-y') : 'N/A';
                })
                ->addColumn('status', function (User $user) {
                    $checked = $user->status === 'active' ? 'checked' : '';
                    return '<label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" onclick="changeStatus(event, ' . $user->id . ')"
                            class="sr-only peer" ' . $checked . '>
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-300 dark:peer-focus:ring-primary-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[\'\'] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-green-500"></div>
                    </label>';
                })
                ->addColumn('action', function (User $user) {
                    return '<div class="flex items-center justify-center gap-1.5">
                        <a href="' . route('users.edit', $user->id) . '"
                            class="w-8 h-8 flex items-center justify-center rounded-lg text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all"
                            title="Edit User">
                            <i class="fa-solid fa-pen-to-square text-sm"></i>
                        </a>
                        <button type="button"
                            class="w-8 h-8 flex items-center justify-center rounded-lg text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all"
                            onclick="deleteRecord(event, ' . $user->id . ')"
                            title="Delete User">
                            <i class="fa-solid fa-trash-can text-sm"></i>
                        </button>
                    </div>';
                })
                ->rawColumns(['avatar', 'status', 'action', 'name', 'created_at'])
                ->make(true);
        }
        return view('backend.users.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create(): View
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param UserCreateRequest $request
     */
    public function store(UserCreateRequest $request): RedirectResponse
    {
        try {
            $this->userService->create($request->validated());

            return redirect()->route('users.index')->with('t-success', 'User created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('t-error', 'Failed to create user: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     */
    public function edit(int $id): View | RedirectResponse
    {
        try {
            $user = $this->userService->find($id);

            return view('backend.users.edit', compact('user'));
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('t-error', 'User not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     * @param UserUpdateRequest $request
     * @param int $id
     */
    public function update(UserUpdateRequest $request, int $id): RedirectResponse
    {
        try {
            $this->userService->update($id, $request->validated());

            return redirect()->route('users.index')->with('t-success', 'User updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('t-error', 'Failed to update user: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->userService->delete($id);

            return response()->json([
                't-success' => true,
                'message'   => 'User deleted successfully.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                't-error' => true,
                'message' => 'Failed to delete user.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Toggle user status (active/inactive).
     * @param int $id
     */
    public function status(int $id): JsonResponse
    {
        try {
            $user         = $this->userService->find($id);
            $user->status = $user->status === 'active' ? 'inactive' : 'active';
            $user->save();

            return response()->json([
                't-success' => true,
                'message'   => 'Status changed successfully.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                't-error' => true,
                'message' => 'Failed to update user status.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
