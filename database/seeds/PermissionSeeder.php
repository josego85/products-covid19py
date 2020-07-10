<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Permission\Role;
use App\Models\Permission\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return voids
     */
    public function run()
    {
        // Truncate tables.
        DB::statement("SET foreign_key_checks=0");
            DB::table('role_user')->truncate();
            DB::table('permission_role')->truncate();
            Permission::truncate();
            Role::truncate();
        DB::statement("SET foreign_key_checks=1");

        // User admin.
        $userAdmin = User::where('email', 'admin@admin.com')->first();
        if ($userAdmin)
        {
            $userAdmin->delete();
        }
        $userAdmin = User::create([
            'name'      => 'admin',
            'email'     => 'admin@admin.com',
            'password'  => Hash::make('admin')
        ]);
        
        // Role admin.
        $roleAdmin = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Administrator',
            'full-access' => 'yes',
        ]);
        
        // Table role_user.
        $userAdmin->roles()->sync([$roleAdmin->id]);

        // Permission.
        $permission_all = [];

        // Permission role.
        $permission = Permission::create([
            'name' => 'Listar roles',
            'slug' => 'role.index',
            'description' => 'Un usuario puede listar los roles.',
        ]);

        $permission_all[] = $permission->id;

        // Permission role.
        $permission = Permission::create([
            'name' => 'Mostrar rol',
            'slug' => 'role.show',
            'description' => 'Un usuario puede mostrar un rol.',
        ]);

        $permission_all[] = $permission->id;

        // Permission role.
        $permission = Permission::create([
            'name' => 'Crear rol',
            'slug' => 'role.create',
            'description' => 'Un usuario puede crear un rol.',
        ]);

        $permission_all[] = $permission->id;

        // Permission role.
        $permission = Permission::create([
            'name' => 'Editar rol',
            'slug' => 'role.edit',
            'description' => 'Un usuario puede editar un rol.',
        ]);

        $permission_all[] = $permission->id;

        // Permission role.
        $permission = Permission::create([
            'name' => 'Eliminar rol',
            'slug' => 'role.destroy',
            'description' => 'Un usuario puede eliminar un rol.',
        ]);

        $permission_all[] = $permission->id;

        // Permission user.
        $permission = Permission::create([
            'name' => 'Listar usuarios',
            'slug' => 'user.index',
            'description' => 'Un usuario puede listar los usuarios.',
        ]);

        $permission_all[] = $permission->id;

        // Permission user.
        $permission = Permission::create([
            'name' => 'Mostrar usuario',
            'slug' => 'user.show',
            'description' => 'Un usuario puede mostrar un usuario.',
        ]);

        $permission_all[] = $permission->id;

        // Permission user.
        $permission = Permission::create([
            'name' => 'Editar usuario',
            'slug' => 'user.edit',
            'description' => 'Un usuario puede editar un rol.',
        ]);

        $permission_all[] = $permission->id;

        // Permission user.
        $permission = Permission::create([
            'name' => 'Eliminar usuario',
            'slug' => 'user.destroy',
            'description' => 'Un usuario puede eliminar un rol.',
        ]);

        $permission_all[] = $permission->id;

        // Permission user.
        $permission = Permission::create([
            'name' => 'Crear usuario',
            'slug' => 'user.create',
            'description' => 'Un usuario puede crear un usuario.',
        ]);

        $permission_all[] = $permission->id;

        // Table permission_role.
        $roleAdmin->permissions()->sync($permission_all);
    }
}