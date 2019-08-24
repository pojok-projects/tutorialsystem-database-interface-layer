<?php

namespace App\Models;

use BaoPham\DynamoDb\DynamoDbModel;

class UserFollowingModel extends DynamoDbModel
{
    protected $fillable = [
        'user_id',
        'following_user_id',
    ];

    protected $table = 'UserFollowing';
}