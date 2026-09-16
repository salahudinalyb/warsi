<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureWorkspaceRole
{
    /**
     * Gate the Ruang Kerja (Operator/Admin workspace) behind the simulated
     * session role. Real auth/login is still an open PRD question (Bagian 7).
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! in_array(session('role', 'publik'), ['operator', 'admin'], true)) {
            return response()->view('pages.workspace.gate', [], 403);
        }

        return $next($request);
    }
}
