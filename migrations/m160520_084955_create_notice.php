<?php

use yii\db\Migration;

/**
 * Handles the creation for table `notice`.
 */
class m160520_084955_create_notice extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('notice', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'code' => $this->string(255)->notNull(),
            'from_user_id' => $this->integer()->notNull(),
            'to_user_id' => $this->integer(),
            'title' => $this->string(255)->notNull(),
            'text' => $this->text(),
            'created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'fk-notice-from_user_id',
            'notice',
            'from_user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-notice-to_user_id',
            'notice',
            'to_user_id',
            'user',
            'id',
            'SET NULL'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-notice-from_user_id',
            'notice'
        );

        $this->dropForeignKey(
            'fk-notice-to_user_id',
            'notice'
        );

        $this->dropTable('notice');
    }
}
