<?php

/*
  Return a row containing a single genre
*/
function getSingleGenre($id) {
    try {
         $connection=setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
         $sql = 'select GenreId, GenreName, Description, Link from
         Genres where GenreId=?';
         $statement = runQuery($connection, $sql, array($id));
         $row = $statement->fetch(PDO::FETCH_ASSOC);
         $connection = null;
         return $row; 
    }
    catch (PDOException $e) {
       die( $e->getMessage() );
    }
}

/*
  Return a result set containing all the genres
*/
function getAllGenres() {
   try {
     $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
     $sql = 'select GenreId, GenreName, Description from Genres
     Order By EraID';
    
     $result = runQuery($connection, $sql, null);
     return $result; 
       }
   catch (PDOException $e) {
      die( $e->getMessage() );
   }    
}


/*
 Displays a list of genres
*/
function outputGenres() {
     $genres = getAllGenres();
     foreach ($genres as $g) {
     outputSingleGenre($g);
 } 
}


/*
 Displays a single genre
*/
function outputSingleGenre($genre) {
 echo '<div class="ui fluid card">';
 echo '<div class="ui fluid image">';
 $img = '<img src="images/art/genres/square-medium/' .
 $genre['GenreId'] .'.jpg">';
 echo constructGenreLink($genre['GenreId'], $img);
 echo '</div>';
 echo '<div class="extra">';
 echo '<h4>';
 echo constructGenreLink($genre['GenreId'],
 $genre['GenreName']);
 echo '</h4>';
 echo '</div>';
 echo '</div>';
}

/* 
  Constructs a link given the genre id and a label (which could
  be a name or even an image tag
*/
function constructGenreLink($id, $label) {
   $link = '<a href="genre.php?id=' . $id . '">';
   $link .= $label;
   $link .= '</a>';
   return $link;
}
?>