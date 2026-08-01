<?php

namespace PreserveMyGames\Altcha\Listener;

use Flarum\Foundation\Event\ApplicationBooted;
use PreserveMyGames\Altcha\Service\AltchaService;

class SyncConfiguredSetting
{
    public function __construct(
        private AltchaService $altcha
    ) {
    }

    public function handle(ApplicationBooted $event): void
    {
        $this->altcha->syncConfiguredFlag();
    }
}
