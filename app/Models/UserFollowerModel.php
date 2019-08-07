<?php

namespace App\Models;

use BaoPham\DynamoDb\DynamoDbModel;

class UserFollowerModel extends DynamoDbModel
{
    protected $fillable = [
        'user_id',
        'follower_user_id',
    ];

    protected $table = 'UserFollower';
}