<?php

namespace App\Http\Middleware;

use App\Models\LoginLogs;
use Closure;
use Illuminate\Http\Request;

class AutentikasiUserSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $loginLogs = LoginLogs::where('id_user', $request->session()->get('id_user'))
        ->where('token', $request->session()->get('token'))
        ->where('is_active', 1)
        ->first();
        if($loginLogs){
            $superUser = $loginLogs->user->tipeUser->nama_tipe == 'Super Admin';
            if($superUser){
                return $next($request);
            }else{
                return redirect()->back()->with('fail', "Anda tidak memiliki akses");
            }
        }else{
            return redirect()->route('login');
        }
    }
}
