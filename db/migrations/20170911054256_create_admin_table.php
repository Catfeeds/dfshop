<?php


use Phinx\Migration\AbstractMigration;

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
        $table=$this->table('dfshop_admin');
        $table->addColumn('user','string',array('limit'=>30))
            ->addColumn('password','string',array('limit'=>35))
            ->addColumn('group_id','integer',array('limit'=>5))
            ->addColumn('name','string',array('limit'=>60))
            ->addColumn('desc','text')
            ->addColumn('xxx','text')
            ->addColumn('lastlogotime','datetime')
            ->addColumn('logoip','string',array('limit'=>30))
            ->addColumn('type','integer',array('limit'=>1))
            ->addColumn('lang','string',array('limit'=>10))
            ->addColumn('status','integer',array('limit'=>1))
            //->addIndex(array('id'),array('unique'))
            ->addIndex(array('status'))
            ->addIndex(array('user'))
            ->addIndex(array('group_id'))
            ->create();
    }
}
