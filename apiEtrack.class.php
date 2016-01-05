<?php

/**
 * API Client class to interface with the ETrack ERP API
 *
 * @author Dave Jay <dave.jay90@gmail.com>
 * @since 01/05/2016
 */
# Include Core class
include "apiCore.class.php";

class apiEtrack extends apiCore {
    # API URL

    public $apiURL = "http://api.etrackerplus.com:80/api/";

    # Store ID
    public $storeID = "34feb71c-234b-4330-a3e0-72e0a0a23580";

    # The Endpoint - like Store, 
    public $endPoint = "";

    # The final JSON File
    public $jsonFile = "";

    /**
     * Retrieve All Orders
     * @return Array $data
     * @author Dave Jay <dave.jay90@gmail.com>
     * @since 01/05/2016* 
     */
    public function getOrders() {
        $this->endPoint = "stores/";
        $this->jsonFile = "/orders.json";
        $url = $this->getURL();
        $data = $this->doCall($url);
        return $data;
    }

    /**
     * Get Order By Specific ID
     * @param String $order_id
     * @return Array $data
     * @author Dave Jay <dave.jay90@gmail.com>
     * @since 01/05/2016* 
     */
    public function getOrderById($order_id) {
        $this->endPoint = "stores/";
        $this->jsonFile = "/orders/{$order_id}.json";
        $url = $this->getURL();
        $data = $this->doCall($url);
        return $data;
    }

    /**
     * Create Order - Expects the JSON
     * @param JSON $json
     * @return JSON $data
     * @author Dave Jay <dave.jay90@gmail.com>
     * @since 01/05/2016* 
     */
    public function createOrders($json) {
        $this->endPoint = "stores/";
        $this->jsonFile = "/orders/new.json";
        $url = $this->getURL();
        $data = $this->doJSONCall($url, $json);
        return $data;
    }

}
