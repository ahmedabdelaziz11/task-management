<?php

namespace App\Services;

use App\Models\Department;

class DepartmentService
{
    public function index(array $data = [])
    {
        $name = isset($data['name']) ? $data['name'] : null;   

        return Department::query()
            ->when($name,function($q) use ($name){
                return $q->where('name','like','%'.$name.'%');
            })
            ->withEmployeeStats()
            ->orderByDesc('id')
            ->paginate();
    }

    public function updateOrCreate(array $data,int $dept_id = null)
    {
        return Department::updateOrCreate(['id' => $dept_id],$data);
    }

    public function getById(int $id)
    {
        return Department::findOrFail($id);
    }

    public function delete($id): bool
    {
        $dept = Department::doesntHave('employees')->find($id);
        if ($dept) {
            return $dept->delete();
        }
        return false;
    }

    public function getDepartmentsWithOutPagination()
    {
        return Department::query()
            ->select([
                'id',
                'name',
            ])        
            ->orderByDesc('id')
            ->get();
    }
}
