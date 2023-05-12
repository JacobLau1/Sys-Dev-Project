<?php

namespace views;

class BeerDelete
{
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render($beer = null) {
        //delete beer
        $beer->delete($beer['id']);
    }

}