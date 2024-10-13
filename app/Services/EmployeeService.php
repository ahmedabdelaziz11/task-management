<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EmployeeService
{
    public function index(array $data = [])
    {
        $email    = isset($data['email'])    ? $data['email']    : null;   
        $phone    = isset($data['phone'])    ? $data['phone']    : null;   
        $fullName = isset($data['fullName']) ? $data['fullName'] : null;    

        return User::query()
            ->select([
                'id',
                'first_name',
                'last_name',
                'salary',
                'image',
                'manager_id',
            ])        
            ->with([
                'manager:id,first_name,last_name',
                'department:id,name',
            ])
            ->where('role',UserRole::EMPLOYEE->value)
            ->when($email,function($q) use ($email){
                return $q->where('email',$email);
            })
            ->when($phone,function($q) use ($phone){
                return $q->where('phone',$phone);
            })
            ->when($fullName,function($q) use ($fullName){
                return $q->Where(DB::raw("CONCAT(users.first_name, ' ', users.last_name)"), 'like', "%{$fullName}%");
            })
            ->orderByDesc('id')
            ->paginate(10);
    }

    public function updateOrCreate(array $data,int $user_id = null)
    {
        if ($data['image']) {
            $timestamp = now()->timestamp;
            $extension = $data['image']->getClientOriginalExtension();
            $fileName = $timestamp . '.' . $extension;
            $data['image'] = $data['image']->storeAs('employees', $fileName, 'public_folder');
        }else{
            unset($data['image']);
        }
        return User::updateOrCreate(['id' => $user_id],$data);
    }

    public function getById(int $id)
    {
        return User::findOrFail($id);
    }

    public function delete($id): bool
    {
        return User::findOrFail($id)
            ->delete();
    }

    public function getManagers()
    {
        return User::query()
            ->select([
                'id',
                'first_name',
                'last_name',
            ])        

            ->where('role',UserRole::MANAGER->value)
            ->orderByDesc('id')
            ->get();
    }

    public function getManagerEmployees()
    {
        return User::query()
        ->select([
            'id',
            'first_name',
            'last_name',
        ])        

        ->where('manager_id',auth()->id())
        ->orderByDesc('id')
        ->get();
    }
}
