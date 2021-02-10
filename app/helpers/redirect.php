<?php

function redirect($response, $to, $status = 200)
{
    return $response->withHeader('location', $to)->withStatus(200);
}
