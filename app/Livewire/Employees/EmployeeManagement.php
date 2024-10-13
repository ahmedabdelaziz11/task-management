<?php

namespace App\Livewire\Employees;

use App\Services\EmployeeService;
use Livewire\Component;
use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;

class EmployeeManagement extends Component
{
    use WithPagination;

    protected $listeners = ['refreshEmployeeList' => 'refreshEmployeeList','showDeleteConfirmation' => 'showDeleteConfirmation'];

    public $email       = null;
    public $phone       = null;
    public $fullName    = null;
    public $user_id     = null;
    public $currentPage = 1;

    public function render(EmployeeService $service)
    {
        $employees = $service->index([
            'email'    => $this->email,
            'phone'    => $this->phone,
            'fullName' => $this->fullName,
        ]);
        return view('livewire.employees.employee-management', ['employees' => $employees]);
    }

    public  function showDeleteConfirmation($id)
    {
        $this->user_id = $id;
    }

    public function deleteEmployee(EmployeeService $service)
    {
        $service->delete($this->user_id);
        $this->dispatch('success','Employee deleted successfully!'); 
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

    public function refreshEmployeeList()
    {
        $this->resetPage();
    }
}
