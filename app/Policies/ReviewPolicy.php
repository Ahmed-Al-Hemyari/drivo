<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReviewPolicy
{
    const PermissionName = Review::class;
    public function viewAny(User $user): bool
    {
        return $user->hasPermission("ViewAny", self::PermissionName);
    }

    public function view(User $user, Review $review): bool
    {
        return $user->hasPermission("View", self::PermissionName);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission("Create", self::PermissionName);
    }

    public function replicate(User $user): bool
    {
        return $user->hasPermission("Replicate", self::PermissionName);
    }

    public function update(User $user, Review $review): bool
    {
        return $user->hasPermission("Update", self::PermissionName);
    }

    public function delete(User $user, Review $review): bool
    {
        return $user->hasPermission("Delete", self::PermissionName);
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermission("DeleteAny", self::PermissionName);
    }

    public function restore(User $user, Review $review): bool
    {
        return $user->hasPermission("Restore", self::PermissionName);
    }

    public function restoreAny(User $user): bool
    {
        return $user->hasPermission("RestoreAny", self::PermissionName);
    }

    public function forceDelete(User $user, Review $review): bool
    {
        return $user->hasPermission("ForceDelete", self::PermissionName);
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermission("ForceDeleteAny", self::PermissionName);
    }
}
