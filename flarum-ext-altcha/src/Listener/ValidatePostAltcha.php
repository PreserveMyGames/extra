<?php

namespace PreserveMyGames\Altcha\Listener;

use Flarum\Foundation\ValidationException;
use Flarum\Locale\Translator;
use Flarum\Post\CommentPost;
use Flarum\Post\Event\Saving;
use Illuminate\Support\Arr;
use PreserveMyGames\Altcha\Service\AltchaService;
use PreserveMyGames\Altcha\Support\AltchaTokenExtractor;

class ValidatePostAltcha
{
    public function __construct(
        private AltchaService $altcha,
        private Translator $translator
    ) {
    }

    public function handle(Saving $event): void
    {
        if (! $event->post instanceof CommentPost || $event->post->exists) {
            return;
        }

        $action = $event->post->number === 1 ? 'discussion' : 'reply';
        if (! $this->altcha->protects($action)) {
            return;
        }

        if ($this->altcha->shouldBypass($event->actor)) {
            return;
        }

        $token = AltchaTokenExtractor::fromData($event->data);
        if (! $this->altcha->verify($token)) {
            throw new ValidationException([
                'captchaToken' => [$this->translator->trans('preservemygames-altcha.validation.failed')],
            ]);
        }
    }
}
