<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\ContentCommentModel;

class ContentCommentController extends Controller
{
    /**
     * @param ContentCommentModel $model
     * @param Request $request
     */
    public function index(ContentCommentModel $model, Request $request, $id)
    {
        $query = $model->where('metadata_id', $id);
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

    public function store(Request $request)
    {
        $this->validate($request, [
            'metadata_id' => 'required',
            'user_id' => 'required',
            'message' => 'required',
        ]);

        $metadata_id    = $request->input('metadata_id');
        $user_id        = $request->input('user_id');
        $reply_id       = $request->input('reply_id');
        $message        = $request->input('message');
        
        if(empty($reply_id)) {
            $reply_id = null;
        }

        $query                  = new ContentCommentModel();
        $query->id              = Str::uuid()->toString();
        $query->metadata_id     = $metadata_id;
        $query->user_id         = $user_id;
        $query->reply_id        = $reply_id;
        $query->message         = $message;
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

    public function show(ContentCommentModel $model, string $id)
    {
        return $model->findOrFail($id);
    }

    public function update(ContentCommentModel $model, Request $request, string $id)
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

    public function delete(ContentCommentModel $model, string $id)
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