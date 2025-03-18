<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class SwitchRoleController extends Controller
{
    public function __invoke(Role $role)
    {
        abort_unless(auth()->user()->hasRole($role), 404);

        auth()->user()->update(['current_role_id' => $role->id]);

        return to_route('dashboard')->with('toast_success', 'Kamu Berhasil Switch'); // Replace this with your own home route
    }
}
