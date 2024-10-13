<div class="card shadow">
    <div class="card-header border-0">
        <h3 class="mb-0">Department Management</h3>
            <div class="float-end">
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#DepartmentModal" wire:click="$dispatch('editDepartment', { id:0})"> Create New department</button>
            </div>
    </div>
    <div class="card-header border-0">
        <div class="row">
            <div class="col-12 col-md-12">
                <input type="text" wire:model.live.debounce.1000ms="name" name="name" class="form-control mb-3" placeholder="Search Departments by name...">
            </div>
        </div>            
    </div>
    <div class="table-responsive">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>employees count</th>
                    <th>employees sum salary</th>
                    <th width="150px">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($departments as $department)
                <tr>
                    <td>{{ $department->id }}</td>
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->employees_count }}</td>
                    <td>{{ number_format($department->employees_sum_salary,2) }}</td>
                    <td>
                        <button class="btn btn-sm btn-info" wire:click="$dispatch('editDepartment', { id: {{ $department->id }} })" data-bs-toggle="modal" data-bs-target="#DepartmentModal">Edit</button>
                        <button class="btn btn-sm btn-danger" wire:click="showDeleteConfirmation({{ $department->id }})" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal">Delete</button>
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
        {{ $departments->links('pagination-links') }}
    </div>
    @livewire('departments.department-modal')
    <div wire:ignore.self class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this department?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteDepartment">Delete</button>
                </div>
            </div>
        </div>
    </div>

</div>

