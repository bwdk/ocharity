<?php
/*
Template Name: 404
*/

get_header()
?>
<!---Contenut de la page 404--->
<div class="error">
    <div class="error__content">
        <div class="sub-title">
            OOPS ! 
        </div>
        <div class="content">
        <p> Le contenu que vous recherchez est introuvable ou a été déplacé !</p>
        </div>
    </div>
    <div class="error__img"><img src="<?php the_field('img-404');?>" width="400" alt="">
    </div>
</div>

</div>


<?php get_footer(); ?>
