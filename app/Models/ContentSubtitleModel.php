<?php

namespace App\Models;

use BaoPham\DynamoDb\DynamoDbModel;

class ContentSubtitleModel extends DynamoDbModel
{
    protected $fillable = [
        'name',
        'description',
    ];

    protected $table = 'ContentMetadataVideo';
}