<?php

namespace App\Models;

use BaoPham\DynamoDb\DynamoDbModel;

class ContentMetadataModel extends DynamoDbModel
{
    protected $fillable = [
        'category_id',
        'name_uploader',
        'video_title',
        'video_description',
        'video_subtitle',
        'video_genre',
        'video_format',
        'video_size',
        'video_resolution',
        'video_duration',
        'video_viewers',
        'video_comments',
        'video_likes',
        'video_dislikes',
        'video_users_likes',
        'video_users_dislikes',
        'video_share',
        'video_saves',
        'video_downloads',
    ];

    protected $table = 'ContentMetadata';
}