<?php

/**
 * Fthirty \ Curl Wrap
 * 
 * The Curl Wrap is the entry point to all services and actions.
 *
 * @author    Fthirty
 */


# Enter your domain name , fthirty email and fthirty api key
define("FTHIRTY_DOMAIN", "YOUR_FTHIRTY_DOMAIN");  # Example : define("domain","jim");
define("FTHIRTY_USER_EMAIL", "YOUR_FTHIRTY_USER_EMAIL");
define("FTHIRTY_REST_API_KEY", "YOUR_FTHIRTY_REST_API_KEY");

function curl_wrap($entity, $data, $method, $content_type) {
    if ($content_type == NULL) {
        $content_type = "application/json";
    }
    
    $agile_url = "https://" . FTHIRTY_DOMAIN . ".fthirty.com/api/" . $entity;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_UNRESTRICTED_AUTH, true);
    switch ($method) {
        case "POST":
            $url = $agile_url;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            break;
        case "GET":
            $url = $agile_url;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            break;
        case "PUT":
            $url = $agile_url;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            break;
        case "DELETE":
            $url = $agile_url;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            break;
        default:
            break;
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type:$content_type;", 'Accept:application/json'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, FTHIRTY_USER_EMAIL . ':' . FTHIRTY_REST_API_KEY);
    curl_setopt($ch, CURLOPT_TIMEOUT, 120);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
