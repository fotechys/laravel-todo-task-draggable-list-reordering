<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TaskController extends AppBaseController
{
    /** @var TaskRepository $taskRepository*/
    private $taskRepository;

    public function __construct(TaskRepository $taskRepo)
    {
        $this->taskRepository = $taskRepo;
    }

    /**
     * Display a listing of the Task.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $project_id = null;
        try {
            $project_id = $request->input("project_id");
        } catch (\Exception $e) {
            //todo
        }

        if(!$project_id) {
            $project = Project::first();
            if($project instanceof Project)
                $project_id = $project->id;
        }

        $search = [];

        if($project_id) {
            $search = [
                "project_id" => $project_id
            ];

        }

        $tasks = $this->taskRepository->all($search);



        return view('tasks.index')
            ->with('tasks', $tasks)
            ->with('project_id', $project_id);
    }

    /**
     * Show the form for creating a new Task.
     *
     * @return Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created Task in storage.
     *
     * @param CreateTaskRequest $request
     *
     * @return Response
     */
    public function store(CreateTaskRequest $request)
    {
        $input = $request->all();

        $task = $this->taskRepository->create($input);

        Flash::success('Task saved successfully.');

        return redirect(route('tasks.index'));
    }

    /**
     * Display the specified Task.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $task = $this->taskRepository->find($id);

        if (empty($task) || !($task instanceof Task)) {
            Flash::error('Task not found');

            return redirect(route('tasks.index'));
        }


        return view('tasks.show')->with('task', $task);
    }

    /**
     * Show the form for editing the specified Task.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $task = $this->taskRepository->find($id);

        if (empty($task)) {
            Flash::error('Task not found');

            return redirect(route('tasks.index'));
        }

        return view('tasks.edit')->with('task', $task);
    }

    /**
     * Update the specified Task in storage.
     *
     * @param int $id
     * @param UpdateTaskRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTaskRequest $request)
    {
        $task = $this->taskRepository->find($id);

        if (empty($task)) {
            Flash::error('Task not found');

            return redirect(route('tasks.index'));
        }

        $task = $this->taskRepository->update($request->all(), $id);

        Flash::success('Task updated successfully.');

        return redirect(route('tasks.index'));
    }

    /**
     * Remove the specified Task from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $task = $this->taskRepository->find($id);

        if (empty($task)) {
            Flash::error('Task not found');

            return redirect(route('tasks.index'));
        }

        $this->taskRepository->delete($id);

        Flash::success('Task deleted successfully.');

        return redirect(route('tasks.index'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function orderingRow(Request $request) {

        $rows = $request->input("order");

        foreach ($rows as $row) {
            $task = Task::find($row['id']);
            $task->priority = $row['position'];
            $task->save();

        }

        return response()->noContent();
    }
}
