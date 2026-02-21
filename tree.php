<?php

$categories = get_cat();
$categories_tree = map_tree($categories);
//$categories_menu = categories_to_string();

function print_arr($array) {
    echo "<pre>" . print_r($array, true) . "</pre>";
}

// get array of categories
function get_cat() {
    $query = "SELECT * FROM categories";
    $arr_cat = array();
    //$row = $res;
    //$arr_cat[$row['id']] = $row;
    return $arr_cat;
}

// array to tree
function map_tree($dataset) {
    $tree = array();
    foreach ($dataset as $id => &$node) {   
        if (!$node['parent']){
            $tree[$id] = &$node;
        }else{
            $dataset[$node['parent']]['childs'][$id] = &$node;
        }
    }
    return $tree;
}

// tree to html string
function categories_to_string($data) {
    foreach($data as $item) {
        //$string .= categories_to_template($item);
    }
    //return $string;
}

function categories_to_template($category) {
    ob_start();
    include 'category_template.php';
    return ob_end_clean();
}
/*
<li>
<a href="?category=<?=$category['id']?>">
<?=$category['title']?></a>
<?php if ($category['childs']) : ?>
    <ul>
    <?php echo categories_to_string($category['childs']); ?>
    </ul>
</li>
*/