<?php

/**
 * Create Admin Seeder Application
 * PHP version ^7.3|^8.0
 *
 * @category THP_Ecommerce
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Class UsersTableSeeder
 * PHP version ^7.3|^8.0
 *
 * @category User_Seeder
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            [
                'email' => 'admin@gmail.com'
            ],
            [
                'name' => 'Super Admin',
                'username' => 'admin',
                'password' => Hash::make('sysadmin'),
                'type' => 0,
                'is_active' => 1
            ]
        );
    }
}
