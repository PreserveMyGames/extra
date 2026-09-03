<?php

namespace PreserveMyGames\Maintenance\Serializer;

use Flarum\Api\Serializer\ForumSerializer;
use PreserveMyGames\Maintenance\MaintenanceState;

class AddMaintenanceAttributes
{
    public function __construct(
        private MaintenanceState $state
    ) {
    }

    public function __invoke(ForumSerializer $serializer, $model, array $attributes): array
    {
        return array_merge($attributes, $this->state->forumAttributes($serializer->getActor()));
    }
}
