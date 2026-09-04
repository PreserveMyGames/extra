<?php

namespace PreserveMyGames\Altcha\Serializer;

use Flarum\Api\Serializer\ForumSerializer;
use PreserveMyGames\Altcha\Service\AltchaService;

class AddAltchaForumAttributes
{
    public function __construct(
        private AltchaService $altcha
    ) {
    }

    public function __invoke(ForumSerializer $serializer, $model, array $attributes): array
    {
        $attributes['preservemygames-altcha.configured'] = $this->altcha->isConfigured();

        return $attributes;
    }
}
