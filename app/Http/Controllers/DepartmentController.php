<?php

namespace App\Http\Controllers;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.departments.index');
    }
}
