<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()["cache"]->forget("spatie.permission.cache");
        // Role Default
        $admin = Role::where("name", "admin")
            ->where("guard_name", "web")
            ->first();

        if (!$admin) {
            Role::create([
                "name" => "admin",
                "guard_name" => "web",
            ]);
        }

        // add role polda, polres and polsek
        $polda = Role::where("name", "polda")
            ->where("guard_name", "web")
            ->first();

        if (!$polda) {
            Role::create([
                "name" => "polda",
                "guard_name" => "web",
            ]);
        }

        $polres = Role::where("name", "polres")
            ->where("guard_name", "web")
            ->first();

        if (!$polres) {
            Role::create([
                "name" => "polres",
                "guard_name" => "web",
            ]);
        }

        $polsek = Role::where("name", "polsek")
            ->where("guard_name", "web")
            ->first();

        if (!$polsek) {
            Role::create([
                "name" => "polsek",
                "guard_name" => "web",
            ]);
        }
    }
}