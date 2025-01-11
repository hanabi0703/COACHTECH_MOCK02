<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // adminユーザーを作成
        $adminUser = new User();
        $adminUser->name = '管理者';
        $adminUser->email = 'aaa@bbb.com';
        $adminUser->password = Hash::make('password');
        $adminUser->save();

        // editorユーザーを作成
        $editorUser = new User();
        $editorUser->name = '一般ユーザー';
        $editorUser->email = 'bbb@bbb.com';
        $editorUser->password = Hash::make('password');
        $editorUser->save();

        // Roleの作成
        $admin = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);

        // Permissionの作成
        // $permissionOfEditArticles = Permission::create(['name' => 'edit articles']);
        // $permissionOfDeleteArticles = Permission::create(['name' => 'delete articles']);

        // RoleとPermissionを関連付け
        // $admin->givePermissionTo($permissionOfEditArticles);
        // $admin->givePermissionTo($permissionOfDeleteArticles);
        // $editor->givePermissionTo($permissionOfEditArticles);

        // UserにRoleを割り当て
        $adminUser->assignRole('admin');
        $editorUser->assignRole('editor');
    }
}
