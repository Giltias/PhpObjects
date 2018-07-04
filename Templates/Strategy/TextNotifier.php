<?php

namespace Templates\Strategy;


class TextNotifier extends Notifier
{
    public function inform($message)
    {
        echo "Текстовое уведомление: {$message}<br />";
    }
}