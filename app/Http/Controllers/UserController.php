<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::where(function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        })
        ->whereNot('user_type', 'admin')
        ->paginate(10);

        return view('admin.users', compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users-details', compact('user'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->verified = true;
            $user->update();
    
            return redirect()->back()->with('success', 'User verification status updated successfully.');
        } catch (ModelNotFoundException $e) {
            // Handle the case when the user is not found
            return redirect()->back()->with('error', 'User not found.');
        } catch (\Exception $e) {
            // Handle any other exceptions
            return redirect()->back()->with('error', 'An error occurred while updating the user verification status.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User archived successfully.');
    }

    public function archives(Request $request)
    {
        $search = $request->input('search');

        $users = User::onlyTrashed()->where(function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        })
        ->whereNot('user_type', 'admin')
        ->paginate(10);
    
        return view('admin.archives', compact('users'));
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id); 

        $user->restore();
        return redirect()->route('users.archive')->with('success', 'User restored successfully');
    }
}
