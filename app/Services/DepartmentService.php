<?php

namespace App\Services;

use App\Models\Department;

class DepartmentService
{
    public function index(array $data = [])
    {
    }

    public function getById(int $id)
    {
        return Department::findOrFail($id);
    }

    public function delete($id): bool
    {
        return Department::findOrFail($id)
            ->delete();
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
