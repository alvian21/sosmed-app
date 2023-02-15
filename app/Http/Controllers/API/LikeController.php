<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Http\Controllers\BaseController;
use App\Models\Follow;
use App\Models\PostLike;
use App\Models\User;

class LikeController extends BaseController
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
            'id' => 'required',
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
            $post_id = $request->get('id');

            $cek = PostLike::where('user_id', auth()->user()->id)->where('post_id', $post_id)->first();

            if ($cek) {
                PostLike::where('user_id', auth()->user()->id)->where('post_id', $post_id)->delete();
            } else {
                $like = new PostLike();
                $like->user_id = auth()->user()->id;
                $like->post_id = $post_id;
                $like->save();
            }

            DB::commit();

            return $this->sendResponse([], 'Success like');
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
        //
    }
}
