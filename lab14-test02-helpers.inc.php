<?php

function getGallerySQL() {
   $sql = 'SELECT GalleryID, GalleryName, GalleryNativeName, GalleryCity, GalleryCountry, Latitude, Longitude, GalleryWebSite FROM Galleries';
   $sql .= " ORDER BY GalleryName";
   return $sql;
}

function getPaintingSQL() {
    $sql = "SELECT PaintingID, Paintings.ArtistID AS ArtistID, FirstName, LastName, GalleryID, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, CopyrightText, Description, Excerpt, YearOfWork, Width, Height, Medium, Cost, MSRP, GoogleLink, GoogleDescription, WikiLink FROM Paintings INNER JOIN Artists ON Paintings.ArtistID = Artists.ArtistID  ";
    return $sql;
}

function addSortAndLimit($sqlOld) {
    $sqlNew = $sqlOld . " ORDER BY YearOfWork limit 20";
    return $sqlNew;
}

function makeArtistName($first, $last) {
    return utf8_encode($first . ' ' . $last);
}


/*
  You will likely need to implement functions such as these ...
*/
function getAllGalleries($connection) {
  
}

function getAllPaintings($connection) {
      
}

function getPaintingsByGallery($connection, $gallery) {
     
}

function outputPaintings() {
    try {
    if (isset($_GET['museum']) && $_GET['museum'] > 0) {
    $pdo = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);
   
    $sql = getPaintingSQL().'where GalleryID=' . ":id";
    $sql = addSortAndLimit($sql);
    $result = $pdo->prepare($sql);
    $result -> bindValue(":id", $_GET['museum']);
    $result -> execute();
    
    foreach($result as $row) {
    outputSinglePainting($row);
    }
    $pdo = null;
    } else {
    $pdo = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);
   
    $sql = getPaintingSQL();
    $sql = addSortAndLimit($sql);
    $result = $pdo->prepare($sql);
    $result -> execute();
    foreach($result as $row) {
    outputSinglePainting($row);
    }
    $pdo = null;
    }
    }
    catch (PDOException $e) {
    die( $e->getMessage() );
    } 
}

/*
 Displays a single painting
*/
function outputSinglePainting($row) {
    echo '<li class="item">';
    echo '<a class="ui small image" href="single-painting.php?id='.$row["PaintingID"].'"><img src="images/art/works/square-medium/'.$row["ImageFileName"].'.jpg"></a>';
    echo '<div class="content">';
    echo '<a class="header" href="single-painting.php?id='.$row["PaintingID"].'">'.$row["Title"].'</a>';
    echo '<div class="meta"><span class="cinema">'.$row["FirstName"].' '.$row["LastName"].'</span></div>';
    echo '<div class="description">';
    echo '<p>'.$row["Excerpt"].'</p>';
    echo '</div>';
    echo '<div class="meta">';
    echo '<strong> $'.number_format($row["MSRP"]).'</strong>';   
    echo '</div>';
    echo '</div>';
    echo '</li>';
}



?>