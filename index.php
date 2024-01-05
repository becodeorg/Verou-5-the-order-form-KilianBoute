<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

// We are going to use session variables so we need to enable sessions
session_start();

//Variables
$email = "";
$adress = ['street' => "",
'streetnumber' => "",
'city' => "",
'zipcode' => ""];
$cart = [];

// Use this function when you need to need an overview of these variables
function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

whatIsHappening();

// TODO: provide some products (you may overwrite the example)
$products = [
['name' => 'Frosted Flakes', 'price' => 3.99],
['name' => 'Cheerios', 'price' => 2.89],
['name' => 'Cocoa Puffs', 'price' => 4.25],
['name' => 'Honey Nut Cheerios', 'price' => 3.49],
['name' => 'Lucky Charms', 'price' => 4.75],
['name' => 'Cinnamon Toast Crunch', 'price' => 3.99],
['name' => 'Raisin Bran', 'price' => 3.29],
['name' => 'Cap\'n Crunch', 'price' => 3.95],
['name' => 'Special K', 'price' => 3.49],
['name' => 'Granola Clusters', 'price' => 4.99]
]
;

$totalValue = 0;

function validate()
{
    // TODO: This function will send a list of invalid fields back

    return [];
}



function handleForm()
{
    global $cart, $products;

    // TODO: form related tasks (step 1)
    $email = $_POST['email'];
    $adress = ['street' => $_POST['street'],
            'streetnumber' => $_POST['streetnumber'],
            'city' => $_POST['city'],
            'zipcode' => $_POST['zipcode']];
    foreach ($_POST['products'] as $index){
        if(!empty($products[$index])){
            $cart[] = $products[$index];
        }
    }
    
    echo '<pre>'; print_r($cart); echo '</pre>';

    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
        // TODO: handle errors
    } else {
        // TODO: handle successful submission
    }
}

/* TODO: replace this if by an actual check for the form to be submitted
$formSubmitted = false;
if ($formSubmitted) {
    handleForm();
}*/

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
        handleForm();
    }

require 'form-view.php';