<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\User;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only('search', 'trashed');

        $admins = User::whereHas('admin')
            ->orderBy('name')
            ->filter($filters)
            ->paginate(10)
            ->withQueryString()
            ->through(function ($admin) {
                return [
                    'id' => $admin->id,
                    'name' => $admin->name,
                    'email' => $admin->email,
                    'deleted_at' => $admin->deleted_at,
                ];
            });

        return Inertia::render('Dashboard/Admin/Index', [
            'filters' => $filters,
            'admins' => $admins,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Dashboard/Admin/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Admin::create([
            'user_id' => $user->id
        ]);

        return Redirect::route('painel.admin.index')->with('success', 'Admin registrado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $admin = User::withTrashed()->where('id', $id)->first();
        return Inertia::render('Dashboard/Admin/Edit', [
            'admin' => [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
                'deleted_at' => $admin->deleted_at,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)]
        ]);

        $user->update(request()->only('name', 'email'));

        if ($request->password) {
            $request->validate(['password' => ['required', 'string', 'min:8', 'confirmed']]);
            $hash = Hash::make($request->password);
            $user->update(['password' => $hash]);
        }

        return Redirect::back()->with('success', 'Admin atualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();


        return Redirect::route('painel.admin.index')->with('success', 'Admin excluído.');
    }

    public function restore($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();
        $user->restore();

        return Redirect::back()->with('success', 'Admin rastaurado.');
    }
}
