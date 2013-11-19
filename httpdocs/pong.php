<?php
//pong.php php isn't my main thing but tried my best!
$obj = new WhatsNew();
$out = "";
if ($obj->getGotNew()){
    $types = new array();
    foreach ($obj->newStuff() as $type)
        {
            $new = array('type' => $type);
            $types[] = $new;
        }

    $out = json_encode($types);
}
else{
    $out = json_encode(array('nothingNew' => true));
}