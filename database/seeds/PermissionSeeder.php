<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //TODO: for now we are only defining Users, Referrals and Comments but further should add seeder for new permissions
        DB::table('permissions')->insert([
            'name' => encrypt('Create User'),
            'slug' => encrypt('create-user'),
            'description' => encrypt('Permission to create user(single)')
        ]);

        DB::table('permissions')->insert([
            'name' => encrypt('View User'),
            'slug' => encrypt('view-user'),
            'description' => encrypt('Permission to view user includes index and single record')
        ]);

        DB::table('permissions')->insert([
            'name' => encrypt('Update User'),
            'slug' => encrypt('update-user'),
            'description' => encrypt('Permission to update user(single)')
        ]);

        DB::table('permissions')->insert([
            'name' => encrypt('Delete User'),
            'slug' => encrypt('delete-user'),
            'description' => encrypt('Permission to delete user(single)')
        ]);

        DB::table('permissions')->insert([
            'name' => encrypt('Create Referral'),
            'slug' => encrypt('create-referral'),
            'description' => encrypt('Permission to create referral(single)')
        ]);

        DB::table('permissions')->insert([
            'name' => encrypt('Create Bulk Referral'),
            'slug' => encrypt('create-bulk-referral'),
            'description' => encrypt('Permission to create referral(bulk)')
        ]);

        DB::table('permissions')->insert([
            'name' => encrypt('View Referral'),
            'slug' => encrypt('view-referral'),
            'description' => encrypt('Permission to view referral includes index and single record')
        ]);

        DB::table('permissions')->insert([
            'name' => encrypt('Update Referral'),
            'slug' => encrypt('update-referral'),
            'description' => encrypt('Permission to update referral(single)')
        ]);

        DB::table('permissions')->insert([
            'name' => encrypt('Delete Referral'),
            'slug' => encrypt('delete-referral'),
            'description' => encrypt('Permission to delete referral(single)')
        ]);

        DB::table('permissions')->insert([
            'name' => encrypt('Create Comment'),
            'slug' => encrypt('create-comment'),
            'description' => encrypt('Permission to create comment(single)')
        ]);
    }
}
