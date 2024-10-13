<div class="card shadow">
    <div class="card-header border-0">
        <h3 class="mb-0">Task Management</h3>
            <div class="float-end">
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#CreateTaskModal"> Create New task</button>
            </div>
    </div>
    <div class="card-header border-0">
        <div class="row">
            <div class="col-6 col-md-6">
                <input type="text" wire:model.live.debounce.1000ms="title" name="title" class="form-control mb-3" placeholder="Search Tasks by title...">
            </div>
            <div class="col-6 col-md-6">
                <select wire:model.live="status" class="form-control mb-3">
                    <option value="">All Statuses</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->value }}">{{ $status->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>    
    <div class="table-responsive">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th>title</th>
                    <th>status</th>
                    <th>employee</th>
                    <th width="150px">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->employee->full_name }}</td>
                    <td>
                        <button class="btn btn-sm btn-info" wire:click="$dispatch('editTask', { id: {{ $task->id }} })" data-bs-toggle="modal" data-bs-target="#EditTaskModal">Edit</button>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td class="text-center">No data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center m-2">
        {{ $tasks->links('pagination-links') }}
    </div>
    @livewire('tasks.create-task-modal')
    @livewire('tasks.edit-task-modal')
</div>

