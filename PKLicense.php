<?php

class PKLicense
{

    private $api_url = "https://app.paykickstart.com/api/";
    private $auth_token = false;

    public function __construct($auth_token)
    {
        $this->auth_token = $auth_token;
    }

    // PAYKICKSTART HELPERS
    public function pkCurl($route, $data, $post = false)
    {
        //Set up API path and method

        $url = $this->api_url . $route;
        $data["auth_token"] = $this->auth_token;

        //Create request data string
        $data = http_build_query($data);

        //Execute cURL request
        $ch = curl_init();

        if ($post) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } else {
            $url = $url . "?" . $data;
        }
        curl_setopt($ch, CURLOPT_URL, $url);

        // tell curl to return a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        return json_decode($output);
    }

    public function getPKLicenses($campaign_id, $email)
    {
        $route = "licenses/";
        $data = array(
            "campaign_id" => $campaign_id,
            "buyer_email" => $email
        );

        return $this->pkCurl($route, $data, false);
    }

    public function getPKStatus($sLicense)
    {
        $route = "licenses/status";
        $data = array("license_key" => $sLicense);

        return $this->pkCurl($route, $data);
    }

    public function clearPKLicense($licenseKey)
    {
        $route = "licenses/clear";
        $data = array("license_key" => $licenseKey);

        return $this->pkCurl($route, $data, $post = true);
    }

    public function isValidPKLicense($license_key)
    {
        $licenseStatus = $this->getPKStatus($license_key);
        $data = $licenseStatus->data;
        if ((isset($data->valid) && $data->valid == 1) &&
            (isset($data->active) && $data->active == 1)
        ) {
            return true;
        }

        return false;
    }
}
	
	
