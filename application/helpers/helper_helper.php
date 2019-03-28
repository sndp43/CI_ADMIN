<?php


if (!function_exists('generate_random_no')) {  
function generate_random_no($length)
{ 

 $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
    
}
}

if (!function_exists('get_usertype')){  
function get_usertype($role)
 { 
$table = "role";
$ci =& get_instance();
$ci->load->module("Common");
$query = $ci->common->get_where_role($role,$table) ;
return $query->result()[0]->rolename;
  
 }
}
if (!function_exists('get_appname')){  
function get_appname()
 {

$base_url = base_url();
                    $appname_array = explode("/",$base_url);
                   
                    $appindex  = count($appname_array) - 2;
                    return $appname = $appname_array[3];

 }
}

function get_classname(){

$ci =& get_instance();
$ci->router->class; // gets class name (controller)
$ci->router->method ;// gets function name (controller function)

return $ci->router->class;
}


function get_method(){

$ci =& get_instance();
$ci->router->class; // gets class name (controller)
$ci->router->method ;// gets function name (controller function)

return $ci->router->method;
}

function getTemplate(){
    $classname=get_classname();
    $methodname=get_method();

    return $classname.'-'.$methodname;
}

if (!function_exists('get_height_width_withimg')) {

    function get_height_width_withimg($image) {

        if(file_exists($image)){

// Get the width and height of the Image
list($width,$height) = getimagesize($image);

// So then if the image is wider rather than taller, set the width and figure out the height
if ($width>$height) {
            $outputwidth = "300";
            $outputheight = "auto";
        }
// And if the image is taller rather than wider, then set the height and figure out the width
        elseif ($width<$height) {
            $outputwidth = "auto";
            $outputheight = "150";
        }
// And because it is entirely possible that the image could be the exact same size/aspect ratio of the desired area, so we have that covered as well
        elseif ($width==$height) {
            $outputwidth = "300";
            $outputheight = "150";
            }
// Echo out the results and done  

}else{

             $outputwidth = "300";
             $outputheight = "150";

}
echo'<img src="'.$image.'" height="'.$outputheight.'" width="'.$outputwidth.'" >';


    }

}
