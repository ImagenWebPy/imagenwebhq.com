<div class="blog_header parallax" style="background: url(<?= URL; ?>public/images/blog/encabezado/<?= $this->datos_encabezado['imagen']; ?>); background-size: cover; background-position: center;">
    <div class="blog_header_overlay ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section_header">
                        <h1><?= utf8_encode($this->datos_encabezado['titulo']); ?></h1>
                        <p><?= utf8_encode($this->datos_encabezado['descripcion']); ?></p>
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
                <?php foreach ($this->listado['listado'] as $item): ?>
                    <!-- BLOG POST ITEM-->
                    <div class="blog-post">
                        <div class="blog-featured-item">
                            <a href="single-blog.html"><img src="<?= URL; ?>public/images/blog/<?= $item['imagen']; ?>" alt=""></a>
                        </div>
                        <div class="blog-post-body">
                            <h2><a href="<?= $item['url']; ?>"><?= $item['titulo']; ?></a></h2>
                            <p><?= $item['contenido']; ?></p>
                            <a class="crafty_btn" href="<?= $item['url']; ?>"><?= $item['mas']; ?></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?= $this->listado['paginador']; ?>
        </div>
    </div>
</div>