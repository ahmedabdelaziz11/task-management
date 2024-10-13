<?php

namespace App\Http\Controllers;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.tasks.index');
    }
}
