<?php 

require_once('config.inc.php'); 
require_once('lab14-db-functions.inc.php'); 
require_once('lab14-ex11-helpers.inc.php'); 

if (isset($_GET["id"]))
 $id = $_GET["id"];
else
 $id = 78; // set a default id if its missing

$genre = getSingleGenre($id); 

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chapter 14</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" rel="stylesheet">
  </head>
<body>
<main class="ui container">
    <div class="ui secondary segment">
         <h1><?php echo $genre['GenreName']; ?></h1>
    </div>    
    <div class="ui segment">
        <div class="ui grid">
           <div class="three wide column">
                <img src="images/art/genres/square-medium/<?php echo
$genre['GenreId']; ?>.jpg" >
           </div>
           <div class="thirteen wide column">
                <p><?php echo $genre['Description']; ?> </p>
                <p>
                <a class="ui labeled icon primary button" href="<?php echo $genre['Link']; ?>">
                  <i class="external icon"></i>
                  Read more on Wikipedia about 
                  <?php echo $genre['GenreName']; ?>
                </a>
                </p>
           </div> 
       </div>
    </div>
</main>


</body>
</html>