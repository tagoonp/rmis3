<?php
function add_class_active($ref_type, $ref){
  if($ref_type == 'main-menu'){
    $pagename = basename($_SERVER['PHP_SELF']);
    $b = explode('.', $pagename);
    if($ref == 1){
      if(($b[0] == 'project_list') || ($b[0] == 'search_result') || ($b[0] == 'project_manage')){
        echo "active";
      }
    }else if($ref == 2){
      if(($b[0] == 'modules-page-list') || ($b[0] == 'modules-page-new') || ($b[0] == 'modules-page-tags') || ($b[0] == 'modules-page-group')){
        echo "active";
      }
    }else if($ref == 3){
      if(($b[0] == 'modules-post-list') || ($b[0] == 'modules-post-new') || ($b[0] == 'modules-post-category')){
        echo "active";
      }
    }else if($ref == 4){
      if(($b[0] == 'modules-stat-overview') || ($b[0] == 'modules-stat-hits') || ($b[0] == 'modules-stat-pageandpost') || ($b[0] == 'modules-stat-access-location')){
        echo "active";
      }
    }
    else if($ref == 5){
      if(($b[0] == 'modules-subdomain-list') || ($b[0] == 'modules-subdomain-add')){
        echo "active";
      }
    }
    else if($ref == 6){
      if(($b[0] == 'modules-person-list') || ($b[0] == 'modules-person-group')){
        echo "active";
      }
    }
  }else{
    $pagename = basename($_SERVER['PHP_SELF']);
    $b = explode('.', $pagename);
    if(sizeof($b) > 0){
      if($b[0] == $ref){
        echo "active";
      }
    }else{
      if($b[0] == $ref){
        echo "active";
      }
    }

  }

}

function get_configuration($conn, $position, $lang, $domain){
  // include "../config.class.php";
  $strSQL = "SELECT * FROM wwt_configuration WHERE conf_key = '$position' AND conf_lang = '$lang' AND conf_use = '1' AND conf_domain = '$domain'";
  $query = mysqli_query($conn, $strSQL);
  if($query){
    // echo $strSQL;
    $row = mysqli_fetch_assoc($query);
    return $row['conf_value'];
  }
  mysqli_close($conn);
  die();
}

function goto_url($url){
  if(isset($_GET['lang'])){
    return $url."?lang=".$_GET['lang'];
  }else{
    return $url;
  }
}

function findText($start_limiter,$end_limiter,$haystack)
{
   $start_pos = strpos($haystack,$start_limiter);
   if ($start_pos === FALSE)
   {
       return FALSE;
   }

   $end_pos = strpos($haystack,$end_limiter,$start_pos);

   if ($end_pos === FALSE)
   {
      return FALSE;
   }

   return substr($haystack, $start_pos+1, ($end_pos-1)-$start_pos);
}
?>
