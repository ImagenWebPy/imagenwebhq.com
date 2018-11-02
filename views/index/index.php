<!-- Home Slider Start -->
<div class="slider">
    <div id="carousel-crafty-generic" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <?php
            foreach ($this->slider as $key => $slider):
                $active = ($key == 0) ? 'active' : '';
                ?>
                <div class="item <?= $active; ?>">
                    <img class="image_slider_src" src="<?= URL; ?>public/images/slider/<?= utf8_encode($slider['imagen']); ?>">
                    <div class="overlay"></div>

                    <div class="container">
                        <!-- 1 SLIDER TITLE AND DESC-->
                        <h1 class="bounceInDown"><?= utf8_encode($slider['titulo']); ?></h1>
                        <?= utf8_encode($slider['descripcion']); ?>
                    </div> 
                </div>
            <?php endforeach; ?>
        </div>
        <!-- SLIDER CONTROL-->
        <a class="left carousel-control" href="#carousel-crafty-generic" role="button" data-slide="prev"></a>
        <a class="right carousel-control" href="#carousel-crafty-generic" role="button" data-slide="next"></a>
    </div>
    <div class="container">
        <div class="down_btn">
            <!-- SCROLL DOWN -->
            <a class="about_b" href="#conocenos"><img class="floating" src="<?= URL; ?>public/images/down.png" alt=""></a>
        </div>
    </div>   

</div>
<!-- Home Slider End -->            
</div>
</header>

<!-- =========================
     START FEATURED PROJECT
============================== -->
<!-- Featured Project-->
<div class="fe_project">
    <?php foreach ($this->destacados as $destacados): ?>
        <div class="fe_item">
            <div class="fe_pro_overlay">
                <a href="#" data-rel="prettyPhoto"></a>
            </div> 
            <img src="<?= URL; ?>public/images/trabajos/thumb/<?= utf8_encode($destacados['imagen']); ?>" alt="<?= utf8_encode($destacados['web']); ?>"> 
        </div>
    <?php endforeach; ?>
