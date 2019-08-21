<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\PlaylistCategoryModel;

class PlaylistCategoryController extends Controller
{
    /**
     * @param PlaylistCategoryModel $model
     * @param Request $request
     */
    public function index(PlaylistCategoryModel $model, Request $request)
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
            'user_id'       => 'required',
            'title'         => 'required',
            'description'   => 'required',
            'status'        => 'required',
        ]);

        $user_id        = $request->input('user_id');
        $title          = $request->input('title');
        $description    = $request->input('description');
        $status         = $request->input('status');     

        $query              = new PlaylistCategoryModel();
        $query->id          = Str::uuid()->toString();
        $query->user_id     = $user_id;
        $query->title       = $title;
        $query->description = $description;
        $query->status      = $status;
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

    public function show(PlaylistCategoryModel $model, string $id)
    {
        return $model->findOrFail($id);
    }

    /**
     * Search Query Function, urlencode required
     * Example : 
     * query="video_title=Sponsbob"
     */
    public function search(PlaylistCategoryModel $model, Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $title = $request->input('title');

        $query = $model->where('title', 'contains', $title);
        $count = $query->count();

        if($count == 0) {
            $message = ', no data found with this query';
            $result = [];
        } else {
            $message = ', data has been found';
            $result = $query->get();
        }

        return response()->json([
            'status' => [
                'code' => '200',
                'message' => 'search query has been performed'. $message,
                'total' => $count,
            ],
            'result' => $result,
        ], 200);
    }

    public function update(PlaylistCategoryModel $model, Request $request, string $id)
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

    public function delete(PlaylistCategoryModel $model, string $id)
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