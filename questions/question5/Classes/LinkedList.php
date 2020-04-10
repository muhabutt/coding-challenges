<?php


namespace Question5\Classes;

use Question5\Classes\Node as Node;
use Exception as Exception;

/**
 * Class LinkedList is data structure which like a chain of objects, and it is only one way
 * from left to right,
 * @package Question5\Classes
 */
class LinkedList
{
    public $head;
    public $size;

    public function __construct()
    {
        $this->head = null;
        $this->size = 0;
    }

    /**
     * 1. new Node is created
     * 2. node->data will provided parameter
     * 3. node->next will be current head ( which contains all the next nodes)
     * 4. increment the size
     * @param $data
     */
    public function insertNode($data)
    {
        // Head is a object which contains all Nodes;
        $this->head = new Node($data, $this->head);
        $this->size++;
    }

    /**
     * 1 : Create Node
     * 2 initilize current node;
     * 3 check if head is null, linkedList might be empty
     * 4 if head is not empty than current will the whole head object which contains all the Nodes
     * 5 loop through the head to check if current.next is null
     * 6 if current.next is not null than $current will be step4 $current->next
     * 7 end loop when current->next is null because now we are the last Node
     * 8 after loop $current->next will be step1 node;
     * 9 after else condition size++;
     *
     * @param $data
     */
    public function insertLast($data)
    {
        $node = new Node($data);
        $current = null;

        if ($this->head === null) {
            $this->head = $node;
        } else {
            $current = $this->head;

            while ($current->next !== null) {
                $current = $current->next;
            }
            $current->next = $node;
        }
        $this->size++;
    }

    /**
     * @param $data
     * @param int $index
     */
    public function insertAtIndex($data, int $index)
    {
        try {
            //out of range index
            if ($index > 0 && $index > $this->size) {
                throw new Exception("Index not found");
            }

            //Minus index are not allowed
            if ($index < 0) {
                throw new Exception("Index not found");
            }

            // if LinkedList is empty
            if ($index === 0) {
                $this->insertNode ($data);
                return;
            }

            //create a node
            $node = new Node($data);

            $current = $this->head;
            $count = 0;

            /*
             * Loop will run until count is less than index
             * now current is head which contains all the nodes
             * we need to set previous node to current and change the current to current->next
             * and count is incremented.
             *
             */
            while ($count < $index) {
                $previous = $current; // node before index
                $current = $current->next; // node after index
                $count++;
            }

            /**
             *when loop ends current is current->next, meaning next node is changed to current
             * previous->next will be above initilized node
             * increment the size;
             */
            $node->next = $current;
            $previous->next = $node;

            $this->size++;
        } catch (Exception $e) {
            trigger_error ($e->getMessage (), E_USER_ERROR);
        }
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->size;
    }

    /**
     * Clear linkedList
     */
    public function clearList()
    {
        $this->head = null;
        $this->size = 0;
    }
}
