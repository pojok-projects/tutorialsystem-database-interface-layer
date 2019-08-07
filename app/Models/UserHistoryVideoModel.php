<?php

namespace App\Models;

use BaoPham\DynamoDb\DynamoDbModel;

class UserHistoryVideoModel extends DynamoDbModel
{
    protected $fillable = [
        'user_id',
        'video_id',
        'last_watch',
    ];

    protected $table = 'UserHistoryVideo';
}