<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Commands\CreateRole;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createRoles();
        $this->createAdminUser();
        $this->assignAdminRole();
    }

    public function createAdminUser()
    {
        // Crear el usuario administrador
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }

    public function createRoles()
    {
        // Crear roles
        $adminRole = Role::create(['name' => 'admin']);
        $staffRole = Role::create(['name' => 'staff']);
        $userRole = Role::create(['name' => 'user']);

        // Crear permisos si es necesario
        // $createPostPermission = Permission::create(['name' => 'create post', 'description' => 'Create new post']);

        // Asignar permisos a roles si es necesario
        // $adminRole->givePermissionTo($createPostPermission);
    }

    public function assignAdminRole()
    {
        // Asignar roles a usuarios
        // Asigna el rol "admin" al usuario con nombre "laloquera" (reemplaza 'laloquera' por el nombre real del usuario)
        // Obtener el usuario al que deseas asignar el rol
        $user = User::find(5); // Reemplaza '1' por el identificador del usuario que desees

        // Obtener el rol que deseas asignar al usuario
        $role = Role::findByName('admin'); // Reemplaza 'admin' por el nombre del rol que desees

        // Asignar el rol al usuario
        $user->assignRole($role);
    }
}
