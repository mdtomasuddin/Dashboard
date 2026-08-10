<?php

namespace App\Http\Controllers\Web\V1\Settings\FAQ;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\V1\Settings\FAQ\FAQRequest;
use App\Models\FAQ;
use App\Services\Web\V1\Settings\FAQ\FAQService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class FAQController extends Controller
{
    public function __construct(
        protected FAQService $faqService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View | JsonResponse
    {
        if ($request->ajax()) {
            $query = FAQ::query()->latest();

            return DataTables::of($query)
                ->editColumn('question', function (FAQ $faq) {
                    return $faq->question ? e(Str::limit($faq->question, 50)) : 'N/A';
                })
                ->editColumn('answer', function (FAQ $faq) {
                    $plainAnswer = strip_tags($faq->answer);

                    return $plainAnswer ? e(Str::limit($plainAnswer, 50)) : 'N/A';
                })
                ->addColumn('created_at', function ($data) {
                    return $data->created_at ? $data->created_at->format('m/d/Y') : 'N/A';
                })
                ->addColumn('status', function (FAQ $faq) {
                    $checked = $faq->status === 'active' ? 'checked' : '';

                    return '<label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" onclick="changeStatus(event, ' . $faq->id . ')"
                            class="sr-only peer" ' . $checked . '>
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-300 dark:peer-focus:ring-primary-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[\'\'] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-green-500"></div>
                    </label>';
                })
                ->addColumn('action', function (FAQ $faq) {
                    return '<div class="flex items-center justify-center gap-2">
                        <a href="' . route('faqs.edit', $faq->id) . '"
                            class="w-8 h-8 flex items-center justify-center rounded-lg text-blue-600 bg-blue-100 hover:bg-blue-600 hover:text-white dark:text-blue-400 dark:bg-blue-900/30 dark:hover:bg-blue-600 dark:hover:text-white transition-all shadow-sm hover:shadow"
                            title="Edit FAQ">
                            <i class="fa-solid fa-pen-to-square text-sm"></i>
                        </a>
                        <button type="button"
                            class="w-8 h-8 flex items-center justify-center rounded-lg text-red-600 bg-red-100 hover:bg-red-600 hover:text-white dark:text-red-400 dark:bg-red-900/30 dark:hover:bg-red-600 dark:hover:text-white transition-all shadow-sm hover:shadow"
                            onclick="deleteRecord(event, ' . $faq->id . ')"
                            title="Delete FAQ">
                            <i class="fa-solid fa-trash-can text-sm"></i>
                        </button>
                    </div>';
                })
                ->rawColumns(['status', 'action', 'question', 'answer', 'created_at'])
                ->make(true);
        }

        return view('backend.settings.faq.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('backend.settings.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FAQRequest $request): RedirectResponse
    {
        try {
            $this->faqService->create($request->validated());

            return redirect()->route('faqs.index')->with('t-success', 'FAQ created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('t-error', 'Failed to create FAQ: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View | RedirectResponse
    {
        try {
            $faq = FAQ::query()->findOrFail($id);

            return view('backend.settings.faq.edit', compact('faq'));
        } catch (Exception $e) {
            return redirect()->route('faqs.index')->with('t-error', 'FAQ not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FAQRequest $request, int $id): RedirectResponse
    {
        try {
            $this->faqService->update($id, $request->validated());

            return redirect()->route('faqs.index')->with('t-success', 'FAQ updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('t-error', 'Failed to update FAQ: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $faq = FAQ::query()->findOrFail($id);
            $faq->delete();

            return response()->json([
                't-success' => true,
                'message'   => 'FAQ deleted successfully.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                't-error' => true,
                'message' => 'Failed to delete FAQ.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Toggle FAQ status (active/inactive).
     */
    public function status(int $id): JsonResponse
    {
        try {
            $faq         = FAQ::query()->findOrFail($id);
            $faq->status = $faq->status === 'active' ? 'inactive' : 'active';
            $faq->save();

            return response()->json([
                't-success' => true,
                'message'   => 'Status changed successfully.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                't-error' => true,
                'message' => 'Failed to update FAQ status.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
