<?php

namespace App\Repositories;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;


class TaskRepository implements TaskRepositoryInterface
{
    public function index()
    {
        return Task::all();
    }

    public function countTasks()
    {
        return Task::count();
    }

    public function countCompletedTasks()
    {
        return Task::where('completed', 1)->count();
    }

    public function getById($id)
    {
        return Task::findOrFail($id);
    }

    public function store(array $data)
    {
        return Task::create($data);
    }

    public function update(array $data,$id)
    {
        return Task::whereId($id)->update($data);
    }

    public function delete($id)
    {
        Task::destroy($id);
    }
}
