<?php

/**
 * Page to push the order to ETrack Fullfilment
 * 
 * @author Dave Jay<dave.jay90@gmail.com>
 * @since 01/05/2016
 * 
 */
# Include the class
include 'apiEtrack.class.php';

# Create the object
$apiObj = new apiEtrack();

# Generate Dynamic Number
$time = time();
$order_number = "9710787894-test-1-{$time}";

# Debug Message
_ls("Creating Order with order number - {$order_number} ");

# Prepare the JSON
$json = ' { 
     "order":  {
          "order_number": "' . $order_number . '",
          "requested_shipping_service": "UPS First Class",
          "ship_name": "William Adama",
          "address1": "3534 Cole Prairie",
          "address2": "Suite 703",
          "city": "East Justine",
          "state": "North Carolina",
          "postal_code": "56957-3212",
          "country": "US",
          "phone": "1-514-133-0708",
          "email": null,
          "order_date": "2011-07-14 19:43:37 +0100",
          "items":[
              {
                 "sku":"P3OM",
                 "quantity":1
              },
              {
                 "sku":"MZNEW250",
                 "quantity":2
              }
          ]
      } 
  }';

# Create Order
$order = $apiObj->createOrders($json);

# Parse the response 
$order_data = json_decode($order, true);

# Get order ID
$order_id = $order_data['order']['id'];

# Debug Message
_ls("Order Created - The Order ID is: - {$order_id} ");

# Debug Message
_ls("Requesting data from server:");

# Get Order Info From Server
$order_from_server = $apiObj->getOrderById($order_id);

# Debug Message
_ls("The Order Data");

# Print the Order Data
print "<pre>";
print_r(json_decode($order_from_server, true));

function _ls($string) {
    print "<div style='padding:8px;background-color:#FFFFCC;font-family:verdana;border:1px solid #DADADA;border-radius:5px;margin:4px;font-size:12px;font-weight:bold'>";
    print $string;
    print "</div>";
}

die;
