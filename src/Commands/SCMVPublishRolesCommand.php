<?php

namespace Rahat1994\SparkcommerceMultivendor\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'scmv:publish-roles')]
class SCMVPublishRolesCommand extends Command
{
    public $signature = 'scmv:publish-roles';

    public $description = 'Publish roles for Sparkcommerce Multivendor';

    public function handle()
    {
        $adminRole = config('sparkcommerce-multivendor.admin_role');
        $vendorOwnerRole = config('sparkcommerce-multivendor.vendor_owner_role');
        $vendorManagerRole = config('sparkcommerce-multivendor.vendor_manager_role');
        $customerRole = config('sparkcommerce-multivendor.customer_role');
    }

    protected function publishAdminPermissionAndRole()
    {
        $adminRole = config('sparkcommerce-multivendor.admin_role');
        $adminPermissions = config('sparkcommerce-multivendor.admin_permissions');

        collect($adminPermissions)->each(function ($permissionName, $permissionLabel) {
            Permission::firstOrCreate(['name' => $permissionName, 'label' => $permissionLabel]);
        });

        $role = Role::firstOrCreate(['name' => $adminRole]);
        $role->syncPermissions($adminPermissions);
    }
}
