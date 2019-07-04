<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\ContentCategoryModel;

class ContentCategoryController extends Controller
{
    /**
     * @param ContentCategoryModel $model
     * @param Request $request
     */
    public function index(ContentCategoryModel $model, Request $request)
    {
        return $model->all();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $name           = $request->input('name');
        $description    = $request->input('description');

        $query              = new ContentCategoryModel();
        $query->id          = Str::uuid()->toString();
        $query->name        = $name;
        $query->description = $description;
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

    public function show(ContentCategoryModel $model, string $id)
    {
        return $model->findOrFail($id);
    }

    public function update(ContentCategoryModel $model, Request $request, string $id)
    {
        $query = $model->findOrFail($id);
        $title = $request->input('title');

        $query->title = $title;
        $query->save();

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

    public function delete(ContentCategoryModel $model, string $id)
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