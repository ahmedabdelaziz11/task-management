@extends('layouts.master')
@section('title') Departments Management @endsection

@section('content')
    @livewire('departments.department-management')
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            Livewire.on('closeModal', () => {
                const modalIds = ['DepartmentModal','deleteConfirmationModal'];

                modalIds.forEach(id => {
                    const modalElement = document.getElementById(id);
                    
                    if (modalElement) {
                        const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
                        modalInstance.hide();
                    }
                });
            });
        });
    </script>
@endsection