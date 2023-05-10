<?php

namespace views;

class SpiritDelete
{
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render($spirit = null) {
        //delete spirit
        $spirit->delete($spirit['id']);
    }

}