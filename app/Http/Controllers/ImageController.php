<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $image = new Image();
        $file = $request->file('image');
        $filename = uniqid() . "_" . $file->getClientOriginalName();
        $year = date("Y");
        $month = date("m");
        $pathname = '/storage/images/' . $year . '/' . $month . '/';

        // public folder
        $file->move(public_path($pathname), $filename);
        $url = URL::to('/') . $pathname . $filename;

        $image->url = $url;
        $image->name = $request->name;
        $image->save();

        // $hhh = [
        //     "url" => $url,
        //     "name" => $request->name,
        // ];

        return response()->json(['isSuccess' => true, "data" => $image]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if ($request->hasFile('image')) {}

        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $imageName = $request->image->getClientOriginalName();
        $year = date("Y");
        $month = date("m");
        $pathname = '/images' . $year . '/' . $month . '/';

        $request->image->storeAs($pathname, $imageName);

        $imageUrl = url($pathname . $imageName);

        return response()->json(['isSuccess' => true, "data" => $imageUrl]);
    }

    // public function storeImageUsingStorage(Request $request)
    // {
    //     $request->validate([
    //         'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
    //     ]);

    //     $imageName = $request->image->getClientOriginalName();
    //     $year = date("Y");
    //     $month = date("m");
    //     $pathname = 'images' . '/' . $year . '/' . $month . '/';

    //     Storage::disk('public')->putFileAs($pathname, $request->file('image'), $imageName);

    //     $imageUrl = Storage::url($pathname . $imageName);

    //     return response()->json(['isSuccess' => true, "data" => $imageUrl]);
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
