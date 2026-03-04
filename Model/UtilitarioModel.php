<?php
function OpenDBPractica(){
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    return mysqli_connect("127.0.0.1:3306","root","","sgh");
}

function CloseDBPractica($context){
    mysqli_close($context);
}
?>