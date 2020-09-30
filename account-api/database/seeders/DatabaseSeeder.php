<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $app = [
            'app_code' => 'toadwart',
            'app_name' => 'Toad Wart',
            'app_descr' => $faker->paragraph,
        ];
        $appRoles =
            [
                [
                    'role_code' => 'admin',
                    'role_name' => 'Administrator'
                ],
                [
                    'role_code' => 'staff',
                    'role_name' => 'Staff'
                ],

            ];
        $users = [
            [
                'email' => 'admin@tpt.com',
                'password' => 'password',
                'role_code' => 'admin',
            ],
            [
                'email' => 'staff@tpt.com',
                'password' => 'password',
                'role_code' => 'staff',
            ]
        ];
        $this->addToTable('apps', $app);
        $appId = DB::select('select id from apps where app_code=?', ['toadwart'])[0]->id;
        foreach ($appRoles as $appRole) {
            $appRole['app_id'] = $appId;
            $this->addToTable('app_roles', $appRole);
        }
        foreach ($users as $user) {

            $roleCode = $user['role_code'];
            unset($user['role_code']);
            $roleId = DB::select('select id from app_roles where app_id = ? and role_code = ?', [$appId, $roleCode])[0]->id;

            $this->addToTable('users', $user);
            $userId = DB::select('select id from users where email = ?', [$user['email']])[0]->id;
            $person = $this->buildFakePerson($faker);
            $person['user_id'] = $userId;
            $this->addToTable('persons', $person);
            $data = [
                'user_id' => $userId,
                'app_id' => $appId
            ];
            $this->addToTable('user_apps', $data);

            $data['app_role_id'] = $roleId;
            $this->addToTable('user_app_roles', $data);

        }
    }

    private function addToTable($table, $data)
    {

        $sql = "insert into {$table} (" .
            implode(',', array_keys($data))
            . ") values (" .
            implode(',',
                array_fill(0,
                    count(array_values($data)),
                    '?')
            )
            . ")";
        DB::insert($sql, array_values($data));
    }

    private function buildFakePerson($faker)
    {

        return [
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'address1' => $faker->address,
            'address2' => '',
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'phone' => $faker->phoneNumber,
        ];
    }
}
