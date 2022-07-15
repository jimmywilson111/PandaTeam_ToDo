<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\TaskCreateRequest;
use App\Models\Task;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Application|Factory|View
     */
    public function index()
    {
        $task_list = Task::all();
        return view('tasks.index', ['task_list' => $task_list, 'page_title' => 'Task List']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskCreateRequest $request
     * @return RedirectResponse
     */
    public function store(TaskCreateRequest $request): RedirectResponse
    {
        $task = Task::create($request->validated());
        return ($task)
            ? redirect()->route('tasks.index')->with('success', 'Task created.')
            : back()->withInput($request->validated())->withErrors(['error', 'Something went wrong']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $item = Task::find($id);
        $item->fill(['status' => (bool) $request->status]);
        $status = $item->save();

        return ($status)
            ? redirect()->route('tasks.index')->with('success', 'Task updated.')
            : back()->withErrors(['error', 'Something went wrong']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $item = Task::find($id);
        $status = $item->delete();
        return ($status)
            ? redirect()->route('tasks.index')->with('success', 'Task delete.')
            : back()->withErrors(['error', 'Something went wrong']);
    }
}
