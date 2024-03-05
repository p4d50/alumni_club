<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enum\ApprovalStatus;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->approval_status != ApprovalStatus::Unapproved) {
            if ($request->route()->uri == 'not-approved') {
                return redirect()->route('home');
            } else {
                return $next($request);
            }
        } else {
            return redirect()->route('not-approved');
        }
    }
}
