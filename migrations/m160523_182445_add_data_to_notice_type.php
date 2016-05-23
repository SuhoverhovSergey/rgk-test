<?php

use yii\db\Migration;

/**
 * Handles adding data to table `notice_type`.
 */
class m160523_182445_add_data_to_notice_type extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $rows = [
            [1, 'email'],
            [2, 'browser'],
        ];
        $this->batchInsert('notice_type', ['id', 'name'], $rows);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->delete('notice_type');
    }
}
