<?php

namespace App\Console\Commands;

use BaoPham\DynamoDb\DynamoDbClientService;
use Illuminate\Console\Command;

class CreateTables extends Command
{
    protected $signature = 'dynamodb:create-tables';

    protected $description = 'DynamoDB Create Tables';

    public function handle(DynamoDbClientService $dynamoService)
    {
        $dynamodb = $dynamoService->getClient();

        $schema = (require __DIR__ . '/../../database/dynamodb/tables.php');

        foreach ($schema as $tableSchema) {
            $table = $dynamodb->createTable($tableSchema);
        }

        echo "Created tables";
    }
}
