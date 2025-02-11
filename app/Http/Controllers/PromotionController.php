<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::orderBy('id', 'desc')->get();
        return view('content.promotion.allPromotion', compact('promotions'));
    }

    public function addPromotion()
    {
        return view('content.promotion.add-promotion');
    }

    public function editPromotion($bid)
    {
        $promotion = Promotion::find($bid);
        return view('content.promotion.edit-promotion', compact('promotion'));
    }

    public function storePromotion(Request $request)
    {
        $validatedData = $request->validate([
            'promo_title' => 'required|max:1000',
            'promo_desc' => 'required|string',
            'daterange' => 'required|max:100',
            'promo_cover' => 'image|mimes:jpeg,png|max:20480',
        ]);
        try {
            $fileName = '';
            if ($request->hasFile('promo_cover')) {
                // Get the file from the request
                $file = $request->file('promo_cover');

                // Generate a new filename based on the current datetime
                $fileName = now()->format('dmYHis') . '.' . $file->getClientOriginalExtension();

                // Store the file in the 'public' disk with the generated name
                $path = Storage::disk('local')->putFileAs('uploads/promotion', $file, $fileName);
            }
            $newProm = Promotion::create([
                'title' => $validatedData['promo_title'],
                'cover' => $fileName,
                'desc' => $validatedData['promo_desc'],
                'date' => $validatedData['daterange'],
                'create_by' => $request->user()->id,
            ]);

            $request->session()->flash('status', 'success!');

            return redirect()->route('admin-promotion');
        } catch (\Throwable $th) {
            //throw $th;
            $request->session()->flash('error', 'fail!');
            return redirect()->back();
        }
    }

    public function updatePromotion(Request $request ,$bid)
    {
        $validatedData = $request->validate([
            'promo_title' => 'required|max:1000',
            'promo_desc' => 'required|string',
            'daterange' => 'required|max:100',
            'promo_cover' => 'image|mimes:jpeg,png|max:20480',
        ]);
        try {
            $fileName = '';
            $blog = Promotion::find($bid);
            if ($request->hasFile('promo_cover')) {
                // Get the file from the request
                $file = $request->file('promo_cover');

                // Generate a new filename based on the current datetime
                $fileName = now()->format('dmYHis') . '.' . $file->getClientOriginalExtension();

                // Store the file in the 'public' disk with the generated name
                $path = Storage::disk('local')->putFileAs('uploads/promotion', $file, $fileName);

                $filePath = 'uploads/promotion/'.$blog->cover;
                if (Storage::disk('local')->exists($filePath)) {
                    Storage::disk('local')->delete($filePath);
                }

                $blog->cover = $fileName;
            }

            $blog->title = $validatedData['promo_title'];
            $blog->desc = $validatedData['promo_desc'];
            $blog->date = $validatedData['daterange'];
            $blog->save();

            $request->session()->flash('status', 'You change has been saved!');
            return redirect()->route('admin-promotion');
        } catch (\Throwable $th) {
            //throw $th;
            $request->session()->flash('error', 'fail!');
            return redirect()->back();
        }
    }

    public function delPromotion($bid)
    {
        $blog = Promotion::find($bid);

        $filePath = 'uploads/promotion/'.$blog->cover;

        if (Storage::disk('local')->exists($filePath)) {
            Storage::disk('local')->delete($filePath);
        }

        $blog->delete();

        return response()->json(['success' => true, 'data' => "Promotion is deleted!"]);
    }
}
