<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
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

    public function submit(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'file' => 'required|mimes:jpg,png,pdf|max:2048',
        ]);

        $filename = time().'_'.$request->file->getClientOriginalName();
        Storage::disk('public')->put('/documents/' . $filename, file_get_contents($request->file));

        $currentUser = auth()->user();

        $currentUser->approvalDocument()->create([
            'type' => $request->type,
            'path_to_document' => "/documents/$filename",
        ]);

        return redirect()->back();
    }
}
