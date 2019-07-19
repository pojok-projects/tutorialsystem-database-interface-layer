<?php

namespace App\Models;

use BaoPham\DynamoDb\DynamoDbModel;

class ContentLikeModel extends DynamoDbModel
{
    protected $fillable = [
        'user_id',
        'metadata_id',
    ];

    protected $table = 'ContentLike';
}