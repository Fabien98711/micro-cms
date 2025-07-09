<?php
require_once __DIR__ . '/../init.php';?>




<?php if(isset($_POST['edit-posts'])){
    
    if(!(isset($_POST['csrf_token'], $_SESSION['csrf_token']))|| $_POST['csrf_token']!==$_SESSION['csrf_token']){
        echo "<p style='color:red;'>Échec de la validation CSRF. Action non autorisée.</p>";
    exit;
    }
    try{
        $stmt=$db->prepare ("UPDATE posts SET title=?, excerpt=?, content=?, published_on=? WHERE id=? ");
        $stmt->execute([$_POST['title'],
                        $_POST['excerpt'],
                        $_POST['content'],
                        date('Y-m-d H:i:s'),
                        $_POST['post_id']] 
                     
    );  
        header("Location: ../index.php?modified=1"); 
        exit;
    }
    catch(PDOException $e){
        echo "<p style='color:red;'>Erreur lors de la modification : " . $e->getMessage() . "</p>";
    }
}