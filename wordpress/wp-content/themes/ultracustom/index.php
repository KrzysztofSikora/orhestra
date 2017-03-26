<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ultrabootstrap
 */

get_header(); ?>
    <!-- Header Image -->
<?php if (has_header_image()): ?>

    <!--    custom buttom and text-->
    <div class="container custom-header custom-font">
        <div class="row">
            <div data-aos="zoom-in" class="col-md-12 text-center custom-font lead">
                <h1>KRZYSZTOF SIKORA</h1>
                <h3 class="hidden-xs">SOFTWARE | SPORT | PASJA</h3>
            </div>
        </div>
        <div class="row">
            <div data-aos="zoom-in" class="col-md-12 text-center">
                <a href="#skills" class="page-scroll btn btn-primary btn-lg btn-color" role="button" aria-disabled="true">UMIEJĘTNOŚCI</a>
                <a href="#contact" class="page-scroll btn btn-primary btn-lg btn-color"
                   role="button"
                   aria-disabled="true">KONTAKT</a>
            </div>
        </div>


    </div>


    <!--    !custom buttom and text-->
    <div class="text-center">
        <img class="image-full-width" src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>"
             width="<?php echo get_custom_header()->width; ?>" alt=""/>
    </div>
<?php endif; ?>
    <!-- Header Image -->


    <!--first section about-->
    <div id="about" class="container-fluid background-color-white min-height-300 padding-top-65 custom-font">
        <div class="row">
            <div class="col-md-12"><h1 class="text-center"><strong>O MNIE</strong></h1></div>

        </div>
        <div class="row">
            <div class="col-md-3">

            </div>
            <div data-aos="fade-right" class="col-md-6"><p class="text-justify lead padding-top-20 padding-bottom-50">

                    Ukończyłem <strong>Wyższą Szkołę Zarządzania i Bankowości
                        w
                        Krakowie</strong> uzyskując tytuł inżyniera.
                    Specjalizuję się w aplikacjach internetowych. Swoją pasję do programowania odkryłem jednak już w
                    technikum. Potrafiłem godzinami przesiadywać przed komputerem, by poszerzajać swoją wiedzę
                    eksplorując
                    fora dyskusyjne. Tworzenie aplikacji to kreowanie nowego świata a każdy problem to nowe wyzwanie.
                    Na codzień pracuje w jednym z krakowskich Software Housów. Bardzo ważną
                    rolę w moim życiu odgrywa sport.
                    Na tym polu także podejmuję wyzwania. Im najbardziej szalone tym bardziej mnie fascynują. Zdobyłem
                    <strong>Koronę Maratonów Polskich</strong>, brałem udział w ekstremalnych przejazdach rowerowych.
                    Najpierw z <strong>Gdyni do
                        Krakowa</strong> w 42 godziny i 42 minuty potem w 10 dni z <strong>Krakowa do Paryża</strong>.
                    W 2017 roku podjąłem się studiów magisterskich z zarządzania.
                </p>
            </div>
            <div class="col-md-3"></div>


        </div>

    </div >


    <!--!first section about-->
    <div id="news" class="container-fluid padding-top-65 font-color-white custom-font ">
        <div class="row" >
            <div class="col-md-12"><h1 class="text-center"><strong>NEWS</strong></h1></div>
        </div>

    </div>

    <div class="spacer">
        <div  id="primary" class="content-area">
            <main id="main" class="site-main" role="main">

                <?php if (have_posts()) : ?>

                <?php if (is_home() && !is_front_page()) : ?>
                    <header>
                        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                    </header>
                <?php endif; ?>
                <div class="container">
                    <div class="row post-list">
                        <?php /* Start the Loop */ ?>
                        <?php while (have_posts()) : the_post(); ?>

                            <?php

                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part('template-parts/content', get_post_format());
                            ?>

                        <?php endwhile; ?>

                        <?php the_posts_navigation(); ?>

                        <?php else : ?>

                            <?php get_template_part('template-parts/content', 'none'); ?>

                        <?php endif; ?>
                    </div>
                </div>
            </main><!-- #main -->
        </div><!-- #primary -->
    </div>
    <!--second section about skills-->

    <div id ="skills" class="container-fluid background-color-white min-height-300 padding-top-65 custom-font">
        <div class="row">
            <div class="col-md-12"><h1 class="text-center"><strong>UMIEJĘTNOŚCI</strong></h1></div>

        </div>
        <div class="row padding-top-30">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div data-aos="zoom-out-right" class="col-md-8 text-center"><h4><strong>BACKEND</strong></h4>
                        <p class="text-justify padding-bottom-50 lead">
                            Moje zaintersowania i umiejętności skupiają się na aplikacjach webowych. Do ulubionych
                            języków programowania należą JavaScript i PHP.
                            Posiadam umiejętności potrzebne do implementacji częsci serwerowej aplikacji.
                            Moje ulubione frameworki to <strong>Loopback - Node.js </strong> przeznaczony do budowy API
                            a także <strong>Symfony 2</strong>. Rozwijam swoje kompetencje także w wdrażaniu <strong>CMS
                                - Wordpress</strong>.</p>
                    </div>

                </div>


            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div data-aos="zoom-out-right" class="col-md-8 text-center"><h4><strong>FRONTEND</strong></h4>
                        <p class="text-justify padding-bottom-50 lead">
                            W swoim rozwoju zawodowym kładę nacisk na aplikacje typu <strong>Single Page
                                Aplication</strong>.
                            W tym zakresie posiadam umiejętności implementacji części klienckiej w frameworku <strong>Backbone.js
                                - Marionette.js</strong> jak i pokrewne.
                            Znam także bibliotekę <strong>jQuery</strong>. Warstwę prezentacji danych opieram o
                            framework <strong>Bootstrap</strong>.

                        </p>
                        <div class="progress" id="progress-bar" ></div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
    </div>

    <!--!second section about skills-->


    <!--third section about experience-->

    <div class="pv-container min-height-300">
        <div class="pv-block" pv-speed=-2
             pv-image="http://krzysztofsikora.pl/wordpress/wp-content/themes/bootstrap-my/images/black.jpg"></div>
    </div>


    <!--!third section about experience-->


    <!--fourth section about skills-->
    <div id="achivments" class="container-fluid background-color-white min-height-300 padding-top-65 custom-font">
        <div class="row">
            <div class="col-md-12"><h1 class="text-center"><strong>OSIĄGNIĘCIA</strong></h1></div>

        </div>
        <div class="row padding-top-30">
            <div class="col-md-3"></div>
            <!--test-->
            <div data-aos="fade-up" class="col-md-6 text-center">
                <h4><strong>BIEGANIE</strong></h4>


                <p class="text-center lead padding-bottom-50">
                    18 maja 2014 - <strong>Cracovia Maraton</strong><br/>
                    12 października 2014 - <strong>Poznań Maraton</strong><br/>
                    27 września 2015 - <strong>Maraton Warszawski</strong><br/>
                    3 kwietnia 2015 - <strong>Maraton Dębno</strong><br/>
                    15 maja 2016 - <strong>Cracovia Maraton</strong><br/>
                    11 września 2016 - <strong>Wrocław Maraton</strong><br/>
                    <strong>2015 - 2016 zdobyłem Koronę Maratonów Polski</strong></p>


            </div>
            <div class="col-md-3"></div>
        </div>

    </div>

    <!--!fourth section about skills-->


    <!--fifth section about gallery-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-mr-12">
                <?php echo do_shortcode('[supsystic-gallery id=3]') ?>

            </div>

        </div>
    </div>
    <!--!fifith section about gallery-->

    <!--section sixth-->
    <div id="other" class="container-fluid background-color-white min-height-300 padding-top-65 custom-font">

        <div class="row">
            <div class="col-md-12"></div>
        </div>
        <div class="row">

            <div class="col-md-1"></div>
            <div class="col-md-7 text-center">
                <h4><strong>INNE</strong></h4>
                <p class="text-justify lead">
                    W 2013 w raz z przyjaciółmi udałem się na ekstremalny przejazd rowerowy z Krakowa do Gdyni.
                    Udało nam się to osiągnac w 42 godziny i 42 minuty.
                    Po upływie dwóch lat od tego wydarzenia podnieśliśmy porzeczkę.
                    Założyliśmy fundację <a href="http://www.raceforhope.eu">Wyścig po Nadzieję</a> i w ramach
                    zbiórki pieniędzy udaliśmy się z Krakowa do Paryża w 10 dni.


                </p>

            </div>


            <div class="col-md-4">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item"
                            src="https://www.youtube.com/embed/wUaZECbOjXk?ecver=1"></iframe>
                </div>
                <br/>
            </div>
        </div>
    </div>

    <!--!section sixth-->


    <div id="contact"></div>
    <div class="container-fluid padding-top-65 custom-font">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3 padding-top-10">
                <?php echo do_shortcode('[contact-form-7 id="112" title="Contact form 1"]'); ?>
            </div>
            <div class="col-md-1 "></div>
            <div class="col-md-6 font-color-white text-center">
                <h4><strong class="font-color-white">BĄDŹMY W KONTAKCIE</strong></h4>
                <div class="row">
                    <div class="col-md-6"><p class="lead">
                            Jeśli chcesz się ze mna skontaktować lub czegoś dowiedzieć, napisz. Odpisuję tego samego
                            dnia.
                        </p>
                        <p class=" lead"><i class="fa fa-envelope" aria-hidden="true"></i> &nbsp
                            kontakt@krzysztofsikora.pl</p>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-9">
                                <img src="/wordpress/wp-content/themes/bootstrap-my/images/phone.jpg"
                                     class="img-responsive" alt="Phone">
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>


<?php get_footer(); ?>