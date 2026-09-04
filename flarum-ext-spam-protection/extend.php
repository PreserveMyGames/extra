<?php

use Flarum\Extend;
use PreserveMyGames\SpamProtection\Api\Controller\ListSpamAuditsController;
use PreserveMyGames\SpamProtection\Api\Controller\RescanPostController;
use PreserveMyGames\SpamProtection\Api\Controller\RescanRecentPostsController;
use PreserveMyGames\SpamProtection\Listener\MonitorNewUser;
use PreserveMyGames\SpamProtection\Listener\MonitorPostedContent;
use PreserveMyGames\SpamProtection\Listener\MonitorRevisedContent;

return [
    (new Extend\Locales(__DIR__.'/resources/locale')),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/less/admin.less'),

    (new Extend\Routes('api'))
        ->get('/pmg/spam/audits', 'pmg.spam.audits', ListSpamAuditsController::class)
        ->post('/pmg/spam/rescan-recent', 'pmg.spam.rescan-recent', RescanRecentPostsController::class)
        ->post('/pmg/spam/posts/{id}/rescan', 'pmg.spam.rescan-post', RescanPostController::class),

    (new Extend\Event())
        ->listen(\Flarum\Post\Event\Posted::class, MonitorPostedContent::class)
        ->listen(\Flarum\Post\Event\Revised::class, MonitorRevisedContent::class)
        ->listen(\Flarum\User\Event\Registered::class, MonitorNewUser::class),

    (new Extend\Settings())
        ->default('preservemygames-spam-protection.enabled', '0')
        ->default('preservemygames-spam-protection.base_url', 'https://openrouter.ai/api/v1')
        ->default('preservemygames-spam-protection.model', 'openai/gpt-4o-mini')
        ->default('preservemygames-spam-protection.monitor_posts', '1')
        ->default('preservemygames-spam-protection.monitor_edits', '1')
        ->default('preservemygames-spam-protection.monitor_new_users', '1')
        ->default('preservemygames-spam-protection.new_user_days', 14)
        ->default('preservemygames-spam-protection.new_user_post_count', 10)
        ->default('preservemygames-spam-protection.min_confidence', 70)
        ->default('preservemygames-spam-protection.action_hide_post', '1')
        ->default('preservemygames-spam-protection.action_hide_discussion', '1')
        ->default('preservemygames-spam-protection.action_lock_discussion', '1')
        ->default('preservemygames-spam-protection.action_suspend_user', '1')
        ->default('preservemygames-spam-protection.suspend_days', 30)
        ->default('preservemygames-spam-protection.fail_open', '1'),
];
