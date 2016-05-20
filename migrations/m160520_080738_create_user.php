<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user`.
 */
class m160520_080738_create_user extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull()->unique(),
            'password' => $this->string(255)->notNull(),
            'auth_key' => $this->string(255)->notNull(),
            'access_token' => $this->string(255)->notNull(),
            'created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'active' => $this->boolean()->notNull()->defaultValue(true),
            'deleted' => $this->boolean()->notNull()->defaultValue(false),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
