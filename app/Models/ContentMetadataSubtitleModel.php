<?php

namespace App\Models;

use BaoPham\DynamoDb\DynamoDbModel;

class ContentMetadataSubtitleModel extends DynamoDbModel
{
    protected $fillable = [
        'metadata_id',
        'subtitle_id',
        'file_path',
    ];

    protected $table = 'ContentMetadataSubtitle';
}