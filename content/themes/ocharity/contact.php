<?php
/*
Template Name: Contact
*/

get_header()
?>
<div class="title">
    <h1 class="h1">Contact</h1>
</div>
<section class="main-activities section">
  <div class="section__container">

    <div class="contact-form">
        <div class="form">
 <!---On appelle le shortcode du plugin de contact Everest Form--->
    <?php echo do_shortcode('[everest_form id="299"]'); ?>
        </div>
     
    </div>
    </div>
    </section>


        
<?php get_footer(); ?>