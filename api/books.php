<?php
include_once("database.php");
if (isset($_GET['id']))
{
    getBooksById();
}
else {
    getBooks();
}
