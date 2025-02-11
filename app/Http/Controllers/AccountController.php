<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Agency;
use App\Models\Branch;
use App\Models\Department;
use Illuminate\Support\Facades\Storage;
use App\Models\File;

class AccountController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $agns = Agency::all();
        $brns = Branch::all();
        $dpms = Department::all();
        return view('content.account.setting', compact('user', 'agns', 'brns', 'dpms'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'uploadImg' => 'image|mimes:jpeg,png|max:20480', // 20MB max size for JPG and PNG
        ]);

        $user = User::find(Auth::user()->id);
        if ($request->hasFile('uploadImg')) {
            // Get the file from the request
            $file = $request->file('uploadImg');

            // Generate a new filename based on the current datetime
            $fileName = now()->format('dmYHis') . '.' . $file->getClientOriginalExtension();

            // Store the file in the 'public' disk with the generated name
            $path = Storage::disk('local')->putFileAs('uploads/profile', $file, $fileName);

            $filePath = 'uploads/profile/'.$user->profile_img;
            // Update the user's profile image in the database
            $user->update(['profile_img' => $fileName]);

            if (Storage::disk('local')->exists($filePath)) {
                Storage::disk('local')->delete($filePath);
            }
            return response()->json(['message' => 'Profile image updated successfully']);
        }

        return response()->json(['error' => 'No image uploaded'], 400);
    }

    public function updateAccount(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|max:200|min:1',
            'email' => 'required|max:200|min:1',
            'agn' => 'required|max:200',
            'brn' => 'required|max:200',
            'dpm' => 'required|max:200',
        ]);

        try {
            $user = User::find(Auth::user()->id);

            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->agn = $validatedData['agn'];
            $user->brn = $validatedData['brn'];
            $user->dpm = $validatedData['dpm'];
            $user->save();

            $request->session()->flash('status', 'success!');
        } catch (\Exception $e) {
            $request->session()->flash('error', 'fail!');
        }
        return redirect()->back();
    }
}
