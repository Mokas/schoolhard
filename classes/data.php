<?php
//HANDLES DATA, no login/logout. Pure data.

include_once "classes\db.php";
$PDO = get_PDO();

//Returns TRUE if another subject with the same name exists
function doesSubjectExist($cleanSubjectName){
    global $PDO;
    
    try{$stmnt = $PDO->prepare("select COUNT(id) from subjects where SUBJECT_NAME=:subject_name");
    
    $stmnt->bindParam(":subject_name", $cleanSubjectName);
    $stmnt->execute();
    $result = $stmnt->fetchColumn();
        if($result==0){
            return false;
        }  else {
            return true;
        }
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
}

//Remember to filter the variable
function addSubjectAndDesc($U_IDofSubmiter, $cleanSubjectName, $cleanSubjectDescription, $ip_address){
    global $PDO;
    
    try{$stmnt = $PDO->prepare("insert into subjects (U_ID ,SUBJECT_NAME,description, ip_address) values (:U_ID, :subject_name, :description, :ip_address)");
    
    $stmnt->bindParam(":U_ID", $U_IDofSubmiter);
    $stmnt->bindParam(":subject_name", $cleanSubjectName);
    $stmnt->bindParam(":description", $cleanSubjectDescription);
    $stmnt->bindParam(":ip_address", $ip_address);
    
    
    $stmnt->execute();
    return true;
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
        return false;
    }
}


//Returns an array of subject names that exist in the database.
function getSubjectNames(){
    global $PDO;
    
    $stmnt = $PDO->prepare("SELECT SUBJECT_NAME from subjects");
    $stmnt->execute();
    $returnedObject = $stmnt->fetchAll(PDO::FETCH_ASSOC);
    $arrayOfSubjects = array();
    $i = 0;
    foreach($returnedObject as $subjectName){
        $arrayOfSubjects[$i] = $subjectName["SUBJECT_NAME"];
        $i++;
    }
    return $arrayOfSubjects;
}

//Returns TRUE if another post with the same name exists
function doesPostExist($cleanTitle){
    global $PDO;
    
    try{$stmnt = $PDO->prepare("select COUNT(id) from summaries where title=:title");
    
    $stmnt->bindParam(":title", $cleanTitle);
    $stmnt->execute();
    $result = $stmnt->fetchColumn();
        if($result==0){
            return false;
        }  else {
            return true;
        }
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
}

function addTitleAndContent($cleanTitle, $cleanContent, $cleanSubject_id, $U_ID, $ip_address){
    global $PDO;
    
    try{$stmnt = $PDO->prepare("insert into summaries (title, content, subject_id, U_ID,ip_address) values (:title, :content, :subject_id, :U_ID, :ip_address)");
    

    $stmnt->bindParam(":title", $cleanTitle);
    $stmnt->bindParam(":content", $cleanContent);
    $stmnt->bindParam(":subject_id", $cleanSubject_id);
    $stmnt->bindParam(":U_ID", $U_ID);
    $stmnt->bindParam(":ip_address", $ip_address);
    
    
    $stmnt->execute();
    return true;
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
        return false;
    }
}

//Returns an array of post, title AND U_ID that exist in the database.
function getTitleContentU_IDById($cleanId){
    global $PDO;
    
    $stmnt = $PDO->prepare("SELECT title, content, U_ID FROM summaries WHERE id=:cleanID");
    $stmnt->bindParam(":cleanID", $cleanId);
    $stmnt->execute();
    $returnedObject = $stmnt->fetch();
    $arrayOfTitleAndPost = array();
    $arrayOfTitleAndPost["TITLE"] = $returnedObject["title"];
    $arrayOfTitleAndPost["POST"] = $returnedObject["content"];
    $arrayOfTitleAndPost["U_ID"] = $returnedObject["U_ID"];
    return $arrayOfTitleAndPost;
}

//Returns an two dimensional array that include title AND U_ID that exist in the database.
function getTextTitleBySubject_ID($cleanSubjectID){
    global $PDO;
    
    $stmnt = $PDO->prepare("SELECT id, title, U_ID FROM summaries WHERE subject_id=:cleanSubjectID");
    $stmnt->bindParam(":cleanSubjectID", $cleanSubjectID);
    $stmnt->execute();
    $i = 0;
    $TwoDarrayOfTitleAndU_ID[] = array();
    while($arrayOneDArray = $stmnt->fetch()){
        $TwoDarrayOfTitleAndU_ID[$i]["ID"] = $arrayOneDArray["id"];
        $TwoDarrayOfTitleAndU_ID[$i]["TITLE"] = $arrayOneDArray["title"];
        $TwoDarrayOfTitleAndU_ID[$i]["U_ID"] = $arrayOneDArray["U_ID"];
        
        $i++;
    }
    return $TwoDarrayOfTitleAndU_ID;
}

//Returns 2D Array containing POST, TITLE, UID from summaries tha include the search query
function searchPost($cleanSearchTerm){
    global $PDO;
    
    $stmnt = $PDO->prepare("SELECT id, title, subject_id, U_ID from summaries WHERE INSTR(content, :searchTerm)");
    $stmnt->bindParam(":searchTerm", $cleanSearchTerm);
    $stmnt->execute();
    $i = 0;
    $TwoDarray[] = array();
    while($arrayOneDArray = $stmnt->fetch()){
        $TwoDarray[$i]["ID"] = $arrayOneDArray["id"];
        $TwoDarray[$i]["TITLE"] = $arrayOneDArray["title"];
        $TwoDarray[$i]["SUBJECT_ID"] = $arrayOneDArray["subject_id"];
        $TwoDarray[$i]["U_ID"] = $arrayOneDArray["U_ID"];
        $i++;
    }
    if(!empty($TwoDarray)){
    return $TwoDarray;
    }  else {
    return false;
    }
}