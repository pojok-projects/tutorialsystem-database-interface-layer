<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\ContentMetadataVideoModel;
use App\Traits\DndbQuery;

class ContentMetadataVideoController extends Controller
{
    // Include Trait inside Controller
    use DndbQuery;

    /**
     * @param ContentMetadataVideoModel $model
     * @param Request $request
     */
    public function index(ContentMetadataVideoModel $model, Request $request)
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
            'metadata_id'   => 'required',
            'file_name'     => 'required',
            'file_path'     => 'required',
            'size'          => 'required',
            'format'        => 'required',
            'resolution'    => 'required',
            'duration'      => 'required',
        ]);

        $metadata_id    = $request->input('metadata_id'); 
        $file_name      = $request->input('file_name');
        $file_path      = $request->input('file_path');
        $size           = $request->input('size');
        $format         = $request->input('format');
        $resolution     = $request->input('resolution');
        $duration       = $request->input('duration');

        $query                  = new ContentMetadataVideoModel();
        $query->id              = Str::uuid()->toString();
        $query->metadata_id     = $metadata_id;
        $query->file_name       = $file_name;
        $query->file_path       = $file_path;
        $query->size            = $size;
        $query->format          = $format;
        $query->resolution      = $resolution;
        $query->duration        = $duration;
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

    public function show(ContentMetadataVideoModel $model, string $id)
    {
        return $model->findOrFail($id);
    }

    /**
     * Search Query Function, urlencode required
     * Example : 
     * query="video_title=Sponsbob"
     */
    public function search(ContentMetadataVideoModel $model, Request $request)
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

    public function update(ContentMetadataVideoModel $model, Request $request, string $id)
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

    public function delete(ContentMetadataVideoModel $model, string $id)
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