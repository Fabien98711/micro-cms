<?php



function get_all_posts(){
   return [
        [
            'id' => 1,
            'title' => 'Lorem ipsum dolor sit amet',
            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vitae pulvinar turpis',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vitae pulvinar turpis. Nam ut arcu tellus. Morbi sit amet elit lacinia, tincidunt leo a, posuere mi. Mauris nec odio at quam lacinia consequat. Fusce mattis orci ex, eget accumsan neque vehicula et. Vivamus consectetur tempor lacus, in tincidunt massa rutrum ut. Pellentesque augue felis, iaculis eu interdum et, semper eu purus. Vestibulum a viverra justo.',
            'published_on' => date('y - m - d'),
        ],
        [
            'id' => 2,
            'title' => 'Nunc eget enim vulputate',
            'excerpt' => 'Integer placerat hendrerit pharetra. Nunc eget enim vulputate, efficitur dolor pretium',
            'content' => 'Integer placerat hendrerit pharetra. Nunc eget enim vulputate, efficitur dolor pretium, pharetra nulla. Proin mattis aliquam sem. Morbi vel mi ac magna consequat tempus vitae eget diam. Aliquam ac sapien a tortor rutrum faucibus nec nec urna. Ut et nisl magna. Vivamus elit risus, rhoncus vitae elit suscipit, porta pulvinar justo. Aliquam sodales urna eu scelerisque ultrices. Fusce et neque id risus gravida vestibulum a et urna. Curabitur aliquam accumsan leo, pharetra tempus velit condimentum et. Donec dapibus faucibus lorem a tincidunt. Donec ultricies id metus et aliquam. Vestibulum dapibus magna nec elit ultrices, ornare pretium nisi dictum.',
            'published_on' => '2018-01-11 10:15:00',
        ],
    ];
};?>

<?php function render_posts(){ 

    global $host, $user, $password, $database,$port, $db, $csrf_token; 
    
    
    
    
    ?>
    <div class="posts">
		
			<?php 
            
            
            if (isset($_GET['view'])&& ctype_digit($_GET['view'])):
            $id = (int)$_GET['view'];  
            $stmt = $db->prepare("SELECT * FROM posts WHERE id= ?" );
            $stmt->execute([$id]); 
            $all_posts=$stmt->fetchAll();    
						foreach( $all_posts as $post):
							if ($id===(int)$post['id']):?>
                                <article class="post">
								    <h2 class='post-title'><?=htmlspecialchars($post['title']) ; ?></h2>
								    <p class ='post-content'><?=htmlspecialchars($post['content']); ?></p> 
                                </article>
		    				<?php endif; 
						endforeach ; 

				else:
                    $stmt = $db->prepare("SELECT * FROM posts"); 
                    $stmt->execute(); 
                    $all_posts=$stmt->fetchAll(); 
                    foreach($all_posts as $article):?>
                    <article class="post" >
					<a href="?view=<?php echo $article['id'] ; ?>"><h2 class='post-title'><?=$article['title'] ; ?></h2></a>
					<p class='post-content'><?=$article ['excerpt']; ?></p>
                    <form action="inc/delete-posts.php" method="post" onsubmit="return confirm ('Voulez-vous vraiment supprimer cet article?'); ">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
                        <input type="hidden" name="post_id" value="<?php echo $article['id']; ?>">
                        <input type="submit" name="delete-post" value="supprimer" style="red">
                    </form> 
                    </article>
                    
		         	<?php endforeach ; 
			endif;  ?>
		
	</div>
<?php } ?>