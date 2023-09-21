<?php

namespace App\Services;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class PermissionService
{

	// getUserPermissions
	public function getUserPermissions($user_id)
	{
		$permissions = Permission::select('name')->join('model_has_permissions', 'permissions.id', '=', 'model_has_permissions.permission_id')->where('model_has_permissions.model_id', $user_id)->get();
		$permissions = collect($permissions)->map(function ($permission) {
			return $permission->name;
		});
		return $permissions;
	}
}
