<?php

namespace App\Http\Middleware;

use App\Models\LoginLogs;
use Closure;
use Illuminate\Http\Request;

class AutentikasiPekerja
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $loginLogs = LoginLogs::where('id_user', $request->session()->get('id_user'))
        ->where('token', $request->session()->get('token'))
        ->where('is_active', 1)
        ->first();

        if ($loginLogs) {
            $workerUser = in_array("Worker", session()->get('list_tipe_user'));
            $superUser = in_array('Super Admin', session()->get('list_tipe_user'));
            $managerUser = in_array('Manager', session()->get('list_tipe_user'));
            if ($workerUser || $superUser || $managerUser) {
                return $next($request);
            } else {
                return redirect()->back()->with('fail', 'Akses tidak diizinkan');
            }
        } else {
            return redirect()->back()->with('fail', 'Akses tidak diizinkan');
        }
    }
}
