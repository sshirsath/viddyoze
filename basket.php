<?php
include "database.php";
include "initialize.php";

function add($product_code) {
    global $basket;
    $basket[$product_code] += 1;
}

function total() {
    global $basket;
    $total = 0;
    foreach ($basket as $key => $value) {
	$product_multiplier = get_multiplier_for_product($key, $value);
	$total += (get_price($key) * $product_multiplier);
    }	

    $total += get_delivery_charge($total);
    return $total;
}

function get_price($product_code) {
    global $product; 
    return $product[$product_code]['price'];
}

function get_multiplier_for_product($product_code, $units) {
    global $offers;
    $multiplier = $units;
    foreach ($offers[$product_code] as $offer) {
	$multiplier_temp = $offer($units);
	if ($multiplier_temp < $multiplier)
	    $multiplier = $multiplier_temp;
    }
    return $multiplier;
}

function get_second_for_half_price($units) {
    if ($units % 2 == 0) {
	return ($units * 0.75);
    }
    else
        return (($units - 1) * 0.75 + 1);
}

function get_delivery_charge ($total) {
    global $delivery_charges;
    foreach ($delivery_charges as $upto => $delivery_charge) {
	if ($total > $upto)
	    continue;
        else {
	    return $delivery_charge;
	}	
    }
    return 0;
}

?>
