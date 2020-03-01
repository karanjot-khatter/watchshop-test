<?php

define('HST', 'localhost');
define('USR', 'root');
define('PSW', 'root');
define('DBN', 'watchshop');

$mysqli = null;


//open mysqli connection
//used as a private function...
function openConnection()
{
    global $mysqli;
    //we connect to the host and select db in one step by creating instance of mysqli
    $mysqli = new mysqli(HST, USR, PSW, DBN);

    if (!isset($mysqli->connect_error)) {
        $dbok = true;
    } else {
        $dbok = false;
    }

    return $dbok;
}

//close the connection
//used as a private function...
function closeConnection()
{
    global $mysqli;

    if ($mysqli !== null) {
        $mysqli->close();
    }
}

/*
 * @desc - The query gets all data from the books table
 * @return - return output in the JSON format
 */
function getBooks()
{
    openConnection();
    global $mysqli;
    $query="SELECT * FROM books";
    $res = $mysqli->query($query);

    if ($res->num_rows > 0) {
        //empty array
        $books = [];

        while ($row = $res->fetch_assoc()) {
            //push rows from database into the array
            $books[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($books);
    }
    else {
        echo "0 results";
    }

    closeConnection();
}

function getBooksByCategory()
{
    openConnection();
    global $mysqli;
    $query="select cat.`name` as 'category_name', bc.category_id as 'category_id', bc.book_id as 'book_id', b.`name` as 'book_name', b.link, b.content
from categories cat
LEFT JOIN book_categories bc ON cat.id = bc.category_id
JOIN books b ON bc.book_id = b.id
ORDER BY bc.category_id;
";

    $res = $mysqli->query($query);

    if ($res->num_rows > 0) {
        //empty array
        $books = [];

        while ($row = $res->fetch_assoc()) {
            //push rows from database into the array
            $books[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($books);
    }
    else {
        echo "0 results";
    }

    closeConnection();
}



