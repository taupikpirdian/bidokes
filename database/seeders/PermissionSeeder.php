<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                "name" => "create_user",
            ],
            [
                "name" => "view_user",
            ],
            [
                "name" => "update_user",
            ],
            [
                "name" => "delete_user",
            ]
        ];

        foreach ($permissions as $permissionData) {
            Permission::updateOrCreate(
                ["name" => $permissionData["name"]],
                $permissionData
            );
        }
    }
}
