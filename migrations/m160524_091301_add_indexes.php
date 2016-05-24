<?php

use yii\db\Migration;

class m160524_091301_add_indexes extends Migration
{
    public function up()
    {
        $this->createIndex(
            'idx-notice-code',
            'notice',
            'code'
        );
    }

    public function down()
    {
        $this->dropIndex(
            'idx-notice-code',
            'notice'
        );
    }
}
