<?php

namespace App\Livewire\Tasks;

use App\Enums\TaskStatus;
use App\Http\Requests\EditTaskRequest;
use App\Services\TaskService;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class EditTaskModal extends Component
{
    public $task_id;
    public $title;
    public $description;
    public $status;
    public $statuses;
    
    protected $listeners = ['editTask' => 'loadTask'];

    public function mount()
    {
        $this->statuses = TaskStatus::cases();
    }

    public function loadTask($id,TaskService $taskService)
    {
        $this->resetForm();
        if ($id != 0) {
            $task = $taskService->getById($id);

            if (Auth::user()->id !== $task->employee_id) {
                abort(403, 'Unauthorized action.');
            }

            $this->task_id = $task->id;
            $this->title = $task->title;
            $this->description = $task->description;
            $this->status = $task->status;
        }
    }

    protected function resetForm()
    {
        $this->task_id = null;
        $this->title = '';
        $this->description = '';
        $this->status = '';
    }

    protected function rules(): array
    {
        return (new EditTaskRequest())->rules();
    }

    public function save(TaskService $taskService)
    {
        $data = $this->validate();

        $task = $taskService->getById($this->task_id);
        if (Auth::user()->id !== $task->employee_id) {
            abort(403, 'Unauthorized action.');
        }

        $taskService->update($task, $data);
        
        $this->resetForm();
        $this->dispatch('success','task updated successfully!'); 
        $this->dispatch('refreshTaskList'); 
        $this->dispatch('closeModal'); 
    }

    public function render()
    {
        return view('livewire.tasks.edit-task-modal');
    }
}
