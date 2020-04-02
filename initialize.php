<?php

$sql = "SELECT * FROM products";

$res = mysqli_query($conn, $sql);
if (false === $res) {
    printf("error: %s\n", mysqli_error($conn));
}

while ($r = mysqli_fetch_assoc($res)) {
    $product[$r['code']]['name'] = $r['name'];
    $product[$r['code']]['price'] = $r['price'];
}

$sql = "SELECT * FROM delivery_charge_rules";

$res = mysqli_query($conn, $sql);
if (false === $res) {
    printf("error: %s\n", mysqli_error($conn));
}

while ($r = mysqli_fetch_assoc($res)) {
    $delivery_charges[$r['upto']] = $r['delivery_charge'];
}

foreach ($product as $key => $value) {
    $sql = "SELECT * FROM offers WHERE product_code = '$key'";
    $res = mysqli_query($conn, $sql);
    if (false === $res) {
        printf("error: %s\n", mysqli_error($conn));
    }
    $stack = array();
    while ($r = mysqli_fetch_assoc($res)) {
        array_push($stack, $r['offer_name']);
    }
    $offers[$key] = $stack;
    $basket[$key] = 0;
}

?>
