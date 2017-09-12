<?php


use Phinx\Seed\AbstractSeed;
use Carbon\Carbon;
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

        $faker = Faker\Factory::create('zh_CN');
        $admin = $this->table('dfshop_admin');
        $admin->truncate();
        $data = [];
        foreach (range(1, 10) as $index) {
            $data[] = [
                'user'     => $faker->email,
                'password' => md5('123456'),
                'group_id' => 0,
                'name'     => $faker->name,
                'lastlogotime'=>Carbon::now()->subDay(1)
            ];
        }

        $admin->insert($data)->save();

    }
}
