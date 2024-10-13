<?php

namespace App\Livewire\Tasks;

use App\Enums\TaskStatus;
use App\Services\TaskService;
use Livewire\Component;
use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;

class TaskList extends Component
{
    use WithPagination;

    protected $listeners = ['refreshTaskList' => 'refreshTaskList'];

    public $status      = '';
    public $title       = '';
    public $statuses    = [];
    public $currentPage = 1;

    public function mount()
    {
        $this->statuses = TaskStatus::cases();
    }

    public function render(TaskService $service)
    {
        $tasks = $service->index([
            'status' => $this->status,
            'title'  => $this->title,
        ]);
        return view('livewire.tasks.task-management', ['tasks' => $tasks]);
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

    public function refreshTaskList()
    {
        $this->resetPage();
    }
}
