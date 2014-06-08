<?php
    session_start();
    include_once "classes\data.php";
    include_once "classes\db.php";
    include_once "classes\user.php";
    
    $isPostSelected = false;
    $isExploreSelected = false;
    $isExploreSubjectSelected = false;
    $isSearchSelected = false;
    
    if(!empty($_GET["postID"]) && empty($_GET["subject_id"])){
    $isPostSelected = true;
    $cleanPostId = htmlspecialchars(filter_input(INPUT_GET, "postID", FILTER_VALIDATE_INT));
    $cleanTitle = getTitleContentU_IDById($cleanPostId)["TITLE"];
    $cleanContent = getTitleContentU_IDById($cleanPostId)["POST"];  
    $cleanUID = getTitleContentU_IDById($cleanPostId)["U_ID"];
    }
    else if((!empty($_GET["subject_id"]) && empty($_GET["postID"])) || isset($_GET["subject_id"])){
        $isExploreSubjectSelected = true;
        $cleanSubject_id = htmlspecialchars(filter_input(INPUT_GET, "subject_id", FILTER_VALIDATE_INT));
    }
    else if(!isset($_GET["subject_id"]) && !isset($_GET["postID"]) && isset($_GET["search"])){
        $isSearchSelected = true;
        $cleanSearch = htmlspecialchars(filter_input(INPUT_GET, "search"));
    }
    else{
        $isExploreSelected = true;
    }
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>SchoolHARD -HOMEPAGE-</title>
        <link type="text/css" rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="http://i.imgur.com/RiVU41l.png"> <!--
        Credits to Martz90
        http://www.iconarchive.com/show/circle-icons-by-martz90/books-icon.html
        Distributed under CC's license 
        http://creativecommons.org/licenses/by-nc-nd/3.0/
        -->
    </head>
    
    <body>
        <header>
            <nav id="topbar">
                <a href="index.php"><p>Home</p></a>
                <a href="reader.php"><p>Read</p></a>
                <a href="register.php"><p>Login/Register</p></a>
                <?php 
                    if(isset($_SESSION["validated"]))
                    {
                        echo "<h6 id=\"username\">Welcome ".getUserById($_SESSION["U_ID"])." </h6>";
                        echo "<a id=\"post_Box\"href=\"post.php\"><p>Post</p></a>";
                        echo "<a id=\"logout_Box\"href=\"logout.php\"><p>Logout</p></a>";
                    }
                ?>
            </nav>
        </header>
        
        <?php 
            echo "\t".file_get_contents(getcwd()."\lazy\\search.html");
        ?>
        
    <?php
        if($isPostSelected){
        echo "<div id=\"post_read\">";
        echo "<h1>".$cleanTitle."</h1>\n";
        echo "\nSubmitted by: ".getUserById($cleanUID);
        echo "<p>".$cleanContent."</p>";
        echo "</div>\n";
        }
        elseif($isExploreSubjectSelected){
            
            echo "<div id=\"subject_chooseText\">";
            
            $TWODArray = getTextTitleBySubject_ID($cleanSubject_id);
                for($i = 0; $i < count($TWODArray); $i++){
                    echo "<a href=\"reader.php?postID=".$TWODArray[$i]["ID"]."\">".$TWODArray[$i]["TITLE"]."</a>";
                    echo " Submitted by: ".getUserById($TWODArray[$i]["U_ID"])."</br>";
                }
            echo "</div>\n";
        }
        elseif($isSearchSelected){
            echo "<div id=\"search_results\">";
            if(!empty($cleanSearch)){
                $TWODArray = searchPost($cleanSearch);
                if(empty($TWODArray[0]["TITLE"]))
                {
                    echo "Your search came out empty. Try again.";
                }
                else{
                    echo "The following search term (".$cleanSearch.") gave these results:</br>";

                    for($i = 0; $i < count($TWODArray); $i++){
                        echo "<a href=\"reader.php?postID=".$TWODArray[$i]["ID"]."\">".$TWODArray[$i]["TITLE"]."</a>";
                        echo " Submitted by: ".getUserById($TWODArray[$i]["U_ID"])."</br>";
                    }
                }
            }
            else{
                echo "You did not type in any search term.";
            }
            echo "</div>";
        }
        elseif($isExploreSelected){
                echo "<div id=\"explore_subjects\">";
                echo "<p>Pick one subject to explore:</p>";
                $i = 0;
                foreach(getSubjectNames() as $subject_name){
                    echo "<a href=\"reader.php?subject_id=".$i."\">".$subject_name."</a></br>";
                    $i++;
                }
            echo "</div>";
            }
    ?>
    </body>
</html>