<?php
require_once __DIR__ . '/../init.php';?>



<?php if(isset ($_POST['modify-post'])){
    if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || $_POST['csrf_token']!== $_SESSION['csrf_token'] ){
        echo "<p style='color:red;'>Échec de la validation CSRF. Action non autorisée.</p>";
    exit;
    }
    try{
        $stmt=$db->prepare ("SELECT * FROM posts WHERE id=?"); 
        $stmt->execute ([$_POST['post_id']]); 
        $post=$stmt->fetch(); 
    }
    catch(PDOException $e){
        echo "<p style='color:red;'>Erreur lors de la modification : " . $e->getMessage() . "</p>";
    }
    
    $title =$post['title']; 
    $excerpt =$post['excerpt']; 
    $content =$post['content']; 
    $date=$post['published_on']; 

}
?>

<form action="modify-posts.php" method="post" >
    <input type="hidden" name="csrf_token" value= "<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
    <input type="hidden" name="post_id" value= "<?php echo $post['id']; ?>">

    <label for="title">Titulo (requerido)</label>
    <input type="text" name="title" id="title" value="<?= htmlspecialchars($title??'') ;?>" required>
                                                                           

    <label for="excerpt">Extracto</label>
    <input type="text" name="excerpt" id="excerpt" value="<?= htmlspecialchars($excerpt??'') ;?>">

    <label for="content">Contenido (requerido)</label>
    <textarea name="content" id="content" cols="30" rows="30" required><?= htmlspecialchars($content??'') ;?></textarea>

    <p>
    <input type="submit" name="edit-posts" value="Nuevo Post">
    </p>

</form>
