<?php


namespace Virta\Classes;

use Virta\Classes\User;

class Admin extends Moderator {

    public function __construct($name)
    {
        parent::__construct ($name);
    }

    function canEdit($comment) {
        return true;
    }

    function canDelete($comment){
        return true;
    }
}
