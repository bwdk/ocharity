<?php get_header(); ?>



<main class="main">

  <div class="slider">

    <div class="slideshow-container">

      <div class="mySlides fade">

        <img src="images/img1.jpg" style="width:100%">

          <div class="slider-text">
            <h2>Lorem ipsum</h2>
            <p>Lorem ipsum dolor sit amet, alesegur critanis</p>
            <button class="sliderbtn">Faire Un don</button>
          </div>

      </div>

      <div class="mySlides fade">

        <img src="images/img2.jpg" style="width:100%">

          <div class="slider-text">
            <h2>Lorem ipsum</h2>
            <p>Lorem ipsum dolor sit amet, alesegur critanis</p>
            <button class="sliderbtn">Faire Un don</button>
          </div>

      </div>

      <div class="mySlides fade">

        <img src="images/img3.jpg" style="width:100%">

          <div class="slider-text">
            <h2>Lorem ipsum</h2>
            <p>Lorem ipsum dolor sit amet, alesegur critanis</p>
            <button class="sliderbtn">Faire Un don</button>
          </div>

      </div>

        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

    </div>
        <!-- The dots/circles -->
        <div class="dots" style="text-align:center">
          <span class="dot" onclick="currentSlide(1)"></span>
          <span class="dot" onclick="currentSlide(2)"></span>
          <span class="dot" onclick="currentSlide(3)"></span>
        </div>
  </div>

  <!-- slider end -->

  <section class="main-activities section">
    <div class="section__container">
      <p>Lorem ipsum</p>
      <h2>Lorem ipsum dolor sit amet</h2>
      <div class="activities-box">
        <div class="content">
          <span class="content--icon"><img src="<?php the_field('icone_1'); ?>" alt=""></span>
          <h3><?php the_field('nom_1'); ?></h3>
          <p><?php the_field('resume_1'); ?></p>
        </div>
        <div class="content">
          <span class="content--icon"><img src="<?php the_field('icone_2'); ?>" alt=""></span>
          <h3><?php the_field('nom_2'); ?></h3>
          <p><?php the_field('resume_2'); ?></p>
        </div>
        <div class="content">
          <span class="content--icon"><img src="<?php the_field('icone_3'); ?>" alt=""></span>
          <h3><?php the_field('nom_3'); ?></h3>
          <p><?php the_field('resume_3'); ?></p>
        </div>
        <div class="content">
          <span class="content--icon"><img src="<?php the_field('icone_4'); ?>" alt=""></span>
          <h3><?php the_field('nom_4'); ?></h3>
          <p><?php the_field('resume_4'); ?> </p>
        </div>
      </div>
    </div>
  </section>

  <section class="countries">
    <p>Lorem ipsum</p>
    <h2>Lorem ipsum dolor sit amet</h2>  
    <div class="countries-map">
      <img alt="campagne" src="images/world-map.jpg" style="width:100%;">
    </div>     
  </section>

  <section class="about-counter" >
  </section>

  <section class="main-collect">
        <p>Lorem ipsum ?</p>
        <h2>Lorem ipsum dolor sit amet</h2>

        <div class="activities-boxes">
          <div class="fundraiser-box">
            <a href="#"><img alt="campagne" src="http://source.unsplash.com/360x225/?children">
            </a>
            <label for="file"></label>
            <progress id="file" max="100" value="70"> 70% </progress>
            <h3><a href="url">Lorem ipsum dolor sit amet</a></h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, vero! Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <a href="" class="action-button">Faire un don</a>
          </div>

          <div class="fundraiser-box">
            <a href="#"><img alt="campagne" src="http://source.unsplash.com/360x225/?children">
            </a>
            <label for="file"></label>
            <progress id="file" max="100" value="70"> 70% </progress>
            <h3><a href="url">Lorem ipsum dolor sit amet</a></h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, vero! Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <a href="" class="action-button">Faire un don</a>
          </div>

          <div class="fundraiser-box">
            <a href="#"><img alt="campagne" src="http://source.unsplash.com/360x225/?children">
            </a>
            <label for="file"></label>
            <progress id="file" max="100" value="70"> 70% </progress>
            <h3><a href="url">Lorem ipsum dolor sit amet</a></h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, vero! Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <a href="" class="action-button">Faire un don</a>
          </div>

        </div>
        <!-- box div end -->
  </section>

  <section class="main-gallery-section">

        <div class="gallery-grid">
          <div class="video-content">

            <h5>Lorem ipsum</h5>
            <h2>Lorem ipsum dolor sit amet</h2>

            <div class="text-box">
              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. </br>
                Quis voluptates eligendi reprehenderit suscipit
                sint impedit ex quisquam explicabo.</br>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. </br> Incidunt tempore neque est adipisci dolore
                unde eveniet natus quae nemo </br> nobis voluptas, sapiente reprehenderit maxime voluptatibus modi tempora
                quas sed perferendis?</br>
            </div>

            <a href="" class="action-button">Faire un don</a>
          </div>

          <div class="about-img">
            <img src="https://source.unsplash.com/590x360/?children,happy" alt="">
          </div>

        </div>


  </section>

  <section class="main-newsletter">
    <div class="section__container">
      <h2>Inscrivez-vous à notre newsletter</h2>

        <div class="newsletter">
          <form action="">
            <div class="form-grid">
              <div>
                <label for=""></label>
                <input type="email" placeholder="Entrez votre email">
              </div>
              <!-- input field end -->
              <div>
                <button type="submit" class="submit-btn">S'inscrire</button>
              </div>
              <!-- button end -->
            </div>
            <!-- form  grid end -->
          </form>
        </div>
      <!-- newsletter end -->
    </div>
        <!-- section container end -->
  </section>

  </main>


<?php get_footer(); ?>