 <div class="fundraiser-box">
        <a href="#"><img alt="campagne" src="<?php the_post_thumbnail_url(); ?>" height="300" width="350">
        </a>
        <label for="file"></label>
        <progress id="file" max="100" value="70"> 70% </progress>
        <h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p><?php the_content(); ?></p>
        <a href="<?php echo get_permalink(); ?>"class="action-button">Faire un don</a>
      </div>

      
