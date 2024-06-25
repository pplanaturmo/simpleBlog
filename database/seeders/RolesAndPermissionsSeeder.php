<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Define permissions
        $createCommentsPermission = Permission::create(['name' => 'create comments']);
        $editOwnCommentsPermission = Permission::create(['name' => 'edit own comments']);
        $createPostsPermission = Permission::create(['name' => 'create posts']);
        $editOwnPostsPermission = Permission::create(['name' => 'edit own posts']);
        $editAnyPostPermission = Permission::create(['name' => 'edit any post']);
        $deleteAnyCommentPermission = Permission::create(['name' => 'delete any comment']);

        // Define roles
        $subscriberRole = Role::create(['name' => 'subscriber']);
        $subscriberRole->givePermissionTo($createCommentsPermission, $editOwnCommentsPermission);

        $writerRole = Role::create(['name' => 'writer']);
        $writerRole->givePermissionTo($createPostsPermission, $editOwnPostsPermission);
        $writerRole->syncPermissions($subscriberRole->permissions);

        $editorRole = Role::create(['name' => 'editor']);
        $editorRole->givePermissionTo($editAnyPostPermission, $deleteAnyCommentPermission);
        $editorRole->syncPermissions($writerRole->permissions);

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->syncPermissions(Permission::all());
    }
}
