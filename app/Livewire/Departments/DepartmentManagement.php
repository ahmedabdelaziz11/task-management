<?php

namespace App\Livewire\Departments;

use App\Services\DepartmentService;
use Livewire\Component;
use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;

class DepartmentManagement extends Component
{
    use WithPagination;

    protected $listeners = ['refreshDepartmentList' => 'refreshDepartmentList','showDeleteConfirmation' => 'showDeleteConfirmation'];

    public $dept_id     = null;
    public $name        = null;
    public $currentPage = 1;

    public function render(DepartmentService $service)
    {
        $departments = $service->index([
            'name' => $this->name,
        ]);
        return view('livewire.departments.department-management', ['departments' => $departments]);
    }

    public  function showDeleteConfirmation($id)
    {
        $this->dept_id = $id;
    }

    public function deleteDepartment(DepartmentService $service)
    {
        $result = $service->delete($this->dept_id);
        if ($result) {
            $this->dispatch('success','Department deleted successfully!'); 
        }else{
            $this->dispatch('error','this department cannot be deleted because it contains employees.'); 
        }
        $this->dispatch('closeModal'); 
        $this->resetPage();
    }

    public function setPage($url)
    {
        $urlParts = explode('page=', $url);
        if (isset($urlParts[1])) {
            $this->currentPage = $urlParts[1];
        } else {
            $this->currentPage = 1;
        }
        Paginator::currentPageResolver(function(){
            return $this->currentPage;
        });
    }

    public function refreshDepartmentList()
    {
        $this->resetPage();
    }
}
