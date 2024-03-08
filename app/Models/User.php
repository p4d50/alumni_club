<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ApprovalDocument;
use App\Enum\ApprovalStatus;
use App\Enum\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'approval_status',
        'approved_at',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'approval_status' => ApprovalStatus::class,
        'approved_at' => 'datetime',
        'role' => Role::class,
        'password' => 'hashed',
    ];

    /**
     * Check if user is admin
     *
     * @return bool
     */
    public function isAdmin(): bool {
        return $this->role === Role::Admin;
    }

    /**
     * Query all unapproved users
     * 
     * @param Illuminate\Database\Eloquent\Builder $query
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnapproved(Builder $query): Builder {
        return $query->where('approval_status', ApprovalStatus::Unapproved);
    }

    /**
     * User approval document
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function approvalDocuments(): HasOne {
        return $this->hasOne(ApprovalDocument::class);
    }
}
