
<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // User.
        $this->createTable('{{%User}}', [
            'Id'       => $this->primaryKey(),
            'Email'    => $this->string()->notNull()->unique(),
            'AuthKey'  => $this->string(32)->notNull(),
            'Password' => $this->string()->notNull(),
            'Role'     => $this->smallInteger()->notNull(),
            'Status'   => $this->boolean()->notNull()->defaultValue(1),
        ], $tableOptions);

        $this->batchInsert('{{%User}}', ['Email', 'AuthKey', 'Password', 'Role', 'Status'], [
            ['tester@email.com', 'PT_k_eFehYfB4yj0eFhPAPs6OJ2vo3Nf', '$2y$13$1fq6tfrWUv.FkDGmF.aYfeQL0af3LWF0eUloNKEgyc6vP/wZtQ1Ke', 10, 1],
            ['liza@email.com', '1FpOE6-uU21dOMxkQDhGm5taKSowBk1o', '$2y$13$iclfioxo18Yz.WoCAlrjrODPa7e/0muHeggMjFp6TEPQlprfgiIKC', 5, 1],
            ['john@email.com', 'UolN9AvY0W95u328QV9nfs_hRgH_pLsX', '$2y$13$XF1biIOzOJptDfWUdTlLa.koSSHY5lAvj5C8cWkhQhhzMFp/8.3bq', 5, 1],
            ['karl@email.com', 'HUQJEVqvxc9BJNgxmZm8uZPlyu9e49wY', '$2y$13$HAUMqrOvqOzKR6zR.a.eJe3fzI8a2QfVX3tFWQemqnsGrpWUx1ute', 5, 1],
            ['izya@email.com', 'tjicvarEIEglQrhZrACHCFQSODbuhI_X', '$2y$13$UY5fd3MLLQzMNujqhWxJ2eLHc9LyI4ddiPYuVPs7dje0VA9CuV3uu', 5, 0],
        ]);

        // Goods.
        $this->createTable('{{%Goods}}', [
            'Id'   => $this->primaryKey(),
            'Name' => $this->string()->notNull(),
        ], $tableOptions);

        $this->batchInsert('{{%Goods}}', ['Name'], [
            ['Яблоки'],
            ['Апельсины'],
            ['Мандарины'],
        ]);

        // Order.
        $this->createTable('{{%Order}}', [
            'Id'         => $this->primaryKey(),
            'ClientName' => $this->string()->notNull(),
            'Name'       => $this->string(),
            'GoodsId'    => $this->integer()->notNull(),
            'Phone'      => $this->string(),
            'CreatedAt'  => $this->integer()->notNull(),
            'Status'     => $this->char(1),
            'Comment'    => $this->text(),
            'Price'      => $this->double(),
        ], $tableOptions);
        $this->addForeignKey('fkOrderGoodsId', 'Order', 'GoodsId', 'Goods', 'Id', 'CASCADE');

        // HistoryAction.
        $this->createTable('{{%OrderHistory}}', [
            'Id'        => $this->primaryKey(),
            'UserId'    => $this->integer()->notNull(),
            'OrderId'   => $this->integer()->notNull(),
            'Previous'  => $this->text(),
            'Current'   => $this->text(),
            'CreatedAt' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('fkOrderHistoryUserId', 'OrderHistory', 'UserId', 'User', 'Id', 'CASCADE');
        $this->addForeignKey('fkOrderHistoryOrderId', 'OrderHistory', 'OrderId', 'Order', 'Id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fkOrderGoodsId', 'Order');
        $this->dropForeignKey('fkOrderHistoryUserId', 'OrderHistory');
        $this->dropForeignKey('fkOrderHistoryOrderId', 'OrderHistory');
        $this->dropTable('{{%User}}');
        $this->dropTable('{{%Goods}}');
        $this->dropTable('{{%Order}}');
        $this->dropTable('{{%OrderHistory}}');
    }


}
