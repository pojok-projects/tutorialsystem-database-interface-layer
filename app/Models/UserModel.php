<?php

namespace App\Models;

use BaoPham\DynamoDb\DynamoDbModel;

class UserModel extends DynamoDbModel
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'birth_date',
        'gender',
        'photo_profile',
        'about',
        'website_link',
        'facebook_link',
        'twitter_link',
        'linkedin_link',
    ];

    protected $table = 'User';
}