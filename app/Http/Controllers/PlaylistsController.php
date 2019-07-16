<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\PlaylistsModel;

class PlaylistsController extends Controller
{
    /**
     * @param PlaylistsModel $model
     * @param Request $request
     */
    public function index(PlaylistsModel $model, Request $request)
    {
        $count = $model->count();

        if($count == 0) {
            $message = ', no data found with this query';
            $result = [];
        } else {
            $message = ', data has been found';
            $result = $model->all();
        }

        return response()->json([
            'status' => [
                'code' => '200',
                'message' => 'index list query has been performed'. $message,
                'total' => $count,
            ],
            'result' => $result,
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id'               => 'required',
            'playlistcategory_id'   => 'required',
            'metadata_id'           => 'required',
        ]);

        $user_id                = $request->input('user_id');
        $playlistcategory_id    = $request->input('playlistcategory_id');
        $metadata_id            = $request->input('metadata_id');
        $order_list             = $request->input('order_list');
        $last_watch             = $request->input('last_watch'); 

        $query                          = new PlaylistsModel();
        $query->id                      = Str::uuid()->toString();
        $query->user_id                 = $user_id;
        $query->playlistcategory_id     = $playlistcategory_id;
        $query->metadata_id             = $metadata_id;
        $query->order_list              = $order_list ?? null;
        $query->last_watch              = $last_watch ?? null;
        $query->save();

        return response()->json([
            'status' => [
                'code' => '200',
                'message' => 'data has been saved',
            ],
            'result' => [
                'id' => $query->id,
            ],
        ], 200);
    }

    public function show(PlaylistsModel $model, string $id)
    {
        $playlist   = $model->findOrFail($id);

        $previous   = $model->where('order_list', '<', $playlist['order_list'])->first();
        $next       = $model->where('order_list', '>', $playlist['order_list'])->first();

        return response()->json([
            'status' => [
                'code' => '200',
                'message' => 'data has been saved',
            ],
            'result' => [
                'playlist' => $playlist,
                'next' => $next,
                'previous' => $previous,
            ],
        ], 200);
    }

    public function update(PlaylistsModel $model, Request $request, string $id)
    {
        $query = $model->findOrFail($id);
        $query->update($request->all());

        return response()->json([
            'status' => [
                'code' => '200',
                'message' => 'data has been updated',
            ],
            'result' => [
                'id' => $query->id,
            ],
        ], 200);
    }

    public function delete(PlaylistsModel $model, string $id)
    {
        $query = $model->findOrFail($id);
        $query->delete();

        return response()->json([
            'status' => [
                'code' => '200',
                'message' => 'data has been deleted',
            ],
        ], 200);
    }
}

?>