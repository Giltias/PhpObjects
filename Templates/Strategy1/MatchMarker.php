<?php

namespace Templates\Strategy1;


class MatchMarker extends Marker
{
    function mark($response)
    {
        return ($this->test == $response);
    }

}