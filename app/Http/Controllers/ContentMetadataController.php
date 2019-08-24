<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\ContentMetadataModel;
use App\Traits\DndbQuery;

class ContentMetadataController extends Controller
{
    // Include Trait inside Controller
    use DndbQuery;

    /**
     * @param ContentMetadataModel $model
     * @param Request $request
     */
    public function index(ContentMetadataModel $model, Request $request)
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
            'category_id'           => 'required',
            'video_title'           => 'required',
            'video_description'     => 'required',
            'video_genre'           => 'required',
            'privacy'               => 'required',
        ]);

        $user_id                = $request->input('user_id');
        $category_id            = $request->input('category_id');
        $video_title            = $request->input('video_title');
        $video_description      = $request->input('video_description');
        $video_genre            = $request->input('video_genre');
        $video_viewers          = $request->input('video_viewers') ?? null;
        $video_share            = $request->input('video_share') ?? null;
        $video_saves            = $request->input('video_saves') ?? null;
        $video_downloads        = $request->input('video_downloads') ?? null;
        $privacy                = $request->input('privacy');
        $metavideos             = $request->input('metavideos') ?? null;
        $subtitle               = $request->input('subtitle') ?? null;
        $comments               = $request->input('comments') ?? null;
        $likes                  = $request->input('likes') ?? null;
        $dislikes               = $request->input('dislikes') ?? null;

        $query                          = new ContentMetadataModel();
        $query->id                      = Str::uuid()->toString();
        $query->user_id                 = $user_id;
        $query->category_id             = $category_id;
        $query->video_title             = $video_title;
        $query->video_description       = $video_description;
        $query->video_genre             = $video_genre;
        $query->video_viewers           = $video_viewers;
        $query->video_share             = $video_share;
        $query->video_saves             = $video_saves;
        $query->video_downloads         = $video_downloads;
        $query->privacy                 = $privacy;
        $query->metavideos              = $metavideos;
        $query->subtitle                = $subtitle;
        $query->comments                = $comments;
        $query->likes                   = $likes;
        $query->dislikes                = $dislikes;
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

    public function show(ContentMetadataModel $model, string $id)
    {
        return $model->findOrFail($id);
    }

    /**
     * Search Query Function, urlencode required
     * Example : 
     * query="video_title=Sponsbob"
     */
    public function search(ContentMetadataModel $model, Request $request)
    {
        $this->validate($request, [
            'query' => 'required',
        ]);

        $query = $request->input('query');

        // Parse Function From Trait DndbQuery
        $query_eloquent = $this->ReqParse($query);

        // Improve Query Builder Search
        $query = null;
        foreach($query_eloquent as $key => $value) {
            $query = $model->where($key, 'contains', $value);
        }

        // Performe Query
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

    public function update(ContentMetadataModel $model, Request $request, string $id)
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

    public function delete(ContentMetadataModel $model, string $id)
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