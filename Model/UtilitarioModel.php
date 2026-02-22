<?php

function OpenDataBase()
{
    mysqli_report(MYSQLI_REPORT_ERROR);
    return mysqli_connect("127.0.0.1","root","","sgh"); 
    //El hostname si el sql esta en 3306 lo dejan como esta sino lo cambian (127.0.0.1:3307) para que les funcione la conexión
}

function CloseDataBase($context)
{
    mysqli_close($context);
}