<?php

function redirect($response, $to, $status = 200)
{
    var_dump('chegou na func redirect');
    return $response->withHeader('location', $to)->withStatus(200);
}
