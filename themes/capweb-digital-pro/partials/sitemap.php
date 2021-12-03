<h1>Stay clam. I couldn't find that page.<br/>Here's a list of what we do have.</h1>
<h3>If you don't see your page in this list, there is search form at the bottom.<br> That may help.</h3>

<div class="archive-page">
    <br><h2 id="pages">Pages:</h2>
	<!-- <ul> -->
 <!-- Add pages you'd like to exclude in the exclude here -->
	<!-- 	<?php wp_list_pages( array( 'exclude' => '', 'title_li' => '', ) ); ?> -->
	<!-- </ul> -->

<!-- Arrange the list of page in two colums. Use Genesis column classes for styling -->
<?php
  $pageArray = explode("</li>",wp_list_pages('exclude=&title_li=&echo=0&depth=1'));
  $pageCount = count($pageArray) - 1;
  $pageColumns = round($pageCount / 2);

  for ($i=0;$i<$pageCount;$i++) {
  if ($i<$pageColumns){
    $pageLeft = $pageLeft.''.$pageArray[$i].'</li>';
           }
  elseif ($i>=$pageColumns){
    $pageRight = $pageRight.''.$pageArray[$i].'</li>';
    }
  };
 ?>

 <ul class="one-half first">
       <?php echo $pageLeft; ?>
 </ul>
 <ul class="one-half">
       <?php echo $pageRight; ?>
 </ul>


&nbsp;<br><br><h2 id="authors">Authors</h2>
	<ul>
		<?php wp_list_authors( array( 'optioncount' => true ) ); ?>
	</ul>

<!--
	<ul>
	<?php
	// This part prints out your custom post types
		foreach( get_post_types( array('public' => true) ) as $post_type ) {
		  if ( in_array( $post_type, array('post','page','attachment') ) )
			continue;

		  $pt = get_post_type_object( $post_type );

		  echo '<h2>'.$pt->labels->name.'</h2>';
		  echo '<ul>';

		  query_posts('post_type='.$post_type.'&posts_per_page=-1');
		  while( have_posts() ) {
			the_post();
			echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
		  }

		  echo '</ul>';
		}
	?>
	</ul>
-->
</div>

<div class="archive-page">
	<br><hr><h2 id="posts">Posts by Topic:</h2>
	<ul>
	<?php
		// Add categories you'd like to exclude in the exclude here
		$cats = get_categories('exclude=');
		foreach ($cats as $cat) {
		  echo "<br><li><h4>".$cat->cat_name."</h4>";
		  echo "<ul>";
		  query_posts('posts_per_page=-1&cat='.$cat->cat_ID);
		  while(have_posts()) {
			the_post();
			$category = get_the_category();
			// Only display a post link once, even if it's in multiple categories
			if ($category[0]->cat_ID == $cat->cat_ID) {
			  echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
			}
		  }
		  echo "</ul>";
		  echo "</li>";
		}
	?>
	</ul>
</div>
