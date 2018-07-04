<?php

namespace Templates\Strategy;


class MailNotifier extends Notifier
{
    public function inform($message)
    {
        echo "Уведомление оп E-mail: {$message}<br />";
    }
}