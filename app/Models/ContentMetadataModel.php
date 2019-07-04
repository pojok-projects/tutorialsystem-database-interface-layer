<?php

namespace App\Models;

use BaoPham\DynamoDb\DynamoDbModel;

class ContentMetadataModel extends DynamoDbModel
{
    protected $fillable = ['title', 'year'];

    protected $table = 'ContentMetadata';
}