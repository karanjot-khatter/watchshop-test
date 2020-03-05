<?php
if (isset($_POST['book_id']) && $_POST['book_id']!="") {
    $book_id = $_POST['book_id'];
    $url = "http://librarykaranjotkhatters.co.uk/api/books.php?id=".$book_id;

    $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($client);

    $result = json_decode($response);

    $record = $result[0];

    echo "<table>";
    echo "<tr><td>Book ID:</td><td>$record->id</td></tr>";
    echo "<tr><td>Name:</td><td>$record->name</td></tr>";
    echo "<tr><td>Link:</td><td>$record->link</td></tr>";
    echo "<tr><td>Content:</td><td>$record->content</td></tr>";
    echo "</table>";
}
?>
