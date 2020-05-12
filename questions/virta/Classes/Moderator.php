<?php


namespace Virta\Classes;

use Virta\Classes\User;

class Moderator extends User {

    public function __construct($name)
    {
        parent::__construct ($name);
    }

    function canEdit($comment) {
        return $comment->getAuthor() == $this ? true : false;

    }

    function canDelete($comment){
        return true;
    }
}
