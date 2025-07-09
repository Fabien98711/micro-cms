<?php require_once __DIR__.'/init.php' ; 
                             
?>
<?php require_once __DIR__.'/inc/posts.php'; ?>



<?php require_once __DIR__.'/templates/header.php'; ?>

<?php if (isset($_GET['created'])): ?>
    <div class="success">✅ El post ha sido creado</div>
<?php elseif (isset($_GET['deleted'])): ?>
    <div class="success">🗑️ El post ha sido eliminado</div>
<?php endif; ?>

<?php $posts= render_posts(); 	?>

	<?php require_once __DIR__.'/templates/footer.php'; ?>	


