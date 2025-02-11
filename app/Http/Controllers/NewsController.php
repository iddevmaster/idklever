<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('id', 'desc')->get();
        return view('content.news.allnews', compact('blogs'));
    }

    public function addNews()
    {
        return view('content.news.add-news');
    }

    public function editNews($bid)
    {
        $blog = Blog::find($bid);
        return view('content.news.edit-news', compact('blog'));
    }

    public function storeNews(Request $request)
    {
        $validatedData = $request->validate([
            'news_title' => 'required|max:1000',
            'news_desc' => 'required|string',
            'news_cate' => 'required|max:100',
            'news_cover' => 'image|mimes:jpeg,png|max:20480',
        ]);
        try {
            $fileName = '';
            if ($request->hasFile('news_cover')) {
                // Get the file from the request
                $file = $request->file('news_cover');

                // Generate a new filename based on the current datetime
                $fileName = now()->format('dmYHis') . '.' . $file->getClientOriginalExtension();

                // Store the file in the 'public' disk with the generated name
                $path = Storage::disk('local')->putFileAs('uploads/news', $file, $fileName);
            }
            $newBlog = Blog::create([
                'title' => $validatedData['news_title'],
                'cover' => $fileName,
                'desc' => $validatedData['news_desc'],
                'type' => $validatedData['news_cate'],
                'create_by' => $request->user()->id,
            ]);

            $request->session()->flash('status', 'success!');

            return redirect()->route('admin-news');
        } catch (\Throwable $th) {
            //throw $th;
            $request->session()->flash('error', 'fail!');
            return redirect()->back();
        }
    }

    public function updateNews(Request $request ,$bid)
    {
        $validatedData = $request->validate([
            'news_title' => 'required|max:1000',
            'news_desc' => 'required|string',
            'news_cate' => 'required|max:100',
            'news_cover' => 'image|mimes:jpeg,png|max:20480',
        ]);

        try {
            $fileName = '';
            $blog = Blog::find($bid);
            if ($request->hasFile('news_cover')) {
                // Get the file from the request
                $file = $request->file('news_cover');

                // Generate a new filename based on the current datetime
                $fileName = now()->format('dmYHis') . '.' . $file->getClientOriginalExtension();

                // Store the file in the 'public' disk with the generated name
                $path = Storage::disk('local')->putFileAs('uploads/news', $file, $fileName);

                $filePath = 'uploads/news/'.$blog->cover;
                if (Storage::disk('local')->exists($filePath)) {
                    Storage::disk('local')->delete($filePath);
                }

                $blog->cover = $fileName;
            }

            $blog->title = $validatedData['news_title'];
            $blog->desc = $validatedData['news_desc'];
            $blog->type = $validatedData['news_cate'];
            $blog->save();

            $request->session()->flash('status', 'You change has been saved!');
            return redirect()->route('admin-news');
        } catch (\Throwable $th) {
            //throw $th;
            $request->session()->flash('error', 'fail!');
            return redirect()->back();
        }
    }

    public function delNews($bid)
    {
        $blog = Blog::find($bid);

        $filePath = 'uploads/news/'.$blog->cover;

        if (Storage::disk('local')->exists($filePath)) {
            Storage::disk('local')->delete($filePath);
        }

        $blog->delete();

        return response()->json(['success' => true, 'data' => "News is deleted!"]);
    }
}
