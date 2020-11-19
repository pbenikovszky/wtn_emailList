<?php

$db = JFactory::getDbo();
$query = $db->getQuery(true);
$query = "DELETE from #__email_lista WHERE id IN ($this->emailaddress)";
$db->setQuery($query);
$result = $db->execute();


$response = json_encode(
    array("result" => "SUCCESS",
        "data" => "Delete email: " . $this->emailaddress,
        "code" => 200)
);
echo $response;
