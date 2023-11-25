<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $data = post::all();
        return response()->json($data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";

            post::create($input);
        } else {
            post::create($input);
        }
        return response()->json('created successfully');
    }
    public function update(Request $request, $id)
    {

        $post = post::find($id);
        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            $post->update($input);
        }
        $post->update($input);
        return response()->json('updated successfully');
    }
    public function delete($id)
    {

        $post = post::find($id);
        $post->delete();
        return response()->json('delete successfully');
    }
}
