<?php

namespace Templates\Strategy;


class RegistrationMgr
{
    public function register(Lesson $lesson)
    {
        /**
         * @var $notifier Notifier
         */
        $notifier = Notifier::getNotifier();
        $notifier->inform("Новое занятие: стоимость - ({$lesson->cost()})");
    }
}