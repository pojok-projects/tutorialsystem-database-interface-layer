<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\UserSavedVideoModel;
use App\Traits\DndbQuery;

class UserSavedVideoController extends Controller
{
    // Include Trait inside Controller
    use DndbQuery;

    /**
     * @param UserSavedVideoModel $model
     * @param Request $request
     */
    public function index(UserSavedVideoModel $model, Request $request)
    {
        $count = $model->count();

        if($count == 0) {
            $message    = ', no data found with this query';
            $result     = [];
        } else {
            $message    = ', data has been found';
            $result     = $model->all();
        }

        return response()->json([
            'status' => [
                'code'      => '200',
                'message'   => 'index list query has been performed'. $message,
                'total'     => $count,
            ],
            'result' => $result,
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id'   => 'required',
            'video_id'  => 'required',
        ]);

        $user_id    = $request->input('user_id');
        $video_id   = $request->input('video_id');

        $query              = new UserSavedVideoModel();
        $query->id          = Str::uuid()->toString();
        $query->user_id     = $user_id;
        $query->video_id    = $video_id;
        $query->save();

        return response()->json([
            'status' => [
                'code'      => '200',
                'message'   => 'data has been saved',
            ],
            'result' => [
                'id' => $query->id,
            ],
        ], 200);
    }

    public function show(UserSavedVideoModel $model, string $id)
    {
        return $model->findOrFail($id);
    }

    public function search(UserSavedVideoModel $model, Request $request)
    {
        $this->validate($request, [
            'query' => 'required',
        ]);

        $query = $request->input('query');

        // Parse Function From Trait DndbQuery
        $query_eloquent = $this->ReqParse($query);

        // Performe Query
        $query = $model->where($query_eloquent);
        $count = $query->count();

        if($count == 0) {
            $message    = ', no data found with this query';
            $result     = [];
        } else {
            $message    = ', data has been found';
            $result     = $query->get();
        }

        return response()->json([
            'status' => [
                'code'      => '200',
                'message'   => 'search query has been performed'. $message,
                'total'     => $count,
            ],
            'result' => $result,
        ], 200);
    }

    public function update(UserSavedVideoModel $model, Request $request, string $id)
    {
        $query = $model->findOrFail($id);
        $query->update($request->all());

        return response()->json([
            'status' => [
                'code'      => '200',
                'message'   => 'data has been updated',
            ],
            'result' => [
                'id' => $query->id,
            ],
        ], 200);
    }

    public function delete(UserSavedVideoModel $model, string $id)
    {
        $query = $model->findOrFail($id);
        $query->delete();

        return response()->json([
            'status' => [
                'code'      => '200',
                'message'   => 'data has been deleted',
            ],
        ], 200);
    }
}