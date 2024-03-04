<?php

namespace App\Enum;

enum ApprovalStatus: string {
    case Approved = 'approved';
    case Unapproved = 'unapproved';
}
