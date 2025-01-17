<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Interfaces\TaskRepositoryInterface;
use App\Services\{ApiResponseService, GoogleService, TelegramService};
use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    private TaskRepositoryInterface $taskRepositoryInterface;

    public function __construct(TaskRepositoryInterface $taskRepositoryInterface)
    {
        $this->taskRepositoryInterface = $taskRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->taskRepositoryInterface->index();

        return ApiResponseService::sendResponse(TaskResource::collection($data), '', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $details = [
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'date_completion' => $request->date_completion
        ];

        DB::beginTransaction();
        try {
            $task = $this->taskRepositoryInterface->store($details);

            DB::commit();

            $telegramService = new TelegramService();
            $telegramService->sendMessage("Создана новая задача '{$task->name}'");
            $googleService = new GoogleService();
            $googleService->appendRowInSheet([
                [
                    $details['name'],
                    $details['description'],
                    $details['status'],
                    $details['date_completion']
                ]
            ]);
            return ApiResponseService::sendResponse(new TaskResource($task), 'Task created successfully.', 201);
        } catch (\Exception $ex) {
            ApiResponseService::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = $this->taskRepositoryInterface->getById($id);

        return ApiResponseService::sendResponse(new TaskResource($task), 'Task retrieved successfully.', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        $details = [
            'name' => $request->name,
            'description' => $request->description,
            'date_completion' => $request->date_completion,
            'status' => $request->status
        ];

        DB::beginTransaction();
        try {
            $task = $this->taskRepositoryInterface->update($details, $id);

            DB::commit();
            return ApiResponseService::sendResponse('Task updated successfully.', '',201);
        } catch (\Exception $ex) {
            ApiResponseService::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->taskRepositoryInterface->delete($id);

        return ApiResponseService::sendResponse('Task deleted Successfully.','',201);
    }
}
