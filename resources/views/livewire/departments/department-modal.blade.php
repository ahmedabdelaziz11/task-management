<div wire:ignore.self class="modal modal-lg fade livewiremodal" x-on:close-modal.window="on = false" id="DepartmentModal"
    tabindex="-1" aria-labelledby="DepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form wire:submit.prevent="save" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="DepartmentModalLabel">{{ $formTitle }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <hr style="margin: 0px">
                <div class="modal-body">
                    <div class="row m-1">
                        <div class="col-12 mt-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                wire:model="name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
