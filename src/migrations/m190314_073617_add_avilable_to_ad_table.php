<?php

use yii\db\Migration;

/**
 * Class m190314_073617_add_avilable_to_ad_table
 */
class m190314_073617_add_avilable_to_ad_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%ad}}', 'available_from', $this->integer()->comment('开始投放时间'));
        $this->addColumn('{{%ad}}', 'available_to', $this->integer()->comment('结束投放时间'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%ad}}', 'available_from');
        $this->dropColumn('{{%ad}}', 'available_to');
    }
}
