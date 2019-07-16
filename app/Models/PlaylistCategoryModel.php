<?php

namespace App\Models;

use BaoPham\DynamoDb\DynamoDbModel;

class PlaylistCategoryModel extends DynamoDbModel
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status'
    ];

    protected $table = 'PlaylistCategory';
}