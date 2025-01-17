<?php

namespace App\Interfaces;

interface TaskRepositoryInterface
{
    public function index();
    public function countTasks();
    public function countCompletedTasks();
    public function getById($id);
    public function store(array $data);
    public function update(array $data,$id);
    public function delete($id);
}
