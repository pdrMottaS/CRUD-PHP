<?php
    class connDB{
        function  connection(){
            try {
                $dbh = new PDO('mysql:host=localhost;dbname=myPhpServer', 'root', 'pe010902');
                return $dbh;
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }
    }
?>