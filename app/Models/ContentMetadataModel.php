<?php

namespace App\Models;

use BaoPham\DynamoDb\DynamoDbModel;

class ContentMetadataModel extends DynamoDbModel
{
    protected $fillable = [
        'user_id',
        'category_id',
        'video_title',
        'video_description',
        'video_genre',
        'video_viewers',
        'video_share',
        'video_saves',
        'video_downloads',
        'privacy',
    ];

    protected $table = 'ContentMetadata';
}