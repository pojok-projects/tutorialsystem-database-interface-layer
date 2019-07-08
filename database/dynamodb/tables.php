<?php

return [
    [
        'TableName'             => 'ContentMetadata',
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
    ],
    [
        'TableName'             => 'ContentCategory',
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
    ],
    [
        'TableName'             => 'ContentComment',
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
    ],


];