<?php

use yii\db\Migration;

/**
 * Handles adding data to table `user`.
 */
class m160523_095737_add_data_to_user extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $rows = [
            [1, 'admin@test.ru', '21232f297a57a5a743894a0e4a801fc3', 'admin_key', 'admin_token', 1],
            [2, 'demo@test.ru', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo_key', 'demo_token', 2],
        ];
        $this->batchInsert('user', ['id', 'username', 'password', 'auth_key', 'access_token', 'role_id'], $rows);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->delete('user');
    }
}
