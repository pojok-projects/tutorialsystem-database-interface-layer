<?php

namespace App\Models;

use BaoPham\DynamoDb\DynamoDbModel;

class ContentMetadataVideoModel extends DynamoDbModel
{
    protected $fillable = [
        'metadata_id',
        'size',
        'format',
        'resolution',
        'duration',
    ];

    protected $table = 'ContentMetadataVideo';
}