</div>
<!-- End Featured Project-->
<?php if ($this->conocenos['estado'] == 1): ?>
    <!-- =========================
         START ABOUT US
    ============================== -->
    <section class="we_are page about type_one" id="conocenos">
        <div class="container no-pading">
            <!-- ABOUT US SECTION TITLE AND DECS-->
            <div class="section_header">
                <h2><?= utf8_encode($this->conocenos['seccion1']['titulo']); ?></h2>
                <?= utf8_encode($this->conocenos['seccion1']['contenido']); ?>
            </div>
            <div class="section_content">
                <div class="row">
                    <?php foreach ($this->conocenos['seccion2'] as $seccion2): ?>
                        <div class="col-md-4">
                            <div class="wig">
                                <div class="icon"> <i class="<?= utf8_encode($seccion2['font_awesome']); ?>"></i> </div>
                                <div class="wig_text first">
                                    <h2><?= utf8_encode($seccion2['titulo']); ?></h2>
                                    <p><?= utf8_encode($seccion2['contenido']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="history type_two">
            <div class="container narrow_cont">
                <div class="row">
                    <div class="col-md-8">
                        <div class="section_header left">
                            <h2><?= utf8_encode($this->conocenos['seccion3']['titulo']); ?></h2> 
                        </div>
                        <?= utf8_encode($this->conocenos['seccion3']['contenido']); ?>
                    </div>
                    <div class="col-md-4">
                        <div class="his_img"> 
                            <img src="<?= URL; ?>public/images/<?= utf8_encode($this->conocenos['seccion3']['imagen']); ?>" alt="Un poco de Historia"> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End About Us-->
    <?php endif; ?>
    <!-- =========================
         START TESTIMONIAL
    ============================== -->
    <div class="testmonial_sec">
        <div class="testmonial_cont parallax testimonial-parallax" data-type="parallax" data-animate-up="header-hide" data-animate-down="header-hide">
            <div class="testmonial_cont_overlay">
                <div class="testmonial">
                    <div class="container">
                        <div class="carousel-inner qutoSilder">
                            <?php
                            foreach ($this->frases as $key => $frases):
                                $active = ($key == 0) ? 'active' : '';
                                ?>
                                <div class="item <?= $active; ?>">
                                    <div class="testmonial-caption">
                                        <p><?= utf8_encode($frases['frase']); ?></p>
                                        <p class="cli_info"><span class="dash">-</span>
                                            <br> <span class="cli_name"><?= utf8_encode($frases['autor']); ?> </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonial-->
</section>
<?php if ($this->trabajos_encabezado['estado'] == 1): ?>
    <!-- =========================
         START PORTFOLIO
    ============================== -->
    <section id="nuestro_orgullo" class="portfolio page type_one">
        <div class="container text-center">
            <!-- PORTFOLIO SECTION TITLE AND DECS-->
            <div class="section_header">
                <h2><?= utf8_encode($this->trabajos_encabezado['titulo']); ?></h2>
                <p><?= utf8_encode($this->trabajos_encabezado['contenido']); ?></p>
            </div>
        </div>
        <!-- bootFolio content  -->
        <div id="second" class="bf">
            <!-- bootFolio Items -->
            <ul class="items">
                <?php foreach ($this->trabajos as $trabajos): ?>
                    <!-- single item -->
                    <li class="html">
                        <div class="bf-single-item"> 
                            <img src="<?= URL; ?>public/images/trabajos/thumb/<?= utf8_encode($trabajos['imagen']); ?>" alt="<?= utf8_encode($trabajos['web']); ?>">
                            <div class="caption">
                                <a href="#" target="_blank"></a>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>

            </ul>
            <!-- // bootFolio Items -->
        </div>
        <!-- //bootFolio content -->
    </section>
    <!-- // End Portfolio -->
<?php endif; ?>
<?php if ($this->loquehacemos_encabezado['estado'] == 1): ?>
    <!-- =========================
         START SERVICES
    ============================== -->
    <section id="que_hacemos" class="services page type_one">
        <div class="container">
            <!-- SERVICE SECTION TITLE AND DECS-->
            <div class="section_header">
                <h2><?= utf8_encode($this->loquehacemos_encabezado['titulo']); ?></h2>
                <p><?= utf8_encode($this->loquehacemos_encabezado['contenido']); ?></p>
            </div>
        </div>
        <!-- SERVICE TAB TITLE-->
        <div class="container">
            <ul id="myTab" class="nav nav-tabs nav-justified nav-services" role="tablist">
                <?php
                foreach ($this->loquehacemos as $key => $loquehacemos):
                    $tab = $key + 1;
                    $active = ($key == 0) ? 'active' : '';
                    ?>
                    <li class="<?= $active; ?>"><a href="#tab<?= $tab; ?>" role="tab" data-toggle="tab"><i class="<?= utf8_encode($loquehacemos['icono']) ?>"></i><br><?= utf8_encode($loquehacemos['titulo']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- SERVICE TAB DESCRIPTION-->
        <div class="container">
            <div class="bs-example bs-example-tabs">
                <div id="myTabContent" class="tab-content prog_cint">
                    <?php
                    foreach ($this->loquehacemos as $key => $loquehacemos):
                        $tab = $key + 1;
                        $active = ($key == 0) ? 'active in' : '';
                        ?>
                        <div class="tab-pane fade <?= $active; ?>" id="tab<?= $tab; ?>">
                            <div class="service-tab-desc">
                                <h2><?= utf8_encode($loquehacemos['titulo']); ?></h2>
                                <?= utf8_encode($loquehacemos['contenido']); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <!-- =========================
             START PROCESS
        ============================== -->
        <div class="the_process type_two">
            <div class="container">
                <!-- PROCESS TITLE AND DESCRIPTION-->
                <div class="section_header">
                    <h2><?= utf8_encode($this->elproceso_encabezado['titulo']) ?></h2>
                    <p><?= utf8_encode($this->elproceso_encabezado['contenido']) ?></p>
                </div>
            </div>
            <div class="container">
                <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                    <!-- PROCESS LISTS-->
                    <ul id="myTab1" class="nav nav-tabs nav-justified" role="tablist">
                        <?php
                        foreach ($this->elproceso as $key => $proceso):
                            $process = $key + 1;
                            $active = ($key == 0) ? 'active' : '';
                            ?>
                            <li class="<?= $active; ?>">
                                <a href="#process<?= $process; ?>" id="process<?= $process; ?>-tab" role="tab" data-toggle="tab" aria-controls="process<?= $process; ?>" aria-expanded="true">
                                    <i class="<?= utf8_encode($proceso['icono']); ?>"></i>
                                    <span><?= utf8_encode($proceso['titulo']); ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <!-- PROCESS DESCRIPTION-->
                    <div id="myTabContent1" class="tab-content">
                        <?php
                        foreach ($this->elproceso as $key => $proceso):
                            $process = $key + 1;
                            $active = ($key == 0) ? 'active in' : '';
                            ?>
                            <div role="tabpanel" class="tab-pane fade <?= $active; ?>" id="process<?= $process; ?>" aria-labelledBy="process<?= $process; ?>-tab">
                                <p><?= utf8_encode($proceso['contenido']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- End PROCESS-->
    <?php endif; ?>
    <?php if ($this->parallax['estado'] == 1): ?>
        <!-- =========================
           START FUN FACTS
       ============================== -->
        <div class="fact_number_cont parallax fun-fact-parallax" data-type="parallax" data-animate-up="header-hide" data-animate-down="header-hide">
            <div class="fact_number_cont_overlay">
                <div class="fact_number text-center">
                    <div class="container narrow">
                        <div class="row">
                            <div class="col-sm-40"> 
                                <div style=" text-align: justify;">
                                    <span><?= utf8_encode($this->parallax['frase']); ?></span> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End FUN FACTS-->
    <?php endif; ?>
</section>
<!-- End SERVICES-->

<?php if ($this->blog_encabezado['estado'] == 1): ?>
    <!-- =========================
         START BLOG
    ============================== -->
    <section class="blog page type_one" id="blog">
        <div class="container ">
            <!-- START BLOG TITLE AND DESC -->
            <div class="section_header">
                <h2><?= utf8_encode($this->blog_encabezado['titulo']); ?></h2>
                <p><?= utf8_encode($this->blog_encabezado['contenido']); ?></p>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php foreach ($this->blog as $blog): ?>
                    <div class="col-md-4">
                        <!-- START SINGLE BLOG ITEM -->
                        <div class="single_blog">
                            <div class="single_blog_image">
                                <img src="<?= URL; ?>public/images/blog/thumb/<?= utf8_decode($blog['imagen']); ?>" alt="">
                            </div>
                            <div class="blog_caption">
                                <h2><a href="#"><?= utf8_decode($blog['titulo']); ?></a></h2>
                                <p><?= strip_tags(utf8_decode($blog['contenido'])); ?></p>
                                <div class="blog_single_link">
                                    <a href="#"><img src="<?= URL; ?>public/images/arrow.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                        <!-- END SINGLE BLOG ITEM -->
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="container text-center">
            <div class="home-blog-btn">
                <?php if ($this->idioma == 'en'): ?>
                    <a class="crafty_btn" href="#">See all blog posts</a>
                <?php else: ?>
                    <a class="crafty_btn" href="#">Ver Todas las Publicaciones</a>
                <?php endif; ?>
            </div>

        </div>
    </section>
    <!-- END BLOG-->
<?php endif; ?>
<?php if ($this->newsletter['estado'] == 1): ?>
    <!-- =========================
         START SUBSCRIBE
    ============================== -->
    <div class="subscribe_area parallax">
        <div class="subscribe_area_overlay">
            <div class="container  text-center">
                <!-- SUBSCRIBE SECTION TITLE AND DESC -->
                <div class="subscriber">

                    <h2><?= utf8_encode($this->newsletter['titulo']); ?></h2>
                    <h4><?= utf8_encode($this->newsletter['descripcion']); ?></h4>
                    <div class="resultadoNewsletter"></div>
                    <form role="form" id="frmNewsletter">
                        <label class="InputEmail1_lab" for="mce-EMAIL"></label>
                        <input type="email" class="form-control required email" name="email_newsletter" value="<?= utf8_encode($this->newsletter['email']); ?>" onfocus="if (this.value == this.defaultValue)
                                    this.value = '';" onblur="if (this.value == '')
                                                this.value = this.defaultValue;">
                        <button type="submit" class="btn btn-dm" id="btnRegistrarNewsletter"><?= utf8_encode($this->newsletter['boton']); ?></button>
                    </form>
                </div>
            </div>
        </div>        
    </div>
    <!-- END SUBSCRIBE-->
<?php endif; ?>
<?php if ($this->contacto['estado'] == 1): ?>
    <!-- =========================
         START CONTACT
    ============================== -->
    <section class="contact page type_one" id="contactanos">
        <div class="container ">
            <div class="section_header">
                <h2><?= utf8_encode($this->contacto['titulo']); ?></h2>
                <p><?= utf8_encode($this->contacto['contenido']); ?></p>
            </div>
        </div>
        <div class="container ">
            <!-- START ADDRESS AND OTHER CONTACT INFORMATION -->
            <div class="row">
                <div class="col-sm-4">
                    <div class="contact_wig">
                        <h3><i class="fa pe-7s-call"></i> <?= utf8_encode($this->contacto['telefono']); ?></h3>
                        <p><?= utf8_encode($this->contacto['datos_telefono']); ?></p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact_wig">
                        <h3><i class="fa pe-7s-mail"></i> <?= utf8_encode($this->contacto['email']); ?></h3>
                        <p><?= utf8_encode($this->contacto['datos_email']); ?></p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact_wig">
                        <h3><i class="fa pe-7s-map-marker"></i> <?= utf8_encode($this->contacto['contacto']); ?> </h3>
                        <p><?= utf8_encode($this->contacto['datos_contacto']); ?></p>
                    </div>
                </div>
            </div>
            <!-- END ADDRESS AND OTHER CONTACT INFORMATION -->

            <div class="show_result"></div>
            <div class="result_message"></div>

            <!-- CONTACT FORM -->
            <form role="form" id="frmContacto">
                <div class="row">
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="nombre"  placeholder="<?= utf8_encode($this->contacto['input_nombre']); ?>"> </div>
                    <div class="col-sm-4">
                        <input type="email" class="form-control"  name="email" placeholder="<?= utf8_encode($this->contacto['input_email']); ?>"> </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="asunto" placeholder="<?= utf8_encode($this->contacto['input_asunto']); ?>"> </div>
                    <div class="col-sm-12">
                        <textarea class="form-control" rows="5" name="mensaje" placeholder="<?= utf8_encode($this->contacto['input_mensaje']); ?>"></textarea>
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-dm" id="btnEnviarFormulario"><?= utf8_encode($this->contacto['input_boton']); ?></button>
                    </div>
                </div>
            </form>
            <!-- END CONTACT FORM -->
        </div>

        <!--START MAP-->
        <div id="map"></div>
        <!--END START MAP-->
    </section>
    <!-- END CONTACT-->
<?php endif; ?>