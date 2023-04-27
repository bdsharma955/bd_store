
<?php 
// Get input data 
function InputDataCount($col,$value){
    global $connection;
    $stm = $connection->prepare("SELECT $col FROM user_data WHERE $col=?");
    $stm->execute(array($value));
    $result = $stm->rowCount();

    return $result;
}

?>