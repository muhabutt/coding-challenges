<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Question5</title>
  <style>
	pre {
	  background-color: #9b979c;
	  border: 1px solid;
	  display: flex;
	  justify-content: flex-start;
	  align-items: center;
	  padding: 20px;
	}
  </style>
</head>
<body>

<h1>Linked List in PHP</h1>
<pre>
		<?php
        //error reporting
        ini_set ('display_errors', 'On');

        require __DIR__ . '\vendor\autoload.php';

        use Question5\Classes\LinkedList as LinkedList;

        $linkList = new LinkedList();


        $linkList->insertNode (100);
        $linkList->insertNode (200);
        $linkList->insertNode (300);
        $linkList->insertLast (400);

        $linkList->insertAtIndex (50, 2);

        print_r ($linkList);
        ?>
	</pre>


<h1>Javascript Linked List</h1>
<div id="linkList"></div>
<script src="question5.js"></script>
</body>
</html>
