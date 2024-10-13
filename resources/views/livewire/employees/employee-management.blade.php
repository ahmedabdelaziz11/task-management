<div class="card shadow">
    <div class="card-header border-0">
        <h3 class="mb-0">Employee Management</h3>
            <div class="float-end">
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#EmployeeModal" wire:click="$dispatch('editEmployee', { id:0})"> Create New employee</button>
            </div>
    </div>
    <div class="card-header border-0">
        <div class="row">
            <div class="col-4 col-md-4">
                <input type="text" wire:model.live.debounce.1000ms="phone" name="phone" class="form-control mb-3" placeholder="Search Employees by phone...">
            </div>
            <div class="col-4 col-md-4">
                <input type="text" wire:model.live.debounce.1000ms="email" name="email" class="form-control mb-3" placeholder="Search Employees by email...">
            </div>
            <div class="col-4 col-md-4">
                <input type="text" wire:model.live.debounce.1000ms="fullName" name="fullName" class="form-control mb-3" placeholder="Search Employees by name...">
            </div>
        </div>            
    </div>
    <div class="table-responsive">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th>first name</th>
                    <th>last name</th>
                    <th>salary</th>
                    <th>image</th>
                    <th>manager name</th>
                    <th width="150px">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employees as $employee)
                <tr>
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
                    <td>{{ $employee->salary }}</td>
                    <td>
                        <img src="{{ $employee->photo }}" alt="image" width="50">
                    </td>
                    <td>{{ $employee->manager->full_name }}</td>
                    <td>
                        <button class="btn btn-sm btn-info" wire:click="$dispatch('editEmployee', { id: {{ $employee->id }} })" data-bs-toggle="modal" data-bs-target="#EmployeeModal">Edit</button>
                        <button class="btn btn-sm btn-danger" wire:click="showDeleteConfirmation({{ $employee->id }})" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal">Delete</button>
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
        {{ $employees->links('pagination-links') }}
    </div>
    @livewire('employees.employee-modal')
    <div wire:ignore.self class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this employee?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteEmployee">Delete</button>
                </div>
            </div>
        </div>
    </div>

</div>

