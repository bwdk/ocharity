<div class="card">
  <a href="<?php the_permalink() ?>"><img src="<?php the_post_thumbnail_url(); ?>" alt="" class="card__img"></a>
  <div class="card__info">
    <h1 class="card__title"><?php the_title(); ?></h1>
    <a href="<?php the_permalink() ?>" class="action-button">Voir le projet</a>
  </div>
</div>