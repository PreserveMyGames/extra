<?php

use Flarum\Extend;
use PreserveMyGames\SpamProtection\Listener\RecordDiscussionActivity;
use PreserveMyGames\SpamProtection\Listener\RecordPostActivity;
use PreserveMyGames\SpamProtection\Listener\ValidateDiscussionContent;
use PreserveMyGames\SpamProtection\Listener\ValidatePostContent;

return [
    (new Extend\Locales(__DIR__.'/resources/locale')),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    (new Extend\Event())
        ->listen(\Flarum\Post\Event\Saving::class, ValidatePostContent::class)
        ->listen(\Flarum\Post\Event\Posted::class, RecordPostActivity::class)
        ->listen(\Flarum\Discussion\Event\Saving::class, ValidateDiscussionContent::class)
        ->listen(\Flarum\Discussion\Event\Started::class, RecordDiscussionActivity::class),

    (new Extend\Settings())
        ->default('preservemygames-spam-protection.new_user_post_delay_enabled', '1')
        ->default('preservemygames-spam-protection.new_user_post_delay', 3600)
        ->default('preservemygames-spam-protection.min_post_interval', 8)
        ->default('preservemygames-spam-protection.new_user_min_post_interval', 20)
        ->default('preservemygames-spam-protection.burst_posts_hour', 20)
        ->default('preservemygames-spam-protection.duplicate_window', 900)
        ->default('preservemygames-spam-protection.new_user_days', 14)
        ->default('preservemygames-spam-protection.new_user_post_count', 10)
        ->default('preservemygames-spam-protection.min_links_for_context_check', 4)
        ->default('preservemygames-spam-protection.min_non_link_chars', 25)
        ->default('preservemygames-spam-protection.max_links', 0)
        ->default('preservemygames-spam-protection.new_user_max_links', 0)
        ->default('preservemygames-spam-protection.max_url_ratio', 0)
        ->default('preservemygames-spam-protection.url_ratio_min_length', 120),
];
