<?php


    use Phinx\Migration\AbstractMigration;
    use Phinx\Db\Adapter\MysqlAdapter;

    class CreateAdminTable extends AbstractMigration
    {
        /**
         * Change Method.
         *
         * Write your reversible migrations using this method.
         *
         * More information on writing migrations is available here:
         * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
         *
         * The following commands can be used in this method and Phinx will
         * automatically reverse them when rolling back:
         *
         *    createTable
         *    renameTable
         *    addColumn
         *    renameColumn
         *    addIndex
         *    addForeignKey
         *
         * Remember to call "create()" or "update()" and NOT "save()" when working
         * with the Table class.
         */
        public function change()
        {
            $table = $this->table('dfshop_admin', ['engine' => 'MyISAM', 'comment' => '管理员表
        ']);
            $table->addColumn('user', 'string', array(
                        'limit'   => MysqlAdapter::PHINX_TYPE_CHAR,
                        'length'  => 30,
                        'comment' => '账号',
                        'null'    => FALSE))
                ->addColumn('password', 'string', array(
                        'limit'   => 35,
                        'comment' => '密码'))
                ->addColumn('group_id', 'integer', array(
                        'limit'   => MysqlAdapter::INT_SMALL,
                        'length'  => 5,
                        'comment' => '会员组',
                        'null'    => FALSE))
                ->addColumn('name', 'string', array(
                        'limit'   => 60,
                        'comment' => '用户名',
                        'default' => NULL))
                ->addColumn('desc', 'text', array(
                        'comment' => '描述'))
                ->addColumn('lastlogotime', 'datetime', array(
                        'comment' => '最后登录时间',
                        'default' => NULL))
                ->addColumn('logoip', 'string', array(
                        'limit'   => 30,
                        'comment' => '最后登录ip'))
                ->addColumn('type', 'integer', array(
                        'length'  => 1,
                        'comment' => '',
                        'signed'  => FALSE,
                        'limit'   => MysqlAdapter::INT_SMALL))
                ->addColumn('lang', 'string', array(
                        'limit' => 10,
                        'comment' => '语言',
                        'default' => NULL))
                ->addColumn('status', 'integer', array(
                        'limit' => MysqlAdapter::INT_TINY,
                        'length' => 1,
                        'comment' => '状态,默认开启',
                        'null' => FALSE))
                //->addIndex(array('id'),array('unique'))
                ->addIndex(array('status'))
                ->addIndex(array('user'))
                ->addIndex(array('group_id'))
                ->create();
        }
    }
