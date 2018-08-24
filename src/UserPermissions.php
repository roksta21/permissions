<?php

namespace Roksta\Permit;

use Illuminate\Http\Request;
use Auth;
use DB;

trait UserPermissions
{
    public function index()
    {
    	$users = config('auth.providers')['users']['model']::get(['id', 'name']);

    	return view('vendor.roksta.permissions.users.index')->withUsers($users);
    }

    public function show($id)
    {
    	$user = config('auth.providers')['users']['model']::findOrFail($id);

    	return view('vendor.roksta.permissions.users.show')->withUser($user);
    }

    public function edit($id)
    {
    	$user = config('auth.providers')['users']['model']::findOrFail($id);
    	$permissions = DB::table('all_permissions')->get();

    	return view('vendor.roksta.permissions.users.edit')->withUser($user)
    		->withPermissions($permissions);
    }

    public function update(Request $request, $id)
    {
    	$user = config('auth.providers')['users']['model']::findOrFail($id);

    	$request->validate([
    		'permissions' => 'required'
    	]);

    	$user->userPermissions()->update([
    		'permissions' => json_encode($request->permissions)
    	]);

    	return redirect()->route(config('permissions.route_name_prefix').'permissions.users.show', $id);
    }
}
