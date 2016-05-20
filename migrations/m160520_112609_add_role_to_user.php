<?php

use yii\db\Migration;

/**
 * Handles adding role to table `user`.
 */
class m160520_112609_add_role_to_user extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'role_id', $this->integer()->notNull());

        $this->addForeignKey(
            'fk-user-role_id',
            'user',
            'role_id',
            'role',
            'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-user-role_id',
            'user'
        );

        $this->dropColumn('user', 'role_id');
    }
}
