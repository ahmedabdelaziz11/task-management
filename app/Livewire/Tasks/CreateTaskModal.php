<?php

namespace App\Livewire\Tasks;

use App\Enums\TaskStatus;
use App\Http\Requests\CreateTaskRequest;
use App\Services\EmployeeService;
use App\Services\TaskService;
use Livewire\Component;

class CreateTaskModal extends Component
{
    public $task_id;
    public $title;
    public $description;
    public $status;
    public $employee_id;
    public $statuses;
    public $employees  = [];

    public function mount(EmployeeService  $employeeService)
    {
        $this->employees = $employeeService->getManagerEmployees();
        $this->statuses  = TaskStatus::cases();
    }

    public function resetForm()
    {
        $this->task_id     = null;
        $this->title       = '';
        $this->description = '';
        $this->employee_id = '';
    }

    protected function rules(): array 
    {
        return (new CreateTaskRequest())->rules();
    } 


    public function save(TaskService  $taskService)
    {
        $data = $this->validate(); 
        $taskService->create($data);
        $this->resetForm();
        $this->dispatch('success','task saved successfully!'); 
        $this->dispatch('refreshTaskList'); 
        $this->dispatch('closeModal'); 
    }

    public function render()
    {
        return view('livewire.tasks.create-task-modal');
    }
}
