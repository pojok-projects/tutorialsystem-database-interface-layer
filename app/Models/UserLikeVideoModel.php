<?php

namespace App\Models;

use BaoPham\DynamoDb\DynamoDbModel;

class UserLikeVideoModel extends DynamoDbModel
{
    protected $fillable = [
        'user_id',
        'video_id',
    ];

    protected $table = 'UserLikeVideo';
}