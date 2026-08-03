<?php

use Flarum\Extend;
use Flarum\User\User;
use PreserveMyGames\DeleteUsers\Access\UserPolicy;
use PreserveMyGames\DeleteUsers\Api\Controller\DeleteUserController;
use PreserveMyGames\DeleteUsers\Api\Serializer\AddUserDeleteAttributes;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    (new Extend\Locales(__DIR__.'/resources/locale')),

    (new Extend\Routes('api'))
        ->post('/pmg/users/{id}/delete', 'pmg.users.delete', DeleteUserController::class),

    (new Extend\ApiSerializer(\Flarum\Api\Serializer\UserSerializer::class))
        ->attributes(AddUserDeleteAttributes::class),

    (new Extend\Policy())
        ->modelPolicy(User::class, UserPolicy::class),
];
