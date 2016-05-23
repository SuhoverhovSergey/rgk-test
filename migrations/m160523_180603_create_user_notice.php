<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user_notice`.
 */
class m160523_180603_create_user_notice extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_notice', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'text' => $this->text()->notNull(),
            'from_user_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'fk-user_notice-from_user_id',
            'user_notice',
            'from_user_id',
            'user',
            'id'
        );

        $this->addForeignKey(
            'fk-user_notice-user_id',
            'user_notice',
            'user_id',
            'user',
            'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-user_notice-from_user_id',
            'user_notice'
        );

        $this->dropForeignKey(
            'fk-user_notice-user_id',
            'user_notice'
        );

        $this->dropTable('user_notice');
    }
}
