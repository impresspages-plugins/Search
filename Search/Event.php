<?php

namespace Plugin\Search;

class Event
{
    public static function ipBeforeController()
    {
        ipAddJs('assets/search.js');
        ipAddCss('assets/search.css');
    }
}
