<?php

use Illuminate\Database\Migrations\Migration;

class ContentCategoryTable extends Migration
{
    private $client;
    private $config = [];

    public function __construct()
    {
        if(env('DYNAMODB_LOCAL')) {
            $this->config['endpoint'] = env('DYNAMODB_LOCAL_ENDPOINT');
        }
        $this->client = App::make('aws')->createClient('dynamodb', $this->config);
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $schema = [
            "AttributeDefinitions" => [
                [
                    "AttributeName" => "id", 
                    "AttributeType" => "S"
                ]
            ], 
            "TableName" => "ContentCategoryTable", 
            "KeySchema" => [
                [
                    "AttributeName" => "id", 
                    "KeyType" => "HASH"
                ]
            ],
            "ProvisionedThroughput" => [
                "ReadCapacityUnits" => 1, 
                "WriteCapacityUnits" => 1
            ],
            "StreamSpecification" => [
                "StreamEnabled" => true,
                "StreamViewType" => "NEW_AND_OLD_IMAGES"
            ],
            "Tags" => [
                [ "Key" => "AWSTagKey", "Value" => "SomeCustomValue" ],
            ]
        ];

        $table = $this->client->createTable($schema);

        if(!empty($schema['Tags'])) {
            sleep(5); sleep(5); // wait 5s, table may not have been created yet
            $description = $table->get('TableDescription');
            if(!empty($description['TableArn'])) {
                $tags = array_merge([], config('aws.tags', null), $schema['Tags']);
                if($tags !== null) {
                    $errors = 0;
                    while($errors < 3) {
                        try {
                            $tagged = $this->client->tagResource([
                                'ResourceArn' => $description['TableArn'],
                                "Tags" => $tags
                            ]);
                            break;
                        } catch(Exception $e) {
                            echo "EXCEPTION: " . $e->getMessage();
                            $errors++;
                            sleep(5); // wait 5s, table may not have been created yet
                        }
                    }
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->client->deleteTable([
            "TableName" => "ContentCategoryTable",
        ]);
    }
}