<?php

/**
 * Name of Table For DynamoDB
 */
$table_name = [
    'ContentCategory',
    'ContentMetadata',
    'ContentSubtitle',
    'PlaylistCategory',
    'User',
];

/**
 * Variable to Save All Array
 */
$result = [];

/**
 * Build Table to Array
 * 
 * @return array
 */
foreach($table_name as $table) {
    $result[] = [
        'TableName'             => $table,
        'AttributeDefinitions'  => [
            [
                'AttributeName' => 'id',
                'AttributeType' => 'S',
            ],
        ],
        'KeySchema'             => [
            [
                'AttributeName' => 'id',
                'KeyType'       => 'HASH',
            ],
        ],
        'ProvisionedThroughput' => [
            'ReadCapacityUnits'  => 10,
            'WriteCapacityUnits' => 20,
            'OnDemand'           => false,
        ],        
    ];
}

/**
 * Return a array
 */
return $result;