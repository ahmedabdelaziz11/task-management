<?php

namespace App\Livewire\Employees;

use App\Http\Requests\EmployeeRequest;
use App\Services\DepartmentService;
use App\Services\EmployeeService;
use Livewire\Component;
use Livewire\WithFileUploads;

class EmployeeModal extends Component
{
    use WithFileUploads;

    public $user_id;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $password;
    public $salary = 0;
    public $image;
    public $imageUrl;
    public $manager_id;
    public $department_id;
    public $managers    = [];
    public $departments = [];
    public $isEditMode  = false;
    public $formTitle   = "create new employee";

    protected $listeners = ['editEmployee' => 'editEmployee'];

    public function editEmployee($id,EmployeeService  $employeeService)
    {
        $this->resetForm();
        if($id != 0)
        {
            $user = $employeeService->getById($id);
            $this->formTitle     = "Edit employee";
            $this->isEditMode    = true;
            $this->user_id       = $user->id;
            $this->first_name    = $user->first_name;
            $this->last_name     = $user->last_name;
            $this->email         = $user->email;
            $this->phone         = $user->phone;
            $this->salary        = $user->salary;
            $this->imageUrl      = $user->photo;
            $this->manager_id    = $user->manager_id;
            $this->department_id = $user->department_id;
        }
    }

    public function mount(EmployeeService  $employeeService,DepartmentService $departmentService)
    {
        $this->managers    = $employeeService->getManagers();
        $this->departments = $departmentService->getDepartmentsWithOutPagination();
    }

    public function resetForm()
    {
        $this->user_id       = null;
        $this->first_name    = '';
        $this->last_name     = '';
        $this->email         = '';
        $this->phone         = '';
        $this->password      = '';
        $this->salary        = 0;
        $this->image         = null;
        $this->imageUrl      = null;
        $this->manager_id    = null;
        $this->department_id = null;
        $this->isEditMode    = false;
        $this->formTitle     = "create new employee";
    }

    protected function rules(): array 
    {
        return (new EmployeeRequest())->rules($this->user_id);
    } 


    public function save(EmployeeService  $employeeService)
    {
        $data = $this->validate(); 
        $employeeService->updateOrCreate($data,$this->user_id);
        $this->resetForm();
        $this->dispatch('success','employee saved successfully!'); 
        $this->dispatch('refreshEmployeeList'); 
        $this->dispatch('closeModal'); 
    }

    public function render()
    {
        return view('livewire.employees.employee-modal');
    }
}
