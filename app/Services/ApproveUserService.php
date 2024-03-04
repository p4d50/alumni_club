<?php

namespace App\Services;

use App\Exceptions\UserAlreadyApproved;
use App\Enum\ApprovalStatus;
use App\Models\User;

class ApproveUserService
{
    public function __invoke(User $user): void
    {
        if ($user->approval_status == ApprovalStatus::Approved && $user->appoved_at == null) {
            throw new UserAlreadyApproved;
        }

        $user->update([
            'approval_status' => ApprovalStatus::Approved,
            'approved_at' => now()
        ]);
    }
}
