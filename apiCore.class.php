<?php

/**
 *  Class file to provide core
 *  functions for API Calls
 * 
 *  i.e. 
 *  Curl requests
 *  Handling SOAP Calls
 *  Handling XML Responses
 *  Handling JSON Responses
 *  
 * @author Dave Jay <dave.jay90@gmail.com>
 * @since 01/05/2016
 * 
 */
class apiCore {
    # HTTP AUTH Username

    public $http_auth_username = "systems+api-semzzz@shipoffers.com";

    # HTTP AUTH Password
    public $http_auth_pass = "4jDNAgufRyyVfy5X";

    /**
     * Make basic GET curl call
     * @param String  $url
     * @return JSON/String
     * 
     * @author Dave Jay <dave.jay90@gmail.com>
     * @since 01/05/2016
     */
    public function doCall($url) {
        $ch = curl_init();
        $timeout = 5;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_USERPWD, "{$this->http_auth_username}:{$this->http_auth_pass}");

        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0');
        $data = curl_exec($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);

        curl_close($ch);
        return $data;
    }

    /**
     * Create CURL JSON Call
     * @param STRONG $url
     * @param JSON $body
     * @return JSON
     * @author Dave Jay <dave.jay90@gmail.com>
     * @since 01/05/2016* 
     */
    public function doJSONCall($url, $body) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_USERPWD, "{$this->http_auth_username}:{$this->http_auth_pass}");

        $output = curl_exec($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);

        curl_close($ch);
        return $output;
    }

    /**
     * Prepare the end point for the etrack api
     * @return String
     * @author Dave Jay <dave.jay90@gmail.com>
     * @since 01/05/2016
     */
    public function getURL() {
        return $this->apiURL . $this->endPoint . $this->storeID . $this->jsonFile;
    }

}

?>
