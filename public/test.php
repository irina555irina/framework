<?php

require_once 'rb.php';

$db = require '../config/config_db.php';

R::setup($db['dsn'], 
$db['user'], $db['pass']);
// not to change table
R::freeze(true);
R::fancyDebug(true);

//var_dump(R::testConnection());

// Create +table

//$category1 = R::dispense('category');
//var_dump($category);
// id - auto
//$category1->title = 'Категория 1';
//var_dump($category);
//$id = R::store($category1);
//$category2 = R::dispense('category');
//$category2->title = 'Категория 2';
//$id = R::store($category2);
//$category3 = R::dispense('category');
//$category3->title = 'Категория 3';
//$id = R::store($category3);
//var_dump($id);


// Read 

//$category = R::load('category', 2);
//var_dump($category);
//echo $category->title; // object
//echo $category['title']; // array

//$category = R::findAll('category');
//print_r($category);


//$category = R::findAll('category', 'id > ?', [1]);
//print_r($category);

//$category = R::findAll('category', 'title LIKE ?', ['%атег%']);
//print_r($category);

//$category = R::findOne('category', 'id = 2');
//print_r($category);

// Update

//$category = R::load('category', 3);
//$category->title = "Категория 33";
//R::store($category);
//echo $category->title;

//$category = R::dispense('category');
//$category->title = "Категория 3";
//$category->id = 3;
//R::store($category);
//echo $category->title;

// Delete

//$category = R::load('category', 1);
//trashAll for some objects
//R::trash($category);
// for all table - Truncate
//R::wipe('category');










