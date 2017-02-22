<?php

use yii\db\Migration;

/**
 * Handles the creation of table `notice`.
 */
class m170220_185603_create_notice_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('notice', [
            'id' => $this->primaryKey(),
            'oncreate' => $this->integer()->notNull(),
            'message' => $this->text()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('notice');
    }
}
