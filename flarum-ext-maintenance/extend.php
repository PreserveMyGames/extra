<?php

use Flarum\Extend;
use PreserveMyGames\Maintenance\Listener\BlockWriteOperations;
use PreserveMyGames\Maintenance\Middleware\MaintenanceMiddleware;
use PreserveMyGames\Maintenance\Serializer\AddMaintenanceAttributes;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    (new Extend\Locales(__DIR__.'/resources/locale')),

    (new Extend\Middleware('api'))
        ->add(MaintenanceMiddleware::class),

    (new Extend\ApiSerializer(\Flarum\Api\Serializer\ForumSerializer::class))
        ->attributes(AddMaintenanceAttributes::class),

    (new Extend\Event())
        ->listen(\Flarum\Post\Event\Saving::class, BlockWriteOperations::class)
        ->listen(\Flarum\Discussion\Event\Saving::class, BlockWriteOperations::class),

    (new Extend\Settings())
        ->default('preservemygames-maintenance.mode', 'off')
        ->default('preservemygames-maintenance.title', 'Forum under maintenance')
        ->default('preservemygames-maintenance.message', 'We are performing maintenance. Please check back soon.')
        ->default('preservemygames-maintenance.allow_login', '1')
        ->default('preservemygames-maintenance.show_banner', '1'),
];
