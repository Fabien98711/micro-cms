<?php
require_once __DIR__ . '/../init.php';?>
<div>vous êtes ici</div>
<?php echo $_POST['post_id']; ?>



<?php if(isset($_POST['delete-post'])){
    if(!(isset($_POST['csrf_token'], $_SESSION['csrf_token']))|| $_POST['csrf_token']!==$_SESSION['csrf_token']){
        echo "<p style='color:red;'>Échec de la validation CSRF. Action non autorisée.</p>";
    exit;
    }

    try{
        $stmt=$db->prepare("DELETE FROM posts WHERE id =?"); 
        $stmt->execute([$_POST['post_id']]); 
        header("Location: ../index.php?deleted=1"); 
        exit;
        
    }
    catch(PDOException $e){
        echo "<p style='color:red;'>Erreur lors de la suppression : " . $e->getMessage() . "</p>";
    }

}
    
?>

