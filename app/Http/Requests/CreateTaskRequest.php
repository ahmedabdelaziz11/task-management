<?php

namespace App\Http\Requests;

use App\Enums\TaskStatus;
use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->role === UserRole::MANAGER->value;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => ['required', Rule::in(array_map(fn($status) => $status->value, TaskStatus::cases()))],
            'employee_id' => ['required',Rule::exists('users', 'id')->where('role', 'employee')],
        ];
    }
}
