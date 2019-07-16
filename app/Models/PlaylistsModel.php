<?php

namespace App\Models;

use BaoPham\DynamoDb\DynamoDbModel;

class PlaylistsModel extends DynamoDbModel
{
    protected $fillable = [
        'user_id',
        'playlistcategory_id',
        'metadata_id',
        'order_list',
        'last_watch'
    ];

    protected $table = 'Playlists';
}