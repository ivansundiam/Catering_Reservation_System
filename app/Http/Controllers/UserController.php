<?php

namespace App\Http\Controllers;

use App\Events\AccountVerified;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $userStatusFilter = request()->input('user-status');

        $query = User::query();

        if($search){
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%");
        }

        if($userStatusFilter === "verified"){
            $query->where('verified', 1);
        }
        else if($userStatusFilter === "unverified"){
            $query->where('verified', 0);

        }
        
        $users = $query
            ->whereNot('user_type', 'admin')
            ->latest()
            ->paginate(10);

        // If no filters or search terms are provided, load all inventory
        if(!$search && !$userStatusFilter){
            $users = User::whereNot('user_type', 'admin')->latest()->paginate(10);
        }

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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->verified = true;
            $user->update();

            event(new AccountVerified($user));
    
            return redirect()->back()->with('success', 'User verification status updated successfully.');
        } catch (ModelNotFoundException $e) {
            // Handle the case when the user is not found
            return redirect()->back()->with('error', 'User not found.');
        } catch (\Exception $e) {
            // Handle any other exceptions
            Log::error('An error occurred while updating the user verification status: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()->with('error', 'An error occurred while updating the user verification status.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);

            $user->delete();

            return redirect()->route('users.index')->with('success', 'User archived successfully.');
        } catch (\Exception $e) {
            // Handle any other exceptions
            Log::error('An error occurred while archiving an account: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()->with('error', 'An error occurred while archiving an account.');
        }
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
        try {
            $user = User::withTrashed()->findOrFail($id); 
    
            $user->restore();
            return redirect()->route('users.archive')->with('success', 'User restored successfully');
        } catch (\Exception $e) {
            // Handle any other exceptions
            Log::error('An error occurred while creating an account: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()->with('error', 'An error occurred while creating an account.');
        }
    }

    public function forceDelete($id)
    {
        try {
            $user = User::withTrashed()->findOrFail($id); 
    
            $user->forceDelete();

            return redirect()->route('users.archive')->with('success', 'User deleted permanently.');
        } catch (\Exception $e) {
            // Handle any other exceptions
            Log::error('An error occurred while deleting an account: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()->with('error', 'An error occurred while deleting an account.');
        }
    }
}
