<?php require_once __DIR__.'/init.php'; ?>



<?php 

if(isset($_POST['submit-new-post'])){
    if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    echo "<p style='color:red;'>Échec de la validation CSRF. Action non autorisée.</p>";
    exit;
    }
    $title=trim($_POST['title']?? ''); 
    $excerpt=trim($_POST['excerpt']??''); 
    $content=trim($_POST['content']?? ''); 
    $published_on= date('Y-m-d H:i:s'); 

    if($title==='' || $content===''){
        echo "<p style='color:red;'>Le titre et le contenu sont obligatoires.</p>";
    }
    
    else {
    try{
        $stmt= $db->prepare("INSERT INTO posts (title, excerpt, content, published_on) VALUES(?,?,?,?)"); 
        $stmt->execute([$title, $excerpt, $content, $published_on]);
        $new_id=$db->lastInsertID(); 
        $title=$excerpt=$content=' '; 
        header("Location: index.php?created=1"); 
        exit;
        
    }catch(PDOException $e){
        echo "<p style='color:red;'>Erreur lors de l'insertion : " . $e->getMessage() . "</p>";
    }
     
}
}
require_once __DIR__.'/templates/header.php';



?>

<form action="" method="post">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
    <label for="title">Titulo (requerido)</label>
    <input type="text" name="title" id="title" value="<?= htmlspecialchars($title??'') ;?>" required>
                                                                           

    <label for="excerpt">Extracto</label>
    <input type="text" name="excerpt" id="excerpt" value="<?= htmlspecialchars($excerpt??'') ;?>">

    <label for="content">Contenido (requerido)</label>
    <textarea name="content" id="content" cols="30" rows="30" required><?= htmlspecialchars($content??'') ;?></textarea>

    <p>
    <input type="submit" name="submit-new-post" value="Nuevo Post">
    </p>
</form>

<?php require_once __DIR__.'/templates/footer.php'; ?>

