<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
	
	/**
	 * Determine if the given user can see another user.
	 *
	 * @param  \App\Models\User  $authenticated_user_id
	 * @param  \App\Models\User  $viewing_user_id
	 * @return bool
	 */
	public function index(User $authenticated_user_id, User $viewing_user_id)
	{
		return $authenticated_user_id === $viewing_user_id;
	}
}
