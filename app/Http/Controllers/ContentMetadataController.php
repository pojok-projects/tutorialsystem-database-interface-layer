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
        $title = $request->input('title');

        if ($title == null) {
            return $model->all();
        } else {
            return $model->where('title', '=', $title)->get();
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required'
        ]);

        $title = $request->input('title');

        $query = new ContentMetadataModel();
        $query->id = Str::uuid()->toString();
        $query->save();

        return $movie->id;
    }

    public function show(ContentMetadataModel $model, string $id)
    {
        return $model->findOrFail($id);
    }

    public function update(ContentMetadataModel $model, Request $request, string $id)
    {
        $query = $model->findOrFail($id);
        $title = $request->input('title');

        $query->title = $title;
        $query->save();

        return response()->json([
            'status' => '200',
            'message' => 'data has been updated',
            'id' => $query->id,
        ], 200);
    }

    public function delete(ContentMetadataModel $model, string $id)
    {
        $query = $model->findOrFail($id);
        $query->delete();

        return response()->json([
            'status' => '200',
            'message' => 'data has been deleted',
        ], 200);
    }
}

?>