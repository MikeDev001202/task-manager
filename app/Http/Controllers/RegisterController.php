<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;

class RegisterController extends Controller
{
    protected $root = 'task-manager';

    /**
     * Return login view 
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
    */
    public function index()
    {
        return view('register');
    }

    /**
     * Store user details to database
     * 
     * @param RegisterUserRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(RegisterUserRequest $request)
    {
        $validatedFields = $request->validated();
        User::registerUser($validatedFields);
        return redirect()->route('login')->with('message', 'New user successfully created. Log into Site');
    }

}
