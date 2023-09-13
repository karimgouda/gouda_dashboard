<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {

        $this->truncateSpatieTables();
        
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        $config = Config::get('spatie_seeder.role_name');
        // create permissions
        foreach($config as $valus){
            Permission::create(['name' => $valus]);
        }
 

        // create roles and assign created permissions

        $role = Role::create(['name' => 'super_admin']);
        $role->givePermissionTo(Permission::all());
    }

    public function truncateSpatieTables()
    {
        $this->command->info('Truncating User, Role and Permission tables');
        Schema::disableForeignKeyConstraints();

      
        if (Config::get('spatie_seeder.role_name')) {
            DB::table('model_has_permissions')->truncate();
            DB::table('permissions')->truncate();
            DB::table('model_has_roles')->truncate();
            DB::table('role_has_permissions')->truncate();
            DB::table('roles')->truncate();
    
        }

        Schema::enableForeignKeyConstraints();
    }

}
