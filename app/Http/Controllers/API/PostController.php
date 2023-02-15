<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Http\Controllers\BaseController;
use App\Models\PostLike;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->get('status');

        if ($status) {
            $post = Post::where('user_id', auth()->user()->id)->withCount('postLike')->with('postComment.user')->get();
        } else {
            $post = Post::where('user_id', $request->get('user_id'))->withCount('postLike')->with('postComment.user')->get();
        }

        $post = tap($post)->transform(function ($data) {

            $liked = PostLike::where('user_id', auth()->user()->id)->where('post_id',$data->id)->count();

            $data->liked = ($liked > 0) ? true : false;

            return $data;
        });


        return $this->sendResponse($post, 'Post retrieved');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'image' => 'required|mimes:png,jpg|image|max:1024',
        ]);

        if ($validator->fails()) {

            $response = [
                'success' => false,
                'message' => $validator->errors()->first()
            ];

            return response()->json($response, 400);
        }

        DB::beginTransaction();

        try {

            $post = new Post();
            $post->description = $request->get('description');
            $post->user_id = auth()->user()->id;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = rand(10000, 99999) . time() . '-' . $file->getClientOriginalName();
                $file->storeAs('public', $filename);
                $post->image = $filename;
            }
            $post->save();

            DB::commit();

            return $this->sendResponse($post, 'Post created');
        } catch (\Exception $e) {

            DB::rollBack();

            return $this->sendError('Internal server error', $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('user_id', auth()->user()->id)->where('id', $id)->first();

        unlink(storage_path('app/public/' . $post->image));

        Post::where('user_id', auth()->user()->id)->where('id', $id)->delete();

        return $this->sendResponse([], 'Post deleted');
    }
}
