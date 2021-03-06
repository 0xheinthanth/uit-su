<?php

namespace App\Policies;

use App\User;
use App\Events;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventsPermission
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        $current_user_role = Role::where('id', $user->role)->first();

        $allow = [1, 2, 3, 4, 5, 6];

        if (in_array($current_user_role->id, $allow)) {
            return true;
        }
        return false;
    }

    public function hide(User $user, Events $events) {
        $current_user_role = Role::where('id', $user->role)->first();
        $events_owner_role = Role::where('id', User::where('id', $events->owner)->first()->role)->first();

        if( $current_user_role->standalone == true ) {
            if( $current_user_role->level <= $events_owner_role->level ) {
                return true;
            }
        } else {
            $committee_as_posted = $events->committee;
            $club_as_posted = $events->club;
            if( $current_user_role->level <= $events_owner_role->level ) {
                if( $user->committee == $committee_as_posted || $user->club == $club_as_posted) {
                    return true;
                }
            }
        }
        return false;
    }

    public function unhide(User $user, Events $events) {
        $current_user_role = Role::where('id', $user->role)->first();
        $hidden_role = Role::where('id', User::where('id', $events->hidden_by)->first()->role)->first();

        if( $current_user_role->standalone == true ) {
            if( $current_user_role->level <= $hidden_role->level ) {
                return true;
            }
        } else {
            $committee_as_posted = $events->committee;
            $club_as_posted = $events->club;
            if( $current_user_role->level <= $hidden_role->level ) {
                if( $user->committee == $committee_as_posted || $user->club == $club_as_posted) {
                    return true;
                }
            }
        }
        return false;
    }

    public function edit(User $user, Events $events) {
        $current_user_role = Role::where('id', $user->role)->first();
        $events_owner_role = Role::where('id', User::where('id', $events->owner)->first()->role)->first();

        if( $current_user_role->standalone == true ) {
            if( $current_user_role->level <= $events_owner_role->level ) {
                return true;
            }
        } else {
            $committee_as_posted = $events->committee;
            $club_as_posted = $events->club;
            if( $current_user_role->level <= $events_owner_role->level ) {
                if( $user->committee == $committee_as_posted || $user->club == $club_as_posted) {
                    return true;
                }
            }
        }
        return false;
    }

    public function delete(User $user, Events $events) {
        $current_user_role = Role::where('id', $user->role)->first();
        $events_owner_role = Role::where('id', User::where('id', $events->owner)->first()->role)->first();

        if( $current_user_role->standalone == true ) {
            if( $current_user_role->level <= $events_owner_role->level ) {
                return true;
            }
        } else {
            $committee_as_posted = $events->committee;
            $club_as_posted = $events->club;
            if( $current_user_role->level <= $events_owner_role->level ) {
                if( $user->committee == $committee_as_posted || $user->club == $club_as_posted) {
                    return true;
                }
            }
        }
        return false;
    }

}