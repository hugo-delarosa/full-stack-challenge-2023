<?php

namespace App\Policies;

use App\Role;
use App\User;
use App\Referral;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReferralPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        foreach ($user->roles as $role) {
            if (Role::ADMIN == decrypt($role->name)) {
                return true;
            }
        }
        return null;
    }

    /**
     * Determine whether the user can view the referral.
     *
     * @param  \App\User  $user
     * @param  \App\Referral  $referral
     * @return mixed
     */
    public function view(User $user, Referral $referral)
    {
        return $this->index($user);
    }

    public function index(User $user)
    {
        foreach($user->permissions as $permission) {
            if(decrypt($permission->slug) == 'view-referral') return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create referrals.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        foreach($user->permissions as $permission) {
            if($permission->slug == encrypt('create-referral')) return true;
        }

        return false;
    }

    public function bulkCreate(User $user)
    {
        foreach($user->permissions as $permission) {
            if($permission->slug == encrypt('create-bulk-referral')) return true;
        }

        return false;
    }

    public function createComment(User $user, Referral $referral)
    {
        foreach($user->permissions as $permission) {
            if(decrypt($permission->slug) == 'create-comment') return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the referral.
     *
     * @param  \App\User  $user
     * @param  \App\Referral  $referral
     * @return mixed
     */
    public function update(User $user, Referral $referral)
    {
        foreach($user->permissions as $permission) {
            if(decrypt($permission->slug) == 'update-referral') return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the referral.
     *
     * @param  \App\User  $user
     * @param  \App\Referral  $referral
     * @return mixed
     */
    public function delete(User $user, Referral $referral)
    {
        foreach($user->permissions as $permission) {
            if(decrypt($permission->slug) == 'delete-referral') return true;
        }

        return false;
    }
}
