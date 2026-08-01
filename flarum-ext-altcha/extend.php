<?php

use Flarum\Extend;
use Flarum\User\ForgotPasswordValidator;
use Flarum\User\LogInValidator;
use PreserveMyGames\Altcha\Api\Controller\ChallengeController;
use PreserveMyGames\Altcha\Listener\AddAltchaForumAttributes;
use PreserveMyGames\Altcha\Listener\AddAltchaValidatorRule;
use PreserveMyGames\Altcha\Listener\ValidatePostAltcha;
use PreserveMyGames\Altcha\Listener\ValidateRegistrationAltcha;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    (new Extend\Locales(__DIR__.'/resources/locale')),

    (new Extend\Routes('api'))
        ->get('/altcha/challenge', 'pmg.altcha.challenge', ChallengeController::class),

    (new Extend\Settings())
        ->default('preservemygames-altcha.enabled', '1')
        ->default('preservemygames-altcha.cost', 5000)
        ->default('preservemygames-altcha.protect_registration', '1')
        ->default('preservemygames-altcha.protect_login', '0')
        ->default('preservemygames-altcha.protect_password_reset', '1')
        ->default('preservemygames-altcha.protect_discussion', '0')
        ->default('preservemygames-altcha.protect_reply', '0')
        ->serializeToForum('preservemygames-altcha.protectRegistration', 'preservemygames-altcha.protect_registration', 'boolval')
        ->serializeToForum('preservemygames-altcha.protectLogin', 'preservemygames-altcha.protect_login', 'boolval')
        ->serializeToForum('preservemygames-altcha.protectForgot', 'preservemygames-altcha.protect_password_reset', 'boolval')
        ->serializeToForum('preservemygames-altcha.protectDiscussion', 'preservemygames-altcha.protect_discussion', 'boolval')
        ->serializeToForum('preservemygames-altcha.protectReply', 'preservemygames-altcha.protect_reply', 'boolval'),

    (new Extend\ApiSerializer(\Flarum\Api\Serializer\ForumSerializer::class))
        ->attributes(AddAltchaForumAttributes::class),

    (new Extend\Validator(LogInValidator::class))
        ->configure(AddAltchaValidatorRule::class),

    (new Extend\Validator(ForgotPasswordValidator::class))
        ->configure(AddAltchaValidatorRule::class),

    (new Extend\Event())
        ->listen(\Flarum\User\Event\Saving::class, ValidateRegistrationAltcha::class)
        ->listen(\Flarum\Post\Event\Saving::class, ValidatePostAltcha::class),
];
