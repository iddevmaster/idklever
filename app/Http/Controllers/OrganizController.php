<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agency;
use App\Models\Branch;
use App\Models\Department;

class OrganizController extends Controller
{
    public function index()
    {
        $agns = Agency::all();
        $brns = Branch::all();
        $dpms = Department::all();
        return view('content.organiz.table', compact('agns', 'brns', 'dpms'));
    }

    public function addAgn(Request $request)
    {
        $validatedData = $request->validate([
            'addName' => 'required|max:200',
        ]);
        if ($request->addtype == 'agn') {
            Agency::create([
                'name' => $validatedData['addName'],
            ]);
        } elseif ($request->addtype == 'brn') {
            Branch::create([
                'name' => $validatedData['addName'],
                'agn' => $request->selected,
            ]);
        } elseif ($request->addtype == 'dpm') {
            Department::create([
                'name' => $validatedData['addName'],
                'brn' => $request->selected,
            ]);
        }
        return response()->json(['success' => true, 'data' => $request->all()]);
    }

    public function deleteData(Request $request)
    {
        if ($request->delType == 'agn') {
            Agency::find($request->delId)->delete();
        } elseif ($request->delType == 'brn') {
            Branch::find($request->delId)->delete();
        } elseif ($request->delType == 'dpm') {
            Department::find($request->delId)->delete();
        }
        return response()->json(['success' => true, 'data' => $request->all()]);
    }
}
