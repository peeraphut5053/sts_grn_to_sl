<?php

while (list($key, $data) = each($_GET) OR list($key, $data) = each($_POST)) {
    ${$key} = trim($data);
}

$temp->setReplace("{crumb}", "");
$temp->setReplace("{pagename}", "Lists");
$temp->setReplace("{content}", $temp->getTemplate("./template/sync.html"));


// $temp->setReplace("{ConSlVal}", $conn_sl);
