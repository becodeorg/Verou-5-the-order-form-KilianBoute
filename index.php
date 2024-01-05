<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

// We are going to use session variables so we need to enable sessions
session_start();

//Variables
$email = "";
$adress = [
    'street' => "",
    'streetnumber' => "",
    'city' => "",
    'zipcode' => ""
];
$cart = [];

$invalidFields = [];


// Use this function when you need to need an overview of these variables
function whatIsHappening()
{
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
$productsCereal = [
    ['name' => 'Frosted Flakes', 'price' => 3.99],
    ['name' => 'Cheerios', 'price' => 2.89],
    ['name' => 'Cocoa Puffs', 'price' => 4.25],
    ['name' => 'Honey Nut Cheerios', 'price' => 3.49],
    ['name' => 'Lucky Charms', 'price' => 4.75],
    ['name' => 'Cinnamon Toast Crunch', 'price' => 3.99],
    ['name' => 'Raisin Bran', 'price' => 3.29],
    ['name' => 'Cap\'n Crunch', 'price' => 3.95]
];

$productsGranola = [
    ['name' => 'Almond Honey Granola', 'price' => 5.99],
    ['name' => 'Maple Pecan Granola', 'price' => 4.89],
    ['name' => 'Coconut Crunch Granola', 'price' => 6.25],
    ['name' => 'Mixed Berry Granola', 'price' => 5.49],
    ['name' => 'Chocolate Hazelnut Granola', 'price' => 6.75],
    ['name' => 'Vanilla Almond Granola', 'price' => 5.99],
    ['name' => 'Cranberry Orange Granola', 'price' => 5.29],
    ['name' => 'Peanut Butter Granola', 'price' => 5.95],
    ['name' => 'Cinnamon Apple Granola', 'price' => 5.49],
    ['name' => 'Cherry Almond Granola', 'price' => 6.99]
];

$products = isset($_GET['food']) && $_GET['food'] == 0 ? $productsGranola : $productsCereal;

$totalValue = 0;

function validate()
{
    // TODO: This function will send a list of invalid fields back

    $fields = ['email', 'street', 'streetnumber', 'city', 'zipcode', 'products'];
    foreach ($fields as $field) {
        $value = $_POST[$field];
        if (empty($value)) {
            $invalidFields[] = $field;
        }
        if ($field === 'zipcode') {
            if (!is_numeric($value)) {
                $invalidFields[] = $field;
            }
        }
    }
    return $invalidFields;
}



function handleForm()
{
    global $cart, $products, $totalValue;

    // TODO: form related tasks (step 1)
    $email = htmlspecialchars($_POST['email']);
    $adress = [
        'street' => htmlspecialchars($_POST['street']),
        'streetnumber' => htmlspecialchars($_POST['streetnumber']),
        'city' => htmlspecialchars($_POST['city']),
        'zipcode' => htmlspecialchars($_POST['zipcode'])
    ];
    foreach ($_POST['products'] as $index) {
        if (!empty($products[$index])) {
            $cart[] = $products[$index];
            $totalValue += $products[$index]['price'];
        }
    }

    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
        // TODO: handle errors
        foreach ($invalidFields as $invalidField) {
            echo 'Please enter a valid ' . $invalidField;
        }
    } else {
        // TODO: handle successful submission
        echo 'Your order has been submitted.';
    }
}

/* TODO: replace this if by an actual check for the form to be submitted
$formSubmitted = false;
if ($formSubmitted) {
    handleForm();
}*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handleForm();
}

require 'form-view.php';
