<?php

use yii\db\Migration;

/**
 * Handles the creation for table `notice_type_rel`.
 */
class m160523_073455_create_notice_type_rel extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('notice_type_rel', [
            'id' => $this->primaryKey(),
            'notice_id' => $this->integer()->notNull(),
            'notice_type_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-notice_type_rel-notice_id',
            'notice_type_rel',
            'notice_id',
            'notice',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-notice_type_rel-notice_type_id',
            'notice_type_rel',
            'notice_type_id',
            'notice_type',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-notice_type_rel-notice_id',
            'notice_type_rel'
        );

        $this->dropForeignKey(
            'fk-notice_type_rel-notice_type_id',
            'notice_type_rel'
        );

        $this->dropTable('notice_type_rel');
    }
}
