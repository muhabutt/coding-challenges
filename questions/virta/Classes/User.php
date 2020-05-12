<?php


namespace Virta\Classes;


class User
{
    private $name;
    private $authStatus;
    private $lastLoggedInAt;

    function __construct($name)
    {
        $this->name = $name;
        $this->authStatus = false;
        $this->lastLoggedInAt = null;
    }

    function isLoggedIn()
    {
        return $this->authStatus;
    }

    function getLastLoggedInAt()
    {
        return $this->lastLoggedInAt;
    }

    function logIn()
    {
        $this->lastLoggedInAt = date ('Y-m-d H:i:s');
        $this->authStatus = true;
    }

    function logOut()
    {
        $this->authStatus = false;
    }

    function getName()
    {
        return $this->name;
    }

    function setName($name)
    {
        $this->name = $name;
    }

    function canEdit($comment)
    {
        return $comment->getAuthor () == $this ? true : false;
    }

    function canDelete($comment)
    {
        return false;
    }
}
