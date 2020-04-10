<?php
namespace Question5\Classes;
/**
 * Class Node is an object contains two properties, one is actual value, and an other is the
 * Node object it self.
 * @package Question5\Classes
 */
class Node
{
    /**
     * @var
     */
    public $data;
    /**
     * @var Node
     */
    public $next;

    /**
     * Node constructor.
     * @param $data
     * @param Node|null $next
     */
    public function __construct($data, Node $next = null)
    {
        $this->data = $data;
        $this->next = $next;
    }
}
