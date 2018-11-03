<div class="blog_header parallax" style="background: url(<?= URL; ?>public/images/trabajos/encabezado/<?= $this->datos_trabajo['imagen_header']; ?>); background-size: cover; background-position: center;">
    <div class="blog_header_overlay ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section_header">
                        <h1><?= $this->datos_trabajo['web']; ?></h1>
                        <p><?= $this->datos_trabajo['descripcion']; ?></p>
                        <a href="<?= $this->datos_trabajo['url']; ?>" target="_blank" style="color: #fff;">Ir al sitio</a>
                    </div>              
                </div>
            </div>
        </div>        
    </div>
</div>
<div class="portfolio_slider">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="single_portfolio">
                    <?php foreach ($this->datos_trabajo['imagenes'] as $item): ?>
                        <div class="item">
                            <img src="<?= URL; ?>public/images/trabajos/<?= $item; ?>" alt="">
                        </div>
                    <?php endforeach; ?>
                </div>                    
            </div>
        </div>
    </div>
</div>