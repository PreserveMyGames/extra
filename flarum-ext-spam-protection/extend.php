<?php

use Flarum\Extend;
use PreserveMyGames\SpamProtection\Listener\RecordPostActivity;
use PreserveMyGames\SpamProtection\Listener\ValidateDiscussionContent;
use PreserveMyGames\SpamProtection\Listener\ValidatePostContent;

return [
    (new Extend\Locales(__DIR__.'/resources/locale')),

    (new Extend\Event())
        ->listen(\Flarum\Post\Event\Saving::class, ValidatePostContent::class)
        ->listen(\Flarum\Post\Event\Posted::class, RecordPostActivity::class)
        ->listen(\Flarum\Discussion\Event\Saving::class, ValidateDiscussionContent::class),

    (new Extend\Settings())
        ->default('preservemygames-spam-protection.max_links', 3)
        ->default('preservemygames-spam-protection.new_user_max_links', 1)
        ->default('preservemygames-spam-protection.new_user_days', 7)
        ->default('preservemygames-spam-protection.new_user_post_count', 5)
        ->default('preservemygames-spam-protection.min_post_interval', 30)
        ->default('preservemygames-spam-protection.max_url_ratio', 50),
];
