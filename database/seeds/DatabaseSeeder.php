<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => "admin@adnlist.com",
            'email_verified_at' => date("Y-m-d H-i-s"),
            'password' => Hash::make("admin1234"),
            'role' => "3",
            'fname' => "Admin",
            'lname' => "Admin",
            'status' => "1",
            'created_at' => date("Y-m-d H-i-s"),
            'updated_at' => date("Y-m-d H-i-s")
        ]);
        DB::table('site_statuses')->insert([
            'visitor' => "0",
            'Jan' => "0",
            'Feb' => "0",
            'Mar' => "0",
            'Apr' => "0",
            'May' => "0",
            'Jun' => "0",
            'Jul' => "0",
            'Aug' => "0",
            'Sep' => "0",
            'Oct' => "0",
            'Nov' => "0",
            'Dec' => "0",
            'created_at' => date("Y-m-d H-i-s"),
            'updated_at' => date("Y-m-d H-i-s")
        ]);   
        DB::table('contacts')->insert([
            'general' => "info@adnlist.com",
            'support' => "support@adnlist.com",
            'scam' => "scam@adnlist.com",
            'report' => "report@adnlist.com",
            'global' => "global@adnlist.com",
            'tel' => "+1 (858)333-4222",
            'address' => "3400 Cottage Way, Ste G2 #1148, Sacramento, CA 95825.','2019-08-01 10:48:08','2019-08-03 14:28:35",            
            'created_at' => date("Y-m-d H-i-s"),
            'updated_at' => date("Y-m-d H-i-s")
        ]);               
    }
}
