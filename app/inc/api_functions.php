<?php 
    function api_request($endpoint, $method = 'GET', $variables = []) {
        // iniciar o curl cliente
        $client = curl_init();

        // return sera em string
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

        // definir URL
        $url = API_BASE_URL;

        // se o request for do tipo GET
        if($method == 'GET') {
            $url .= "?endpoint=$endpoint";
            if(!empty($variables)) {
                $url .= "&" . http_build_query($variables);
            } 
        }

        echo $url;

        // se o resquest for do tipo POST
        if($method == 'POST') {
            $variables = array_merge(['endpoint' => $endpoint], $variables);
            curl_setopt($client, CURLOPT_POSTFIELDS, $variables);
        }

        curl_setopt($client, CURLOPT_URL, $url);

        $response = curl_exec($client);
        return json_decode($response, true);
    }



?>