<?php

namespace Templates\Observer;


interface Observer
{
    public function update(Observable $observable);
}