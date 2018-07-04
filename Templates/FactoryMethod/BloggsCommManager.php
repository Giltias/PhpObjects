<?php

namespace Templates\FactoryMethod;


class BloggsCommManager extends CommsManager
{
    public function getHeaderText()
    {
        return "BloggsCal верхний колонтитул <br />";
    }

    public function getApptEncoder()
    {
        return new BloggsApptEncoder();
    }

    public function getFooterText()
    {
        return "BloggsCal нижний колонтитул <br />";
    }

}