<?php

namespace Templates\AbstractFactory;


class BloggsCommManager extends CommsManager
{
    public function getHeaderText()
    {
        return "BloggsCal верхний колонтитул <br />";
    }

    public function make($flag_int)
    {
        switch ($flag_int) {
            case self::APPT:
                return new BloggsApptEncoder();
            case self::TTD:
                return new BloggsTtdEncoder();
            case self::CONTACT:
                return new BloggsContactEncoder();
        }
    }

    public function getFooterText()
    {
        return "BloggsCal нижний колонтитул <br />";
    }

}