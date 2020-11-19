<?php


$db = JFactory::getDbo();

try
{
    $db->transactionStart();
    $query = $db->getQuery(true);


    $query = "DELETE FROM #__email_lista";
    $db->setQuery($query);
    $result = $db->execute();

    $query = "INSERT INTO #__email_lista (email) 
                VALUES $this->emailaddress";
    $db->setQuery($query);
    $result = $db->execute();

    $db->transactionCommit();

    $response = json_encode(
        array("result" => "SUCCESS",
            "data" => "Upload list: " . $this->emailaddress,
            "code" => 200)
    );
    echo $response;
    

}
catch (Exception $e)
{
    // catch any database errors.
    $db->transactionRollback();

    $response = json_encode(
        array("result" => "FAIL",
            "data" => "Upload list: " . $this->emailaddress,
            "code" => 500)
    );
    echo $response;
    
}


