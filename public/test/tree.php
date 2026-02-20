<?php



function getTree($dataset) {
    $tree = array();
    
    //print_arr($dataset);
    foreach ($dataset as $id => &$node) {   
        //var_dump(!$node['parent']); echo "<br>";
        //print_arr($node['title']); //echo "<br><br>";
        //print_arr($dataset);
        //echo $node['title']; echo "<br>";
        if (!$node['parent']){
            //continue;
            $tree[$id] = &$node;
            //print_arr($tree);
            //echo $node['title']; echo " No Parent<br>";
            //continue;
            
            ///print_arr($node);
            //print_arr($tree);
            
        } else{
            //continue;
            $dataset[$node['parent']]['childs'][$id] = &$node;
            
            //print_arr($dataset);
            //echo "<br>///////<br>";
            //print_arr($dataset[$node['parent']]); 
            //die;
            //echo $node['title']; echo " Yes Parent<br>";
            //print_arr($dataset);
            //die;
        }  
        //print_arr($dataset); 
    }
    //print_arr($tree);
    return $tree;
}


$myArray[1] = ['id' => 1, 'title' => 'a', 'parent' => 0];
$myArray[2]=['id' => 2, 'title' => 'aa', 'parent' => 1];
$myArray[3]=['id' => 3, 'title' => 'bb', 'parent' => 5];
$myArray[4]=['id' => 4, 'title' => 'aaa', 'parent' => 1];
$myArray[5]=['id' => 5, 'title' => 'b', 'parent' => 0];
$myArray[6]=['id' => 6, 'title' => 'bbb', 'parent' => 5];
$myArray[7]=['id' => 7, 'title' => 'aaaa', 'parent' => 1];
$myArray[8]=['id' => 8, 'title' => 'aaaaa', 'parent' => 2];
 


function print_arr($array) {
    echo "<pre>" . print_r($array, true) . "</pre>";
}

$myTree = getTree($myArray);
print_arr($myTree);
//print_r($myTree);