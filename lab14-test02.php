<?php

require_once 'config.inc.php';
require_once 'lab14-db-functions.inc.php'; 
require_once 'lab14-test02-helpers.inc.php';

    
// now retrieve galleries 
 
// now retrieve  paintings ... either all or a subset based on querystring

?>
<!DOCTYPE html>
<html lang=en>
<head>
    <title>Lab 14</title>
    <meta charset=utf-8>
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" rel="stylesheet">
</head>
<body >
    
<main class="ui segment doubling stackable grid container">

    <section class="four wide column">
        <form class="ui form" method="get" action="<?=$_SERVER['REQUEST_URI']?>">
          <h3 class="ui dividing header">Filters</h3>

          <div class="field">
            <label>Museum</label>
            <select class="ui fluid dropdown" name="museum">
                <option value='0'>Select Museum</option>  
                <?php 
                    $pdo = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);
                    $sql = getGallerySQL();
                    $gallery = $pdo->query($sql);
                    foreach($gallery as $g){
                    echo "<option value='".$g["GalleryID"]."'>".$g['GalleryName']."</option>";
                   }
                   $pdo = null;
                   // output all the retrieved galleries (hint: set value attribute of <option> to the GalleryID field)
                ?>
            </select>
          </div>   
          <button class="small ui orange button" type="submit">
              <i class="filter icon"></i> Filter 
          </button>    

        </form>
    </section>
    

    <section class="twelve wide column">
        <h1 class="ui header">Paintings</h1>
        <ul class="ui divided items" id="paintingsList">
            
          <?php outputPaintings(); ?>

        </ul>        
    </section>  
    
</main>    
<footer class="ui black inverted segment">
  <div class="ui container">&Copy 2019 Fundamentals of Web Development</div>
</footer>
</body>
</html>