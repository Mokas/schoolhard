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

//Returns an array of title AND U_ID that exist in the database.
function getTextsBySubject_ID($cleanSubjectID){
    global $PDO;
    
    $stmnt = $PDO->prepare("SELECT title, U_ID FROM summaries WHERE subject_id=:cleanSubjectID");
    $stmnt->bindParam(":cleanSubjectID", $cleanSubjectID);
    $stmnt->execute();
    $returnedObject = $stmnt->fetch();
    $arrayOfTitleAndU_ID = array();
    $arrayOfTitleAndU_ID["TITLE"] = $returnedObject["title"];
    $arrayOfTitleAndU_ID["U_ID"] = $returnedObject["U_ID"];
    return $arrayOfTitleAndU_ID;
}