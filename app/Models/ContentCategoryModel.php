<?php

namespace App\Models;

use BaoPham\DynamoDb\DynamoDbModel;

class ContentCategoryModel extends DynamoDbModel
{
    protected $fillable = ['name', 'description'];

    protected $table = 'ContentCategory';
}