<?php

namespace PreserveMyGames\Altcha\Listener;

use Flarum\Foundation\Event\Booting;
use PreserveMyGames\Altcha\Service\AltchaService;

class SyncConfiguredSetting
{
    public function __construct(
        private AltchaService $altcha
    ) {
    }

    public function handle(Booting $event): void
    {
        $this->altcha->syncConfiguredFlag();
    }
}
