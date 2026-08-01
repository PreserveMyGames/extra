<?php

namespace PreserveMyGames\UserManagement\Listener;

use Flarum\Group\Group;
use Flarum\User\User;
use PreserveMyGames\UserManagement\Service\UserModerator;

class RevokeAccessFromSuspendedUsers
{
    public function __construct(
        private UserModerator $moderator
    ) {
    }

    public function __invoke(User $user, array $groupIds): array
    {
        if ($this->moderator->isSuspended($user)) {
            return [Group::GUEST_ID];
        }

        return $groupIds;
    }
}
