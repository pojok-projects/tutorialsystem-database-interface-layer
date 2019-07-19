<?php

namespace App\Models;

use BaoPham\DynamoDb\DynamoDbModel;

class ContentDislikeModel extends DynamoDbModel
{
    protected $fillable = [
        'user_id',
        'metadata_id',
    ];

    protected $table = 'ContentDislike';
}