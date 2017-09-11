<?php


use Phinx\Seed\AbstractSeed;

class AdminSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $admin = $this->table('dfshop_admin');
        $data = [];
        foreach (range(1, 10) as $index) {
            $data[] = [
                'user'     => 'user' . $index,
                'password' => md5('123456'),
                'group_id' => 0,
                'name'     => 'name' . $index,
            ];
        }

        $admin->insert($data)->save();

    }
}
