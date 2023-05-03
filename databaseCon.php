<?php

function getConn(){
// for this code to work...... PLEASURE INSURE YOU HAVE THE FOLLOWING TABLE SET UP IN YOUR DATABASE --------->
/*
CREATE TABLE IF NOT EXISTS `users` (
  `username` text NOT NULL PRIMARY,
  `password` text NOT NULL,
  `status` text NOT NULL,
  `country` text NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `children` int(11) NOT NULL
)
*/

    return mysqli_connect("localhost", "dep", "admin", "mysql");
}
?>