<div class="blog_header parallax" style="background: url(<?= URL; ?>public/images/blog/encabezado/<?= $this->post['imagen_header']; ?>); background-size: cover; background-position: center;">
    <div class="blog_header_overlay ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section_header">
                        <h1><?= $this->post['titulo']; ?></h1>
                    </div>              
                </div>
            </div>
        </div>        
    </div>
</div>
<div class="single_blog_page type_one">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- START SINGLE POST-->
                <div class="post_content">
                    <div class="post_image">
                        <a href="#"><img src="<?= URL; ?>public/images/blog/<?= $this->post['imagen']; ?>" alt="<?= $this->post['imagen']; ?>"></a>
                    </div>
                    <!-- POST ITEM CONTENT-->
                    <div class="post-body">
                        <?= $this->post['contenido']; ?>
                    </div>
                    <p>&nbsp;</p>
                </div>
            </div>
        </div>
    </div>  
</div>
