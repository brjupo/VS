<?php

$url = 'https://kaanbal.net/DEV/Servicios/getFirstPart.php';
$data = array('tokenHora' => 'nda0913fTY673o84KJ');

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$json = file_get_contents($url, false, $context);

$result = json_decode($json, TRUE);

?>

<html>
    <body>
        <p><?php echo $result["response"];?></p>
        <p>.</p>
        <p>.</p>
        <p><?php echo $result["response"];?></p>
    </body>
</html>