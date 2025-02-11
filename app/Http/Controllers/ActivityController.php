<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::orderBy('id', 'desc')->get();
        return view('content.activity.all-activities', compact('activities'));
    }

    public function addActivity()
    {
        return view('content.activity.add-activity');
    }

    public function editActivity($aid)
    {
        $activity = Activity::find($aid);
        return view('content.activity.edit-activity', compact('activity'));
    }

    public function storeActivity(Request $request)
    {
        $validator = validator($request->all(), [
            'images.*' => 'image|mimes:jpeg,png,jpg|max:20480',
            'ac_title' => 'required|max:1000',
            'ac_desc' => 'max:2000',
        ]);

        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return redirect()->back()->with('error', $firstError);
        }
        try {
            $media = [];
            $media['by'] = $request->user()->id;
            if ($request->images && $request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                        // Process each uploaded file
                        $imageName = $index . now()->format('dmYHis') . '.' . $image->getClientOriginalExtension();
                        $path = $image->storeAs('uploads/activity', $imageName, 'local');
                        // You can save the $imageName to the database or perform any other action as needed

                        $media[] = $imageName;
                }
            }

            $activity = Activity::create([
                'title' => $request->ac_title,
                'desc' => $request->ac_desc ?? '',
                'media' => json_encode($media),
            ]);

            return redirect()->route('admin-activities')->with('success', 'Create activity successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function updateActivity(Request $request, $aid)
    {
        $validator = validator($request->all(), [
            'images.*' => 'image|mimes:jpeg,png,jpg|max:20480',
            'ac_title' => 'required|max:1000',
            'ac_desc' => 'max:2000',
        ]);

        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return redirect()->back()->with('error', $firstError);
        }
        try {
            $activity = Activity::find($aid);
            $media = $activity->media;
            $media['by'] = $request->user()->id;

            if ($request->images && $request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    // Process each uploaded file
                    $imageName = $index . now()->format('dmYHis') . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('uploads/activity', $imageName, 'local');
                    // You can save the $imageName to the database or perform any other action as needed

                    $media[] = $imageName;
                }
            }

            $activity->update([
                'title' => $request->ac_title,
                'desc' => $request->ac_desc ?? $activity->desc,
                'media' => json_encode($media),
            ]);

            return redirect()->route('admin-activities')->with('success', 'Update activity successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Someting wrong!');
        }
    }

    public function delActivity($aid)
    {
        $activity = Activity::find($aid);
        $medias = $activity->media;

        foreach ($medias as $media) {
            $filePath = 'uploads/activity/'.$media;

            if (Storage::disk('local')->exists($filePath)) {
                Storage::disk('local')->delete($filePath);
            }
        }

        $activity->delete();

        return response()->json(['success' => true, 'data' => "Product is deleted!"]);
    }

    public function delMedia($aid, $delmedia) {
        $activity = Activity::find($aid);
        $medias = $activity->media;
        $newMedia = [];

        foreach ($medias as $key => $media) {
            $filePath = 'uploads/activity/'.$media;

            if (Storage::disk('local')->exists($filePath) && $media == $delmedia) {
                Storage::disk('local')->delete($filePath);
            } elseif ($media !== $delmedia) {
                if ($key == 'by') {
                    $newMedia[$key] = $media;
                } else {
                    $newMedia[] = $media;
                }
            }
        }
        $activity->media = json_encode($newMedia);
        $activity->save();
        return response()->json(['success' => true, 'data' => $newMedia]);
    }
}
