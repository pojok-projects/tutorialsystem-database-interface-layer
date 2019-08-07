<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\ContentSubtitleModel;

class SubtitleController extends Controller
{
    /**
     * @param ContentSubtitleModel $model
     * @param Request $request
     */
    public function index(ContentSubtitleModel $model, Request $request)
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
            'name'          => 'required',
            'description'   => 'required'
        ]);

        $name           = $request->input('name');
        $description    = $request->input('description');

        $query              = new ContentSubtitleModel();
        $query->id          = Str::uuid()->toString();
        $query->name        = $name;
        $query->description = $description;
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

    public function show(ContentSubtitleModel $model, string $id)
    {
        return $model->findOrFail($id);
    }

    public function search(ContentSubtitleModel $model, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $name = $request->input('name');

        $query = $model->where('name', $name);
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

    public function update(ContentSubtitleModel $model, Request $request, string $id)
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

    public function delete(ContentSubtitleModel $model, string $id)
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