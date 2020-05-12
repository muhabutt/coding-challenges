<?php


namespace Virta\Classes;

use Virta\Classes\User;
class Comment {
    private $author;
    private $created_at;
    private $message;
    private $repliedTo;

    function __construct($author, $message, $repliedTo=null) {
        $this->author = $author;
        $this->message = $message;
        $this->repliedTo = $repliedTo;
        $this->created_at = date('Y-m-d H:i:s');
    }

    function getMessage() {
        return $this->message;
    }
    function setMessage($message) {
        $this->message = $message;
    }

    function getCreatedAt() {
        return $this->created_at;
    }
    function getAuthor() {
        return $this->author;
    }
    function getRepliedTo() {
        return $this->repliedTo;
    }

    function __toString() {
        if($this->getRepliedTo()){
            return $this->message . ' by ' . $this->getAuthor()->getName().
                " (replied to ". $this->getRepliedTo()->getAuthor()->getName().")";
        }
        return $this->message . ' by ' . $this->getAuthor()->getName();
    }
}
