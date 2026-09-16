<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class RoleController extends Controller
{
    /**
     * Role switching is a stand-in until real auth/login is decided
     * (still an open question in the PRD — see Bagian 7).
     */
    public const ROLES = ['publik', 'operator', 'admin'];

    public function switch(string $role): RedirectResponse
    {
        if (in_array($role, self::ROLES, true)) {
            session(['role' => $role]);
        }

        return redirect()->back();
    }
}
