<?php

use yii\db\Migration;

/**
 * Handles adding data to table `role`.
 */
class m160520_112609_add_data_to_role extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $rows = [
            [1, 'Администратор'],
            [2, 'Пользователь'],
        ];
        $this->batchInsert('role', ['id', 'name'], $rows);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->delete('role');
    }
}
