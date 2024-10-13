<?php

namespace App\Livewire\Departments;

use App\Http\Requests\DepartmentRequest;
use App\Services\DepartmentService;
use Livewire\Component;
use Livewire\WithFileUploads;

class DepartmentModal extends Component
{
    public $dept_id;
    public $name;
    public $isEditMode  = false;
    public $formTitle   = "create new department";

    protected $listeners = ['editDepartment' => 'editDepartment'];

    public function editDepartment($id,DepartmentService  $departmentService)
    {
        $this->resetForm();
        if($id != 0)
        {
            $user = $departmentService->getById($id);
            $this->formTitle     = "Edit department";
            $this->isEditMode    = true;
            $this->dept_id       = $user->id;
            $this->name          = $user->name;
        }
    }

    public function resetForm()
    {
        $this->dept_id    = null;
        $this->name       = '';
        $this->isEditMode = false;
        $this->formTitle  = "create new department";
    }

    protected function rules(): array 
    {
        return (new DepartmentRequest())->rules($this->dept_id);
    } 


    public function save(DepartmentService  $departmentService)
    {
        $data = $this->validate(); 
        $departmentService->updateOrCreate($data,$this->dept_id);
        $this->resetForm();
        $this->dispatch('success','department saved successfully!'); 
        $this->dispatch('refreshDepartmentList'); 
        $this->dispatch('closeModal'); 
    }

    public function render()
    {
        return view('livewire.departments.department-modal');
    }
}
