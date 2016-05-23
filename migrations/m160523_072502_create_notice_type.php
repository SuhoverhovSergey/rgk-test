<?php

use yii\db\Migration;

/**
 * Handles the creation for table `notice_type`.
 */
class m160523_072502_create_notice_type extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('notice_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('notice_type');
    }
}
