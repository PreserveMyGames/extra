<?php

use Flarum\Discussion\Discussion;
use Flarum\Extend;
use Flarum\Post\Post;
use Flarum\User\User;
use PreserveMyGames\UserManagement\Access\DiscussionPolicy;
use PreserveMyGames\UserManagement\Access\PostPolicy;
use PreserveMyGames\UserManagement\Access\UserPolicy;
use PreserveMyGames\UserManagement\Api\Controller\ListModerationLogController;
use PreserveMyGames\UserManagement\Api\Controller\ListUserPostsController;
use PreserveMyGames\UserManagement\Api\Controller\ModerateUserController;
use PreserveMyGames\UserManagement\Api\Serializer\AddUserModerationAttributes;
use PreserveMyGames\UserManagement\Listener\BlockLockedUserFromPosting;
use PreserveMyGames\UserManagement\Listener\RevokeAccessFromSuspendedUsers;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    (new Extend\Locales(__DIR__.'/resources/locale')),

    (new Extend\Routes('api'))
        ->get('/pmg/users/{id}/posts', 'pmg.users.posts', ListUserPostsController::class)
        ->post('/pmg/users/{id}/moderate', 'pmg.users.moderate', ModerateUserController::class)
        ->get('/pmg/moderation-log', 'pmg.moderation-log', ListModerationLogController::class),

    (new Extend\ApiSerializer(\Flarum\Api\Serializer\UserSerializer::class))
        ->attributes(AddUserModerationAttributes::class),

    (new Extend\User())
        ->registerPreference('pmgPostingLocked', 'boolval', false)
        ->registerPreference('pmgPostingLockMessage', null, '')
        ->registerPreference('pmgSuspendedUntil', null, null)
        ->permissionGroups(RevokeAccessFromSuspendedUsers::class),

    (new Extend\Policy())
        ->modelPolicy(Post::class, PostPolicy::class)
        ->modelPolicy(Discussion::class, DiscussionPolicy::class)
        ->modelPolicy(User::class, UserPolicy::class),

    (new Extend\Event())
        ->listen(\Flarum\Post\Event\Saving::class, [BlockLockedUserFromPosting::class, 'handlePost'])
        ->listen(\Flarum\Discussion\Event\Saving::class, [BlockLockedUserFromPosting::class, 'handleDiscussion']),
];
