<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Http\Controllers\BaseController;
use App\Models\Follow;
use App\Models\User;

class FollowController extends BaseController
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
            'follow_user_id' => 'required',
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
            $follow_user_id = $request->get('follow_user_id');

            $cek = Follow::where('user_id', auth()->user()->id)->where('follow_user_id', $follow_user_id)->first();

            if ($cek) {
                $status_follow = false;
                Follow::where('user_id', auth()->user()->id)->where('follow_user_id', $follow_user_id)->delete();
            } else {
                $follow = new Follow();
                $follow->user_id = auth()->user()->id;
                $follow->follow_user_id = $follow_user_id;
                $follow->save();
                $status_follow = true;
            }

            $data['status_follow'] = $status_follow;

            DB::commit();

            return $this->sendResponse($data, 'Success follow');
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
