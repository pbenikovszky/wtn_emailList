<?php


$db = JFactory::getDbo();
$query = $db->getQuery(true);
$query = "INSERT INTO #__email_lista (email) 
            VALUES (" . $db->quote($this->emailaddress) . ")";
$db->setQuery($query);
$result = $db->execute();




$response = json_encode(
    array("result" => "SUCCESS",
        "data" => "Add email: " . $this->emailaddress,
        "code" => 200)
);

echo $response;
