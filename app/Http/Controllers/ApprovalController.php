<?php

namespace App\Http\Controllers;

use App\Exceptions\UserAlreadyApproved;
use App\Services\ApproveUserService;
use Illuminate\Http\Request;
use App\Models\User;

class ApprovalController extends Controller
{
    public function dashboard()
    {
        $unapproved = User::unapproved()->get();

        return view('approvals', compact('unapproved'));
    }

    public function each(User $user)
    {
        // TODO: Redirect if user is already approved.
        // Do checking first

        return view('each-approval', compact('user'));
    }

    public function approveUser(User $user, ApproveUserService $service)
    {
        try {
            $service($user);
            return redirect()
                ->route('dashboard.approvals')
                ->with('success', 'User is successfully approved!');
        } catch (UserAlreadyApproved) {
            return redirect()
                ->route('dashboard.approvals')
                ->with('error', 'User is already approved by administrator!');
        }
    }
}
