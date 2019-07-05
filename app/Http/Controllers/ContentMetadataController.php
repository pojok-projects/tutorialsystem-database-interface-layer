<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\ContentMetadataModel;

class ContentMetadataController extends Controller
{
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
            'category_id'           => 'required',
            'name_uploader'         => 'required',
            'video_title'           => 'required',
            'video_description'     => 'required',
            'video_subtitle'        => 'required',
            'video_genre'           => 'required',
            'video_format'          => 'required',
            'video_size'            => 'required',
            'video_resolution'      => 'required',
            'video_duration'        => 'required',
            'video_viewers'         => 'required',
            'video_comments'        => 'required',
            'video_likes'           => 'required',
            'video_dislikes'        => 'required',
            'video_users_likes'     => 'required',
            'video_users_dislikes'  => 'required',
            'video_share'           => 'required',
            'video_saves'           => 'required',
            'video_downloads'       => 'required',
        ]);

        $category_id            = $request->input('category_id');
        $name_uploader          = $request->input('name_uploader');
        $video_title            = $request->input('video_title');
        $video_description      = $request->input('video_description');
        $video_subtitle         = $request->input('video_subtitle');
        $video_genre            = $request->input('video_genre');
        $video_format           = $request->input('video_format');
        $video_size             = $request->input('video_size');
        $video_resolution       = $request->input('video_resolution');
        $video_duration         = $request->input('video_duration');
        $video_viewers          = $request->input('video_viewers');
        $video_comments         = $request->input('video_comments');
        $video_likes            = $request->input('video_likes');
        $video_dislikes         = $request->input('video_dislikes');
        $video_users_likes      = $request->input('video_users_likes');
        $video_users_dislikes   = $request->input('video_users_dislikes');
        $video_share            = $request->input('video_share');
        $video_saves            = $request->input('video_saves');
        $video_downloads        = $request->input('video_downloads');        

        $query                          = new ContentMetadataModel();
        $query->id                      = Str::uuid()->toString();
        $query->category_id             = $category_id;
        $query->name_uploader           = $name_uploader;
        $query->video_title             = $video_title;
        $query->video_description       = $video_description;
        $query->video_subtitle          = $video_subtitle;
        $query->video_genre             = $video_genre;
        $query->video_format            = $video_format;
        $query->video_size              = $video_size;
        $query->video_resolution        = $video_resolution;
        $query->video_duration          = $video_duration;
        $query->video_viewers           = $video_viewers;
        $query->video_comments          = $video_comments;
        $query->video_likes             = $video_likes;
        $query->video_dislikes          = $video_dislikes;
        $query->video_users_likes       = $video_users_likes;
        $query->video_users_dislikes    = $video_users_dislikes;
        $query->video_share             = $video_share;
        $query->video_saves             = $video_saves;
        $query->video_downloads         = $video_downloads;
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

        $query_request_raw = $request->input('query');
        $query_request = urldecode($query_request_raw);
        
        $query_build = str_replace('"', '', $query_request);
        $query_parse = explode(',', $query_build);

        $query_eloquent = [];
        foreach($query_parse as $query_build_parse) 
        {
            $parse_explode = explode('=', $query_build_parse);
            $query_eloquent[] = [
                $parse_explode[0] => $parse_explode[1]
            ];
        }

        $query = $model->where($query_eloquent);
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