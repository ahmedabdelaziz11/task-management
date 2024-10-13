<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function index(array $data = [])
    {
        $status = isset($data['status']) ? $data['status']      : null;   
        $title  = isset($data['title'])  ? $data['title']       : null;      

        $employee_ids   =  auth()->user()->employees()->pluck('id')->toArray();
        $employee_ids[] =  auth()->id();
        return Task::query()
            ->select([
                'id',
                'title',
                'status',
                'employee_id',
            ])        
            ->with([
                'employee:id,first_name,last_name',
            ])
            ->whereIn('employee_id',$employee_ids)
            ->when($status,function($q) use ($status){
                return $q->where('status',$status);
            })
            ->when($title,function($q) use ($title){
                return $q->where('title','like','%'.$title.'%');
            })
            ->orderByDesc('id')
            ->paginate(10);
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    public function update(Task $task,array $data)
    {
        return $task->update($data);
    }

    public function getById(int $id)
    {
        return Task::findOrFail($id);
    }
}
