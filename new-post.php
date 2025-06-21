<?php require_once __DIR__.'/init.php'; ?>
<?php require_once __DIR__.'/templates/header.php' ?>
<form action="" method="post">
    <label for="title">Titulo (requerido)</label>
    <input type="text" name="title" id="title" value="<?= htmlspecialchars($_POST['title']??'') ;?>" required>
                                                                           

    <label for="excerpt">Extracto</label>
    <input type="text" name="excerpt" id="excerpt" value="<?= htmlspecialchars($_POST['excerpt']??'') ;?>">

    <label for="content">Contenido (requerido)</label>
    <textarea name="content" id="content" cols="30" rows="30" <?= htmlspecialchars($_POST['content']??'') ;?>required></textarea>

    <p>
     
    <input type="submit" name="submit-new-post" value="Nuevo Post">

    </p>
</form>

<?php require_once __DIR__.'/templates/footer.php'; ?>

