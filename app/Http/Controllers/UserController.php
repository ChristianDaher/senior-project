<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        dd('View all users');
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {
        
    }
}
