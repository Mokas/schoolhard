<?php
    session_start();
    include_once "classes\data.php";
    include_once "classes\db.php";
    include_once "classes\user.php";
    $isPostSelected = false;
    $isExploreSelected = false;
    $isExploreSubjectSelected = false;
    
    if(!empty($_GET["postID"]) && empty($_GET["subject_id"])){
    $isPostSelected = true;
    $cleanPostId = htmlspecialchars(filter_input(INPUT_GET, "postID", FILTER_VALIDATE_INT));
    $cleanTitle = getTitleContentU_IDById($cleanPostId)["TITLE"];
    $cleanContent = getTitleContentU_IDById($cleanPostId)["POST"];  
    $cleanUID = getTitleContentU_IDById($cleanPostId)["U_ID"];
    }
    else if(empty($_GET["postID"]) && empty($_GET["subject_id"])){
        $isExploreSelected = true;
    }
    else if(!empty($_GET["subject_id"])&& empty($_GET["postID"])){
        $isExploreSubjectSelected = true;
        $cleanSubject_id = htmlspecialchars(filter_input(INPUT_GET, "subject_id", FILTER_VALIDATE_INT));
        $arrayOfTitleAndU_ID = getTextsBySubject_ID($cleanSubject_id);
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>SchoolHARD -READER-</title>
        <link type="text/css" rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="http://i.imgur.com/RiVU41l.png"> <!--
        Credits to Martz90
        http://www.iconarchive.com/show/circle-icons-by-martz90/books-icon.html
        Distributed under CC's license 
        http://creativecommons.org/licenses/by-nc-nd/3.0/
        -->
    </head>
    <body>
        <?php
        if($isPostSelected){
        echo "<div id=\"post_read\">";
        echo "<h1>".$cleanTitle."</h1>\n";
        echo "\nSubmitted by: ".getUserById($cleanUID);
        echo "<p>".$cleanContent."</p>";
        echo "</div>\n";
        }else if($isExploreSelected){
                echo "<div id=\"explore_subjects\">";
                echo "<p>Pick one subject to explore:</p>";
                $i = 1;
                foreach(getSubjectNames() as $subject_name){
                    echo "<a href=\"reader.php?subjectId=".$i."\">".$subject_name."</a></br>";
                    $i++;
                }
                echo "</div>";
            }
        else if($isExploreSubjectSelected){
            echo "<div id=\"subject_chooseText\">";
            echo "<a>".$arrayOfTitleAndU_ID["TITLE"]."</a>";
            echo " Submitted by: ".getUserById($arrayOfTitleAndU_ID["TITLE")."</br>";
            echo "<p>".$cleanContent."</p>";
            echo "</div>\n";
        }
        ?>
    </body>
</html>