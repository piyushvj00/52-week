<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\StoreUserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', '!=', '1')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->email_verified_at = date('Y-m-d');
        $user->role = 2;
        $file = $request->file('profile');

        if (!$file) {
            return redirect()->back()->withErrors('No file uploaded.');
        }

        $destinationPath = public_path('uploads');
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0775, true);
        }

        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $fileName);
        chmod($destinationPath . '/' . $fileName, 0775);

        // Save to the database
        $user->profile = $fileName;
        $user->save();
        return redirect()->route('users.index')->with('success', 'User added successfully!');
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
        $users = User::findOrFail($id);
        if ($users->role == 2) {
            return view('admin.users.edit', compact('users'));
        } else {
            return view('admin.users.editastro', compact('users'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserUpdateRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->fill($request->all());
        $file = $request->file('profile');

        if ($file) {
            $destinationPath = public_path('uploads');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0775, true);
            }
    
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            chmod($destinationPath . '/' . $fileName, 0775);
    
            // Save to the database
            $user->profile = $fileName;
        }

        $user->save();
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User delete successfully!');
        ;

    }
    public function createAstro()
    {
        return view('admin.users.create-astro');
    }
    public function storeAstro(StoreUserRequest $request)
    {
        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->email_verified_at = date('Y-m-d');
        $user->role = 3;
        $file = $request->file('profile');

        if (!$file) {
            return redirect()->back()->withErrors('No file uploaded.');
        }

        $destinationPath = public_path('uploads');
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0775, true);
        }

        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $fileName);
        chmod($destinationPath . '/' . $fileName, 0775);

        // Save to the database
        $user->profile = $fileName;
        $user->save();
        return redirect()->route('users.index')->with('success', 'Astrologer added successfully!');
    }
}
