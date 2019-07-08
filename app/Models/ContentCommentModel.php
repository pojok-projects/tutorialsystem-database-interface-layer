<?php

namespace App\Models;

use BaoPham\DynamoDb\DynamoDbModel;

class ContentCommentModel extends DynamoDbModel
{
    protected $fillable = [
        'metadata_id',
        'user_id',
        'reply_id',
        'message',
    ];

    protected $table = 'ContentComment';
}