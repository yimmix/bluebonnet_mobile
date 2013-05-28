<?php
	
    header('Access-Control-Allow-Origin: * ');
    require_once("classes/db.class.php");
    require_once("classes/sqlquery.class.php");
    $db = new SqlQuery();
   //$_POST['search'] = "Pre Workout Formula";
   

    /* $sql = "SELECT p.* , pp.resource_id, pp.picture_desc, r.filename, r.path, r.filetype,
      pac.package_product_no, pac.package_qty, pac.package_medium, pac.package_notes,
      sf.serving_size, sf.footnotes, sf.contains, sf.other_ingredients,sf.free_of, sf.also_free_of,
      sfi.ingredient, sfi.ingredient_text, sfi.ingredient_text_2, sfi.qty, sfi.unit
      FROM products AS p
      LEFT JOIN product_pictures AS pp
      ON p.product_id = pp.product_id
      LEFT JOIN resources AS r
      ON r.resource_id = pp.resource_id
      LEFT JOIN product_packages AS pac
      ON pac.product_id = p.product_id
      LEFT JOIN suplement_facts as sf
      on sf.product_id = p.product_id
      LEFT JOIN suplement_fact_items as sfi
      on sfi.suplement_fact_id = sf.suplement_fact_id
      WHERE p.product_name LIKE '%".$_POST['search']."%'";
*/
     

    $sql = "SELECT p.* , pp.resource_id, pp.picture_desc, r.filename, r.path, r.filetype,
                    pac.package_product_no, pac.package_qty, pac.package_medium, pac.package_notes
                    FROM products AS p
                    LEFT JOIN product_pictures AS pp
                    ON p.product_id = pp.product_id
                    LEFT JOIN resources AS r
                    ON r.resource_id = pp.resource_id
                    LEFT JOIN product_packages AS pac
                    ON pac.product_id = p.product_id
                    WHERE p.product_name LIKE '%" . $_POST['search'] . "%'";

    $res = $db->dbQuery($sql);
    $result = mysql_fetch_assoc($res);

        // query to fetch supplement facts details

      $supplementSql = "SELECT sf.serving_size, sf.footnotes, sf.contains, sf.other_ingredients,sf.free_of, sf.also_free_of,sf.caution,
                        sfi.ingredient, sfi.ingredient_text, sfi.ingredient_text_2, sfi.qty, sfi.unit
                        FROM suplement_facts as sf
                        LEFT JOIN suplement_fact_items as sfi
                        on sfi.suplement_fact_id = sf.suplement_fact_id
                        WHERE sf.product_id = '".(int)$result['product_id']."' ";

      $supplementRes = $db->dbQuery($supplementSql);

      $ingredient_text = "";
      

      while($supplement = mysql_fetch_assoc($supplementRes)) {

          $serving_size = "<span class='serving_size'>Serving Size : ".$supplement['serving_size']."</span>" ;

          if($ingredient_text == "") {
            $ingredient_text = "<div style='width:100%;padding:2px;color:#000;font-size:10px;float:left;'><div style='width:60%'>".$supplement['ingredient_text']."".$supplement['ingredient_text_2']."</div><div style='width:30%;margin-left:10%;float:right;'>".$supplement['qty']."".$supplement['unit']."</div></div>";
          } else {
            $ingredient_text .= "<div style='width:100%;padding:2px;color:#000;font-size:10px;float:left;'><div style='width:60%'>".$supplement['ingredient_text']."".$supplement['ingredient_text_2']."</div><div style='width:30%;margin-left:10%;float:right;'>".$supplement['qty']."".$supplement['unit']."</div></div>";
          }

          $content = "<div style='font-size:10px;color:#000;padding:4px;'>".$supplement['footnotes']."</div><div style='font-size:10px;color:#000;padding:4px;'>".$supplement['other_ingredients']."</div><div style='font-size:10px;color:#000;padding:4px;'>".$supplement['free_of']."</div><div style='font-size:10px;color:#000;padding:4px;'>".$supplement['also_free_of']."</div><div style='font-size:10px;color:#000;padding:4px;'>".$supplement['caution']."</div>";

      }

     $supplementContent = $serving_size."<br>".$ingredient_text."<br>".$content."<br><input type='button' value='BACK' onclick='javascript:hideSupplement();' >";

     $result['supplementContent'] = $supplementContent;
     
      // query to fetch package details

      $packageSQL = "SELECT pac.package_product_no, pac.package_qty, pac.package_medium, pac.package_notes
      FROM product_packages AS pac
      WHERE pac.product_id = '".(int)$result['product_id']."'";
      $packageRes = $db->dbQuery($packageSQL);
      $content = "";

      while($package = mysql_fetch_assoc($packageRes)) {
          
          if($content == "") {
              $content = "<div style='font-size:10px;color:#000;padding:2px;'>".$package['package_product_no']." ".$package['package_qty']." ".$package['package_medium']." ".$package['package_notes']."</div>";
          } else {
              $content .= "<div style='font-size:10px;color:#000;padding:2px;'>".$package['package_product_no']." ".$package['package_qty']." ".$package['package_medium']." ".$package['package_notes']."</div>";
          }
          
      }

      $result['packageContent'] = $content."<br><input type='button' value='BACK' onclick='javascript:hideFlavor();' >";

      $json = json_encode($result);
      echo $json;
?>
