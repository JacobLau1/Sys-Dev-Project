<?php

namespace views;

class WineDelete
{
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render($wine = null) {
        //delete wine
        $wine->delete($wine['id']);
    }

}