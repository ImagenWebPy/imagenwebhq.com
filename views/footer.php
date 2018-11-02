<!-- =========================
             START FOOTER
        ============================== -->
<footer>
    <div class="copy text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p><br>Todos los derechos Reservados. </p>
                    <div class="footer_social">
                        <ul class="list-inline">
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                        </ul>
                    </div> 
                </div>
            </div>
        </div>   
    </div>
</footer>
<!-- END FOOTER-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?= URL; ?>public/js/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?= URL; ?>public/js/bootstrap.min.js"></script>
<script src="<?= URL; ?>public/js/waypoints.min.js"></script>
<script src="<?= URL; ?>public/js/jquery.prettyPhoto.js"></script>
<script src="<?= URL; ?>public/js/owl.carousel.min.js"></script>
<script src="<?= URL; ?>public/js/jquery.counterup.min.js"></script>
<script src="<?= URL; ?>public/bfassets/js/jquery.bootFolio.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTIDIAzMco78Y-xW--eAyiK-5FjYIcqhE"></script>
<script src="<?= URL; ?>public/js/jquery.easing.min.js"></script>
<script src="<?= URL; ?>public/js/tweetie.js"></script>
<script src="<?= URL; ?>public/js/smoothscroll.js"></script>
<script src="<?= URL; ?>public/js/jquery.ajaxchimp.min.js"></script>
<script src="<?= URL; ?>public/js/jquery.parallax-1.1.3.js"></script>
<script src="<?= URL; ?>public/js/matchMedia.js"></script> 
<script src="<?= URL; ?>public/js/script.js"></script>
<script type="text/javascript">
    $(function () {
        $(document).on("submit", "#frmContacto", function (e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            if (e.handled !== true) // This will prevent event triggering more then once
            {
                var nombre = $("input[name='nombre']");
                var email = $("input[name='email']");
                var asunto = $("input[name='asunto']");
                var mensaje = $("textarea[name='mensaje']");
                if (nombre.val().trim().length == 0) {
                    nombre.css('border', '2px solid red');
                } else {
                    nombre.css('border', '2px solid #7a7a7a');
                }
                if (email.val().trim().length == 0) {
                    email.css('border', '2px solid red');
                } else {
                    email.css('border', '2px solid #7a7a7a');
                }
                if (asunto.val().trim().length == 0) {
                    asunto.css('border', '2px solid red');
                } else {
                    asunto.css('border', '2px solid #7a7a7a');
                }
                if (mensaje.val().trim().length == 0) {
                    mensaje.css('border', '2px solid red');
                } else {
                    mensaje.css('border', '2px solid #7a7a7a');
                }
                if (nombre.val().trim().length > 1 && email.val().trim().length > 1 && asunto.val().trim().length > 1 && mensaje.val().trim().length > 1) {
                    if (isEmail(email.val()) == true) {
                        $.ajax({
                            type: "POST",
                            url: '<?= URL . $this->idioma; ?>/formularios/frmContacto',
                            dataType: 'json',
                            data: $("#frmContacto").serialize(), // serializes the form's elements.
                            beforeSend: function () {
                                $("#btnEnviarFormulario").html("<i class='fa fa-spinner fa-spin' aria-hidden='true'></i>");
                            },
                            success: function (data)
                            {
                                if (data.type == 'success') {
                                    $(".result_message").html(data.content);
                                }
                            }
                        });
                    } else {
                        email.css('border', '2px solid red');
                    }
                }
            }
            e.handled = true;
        });
        $(document).on("submit", "#frmNewsletter", function (e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            if (e.handled !== true) // This will prevent event triggering more then once
            {
                var email = $("input[name='email_newsletter']");
                if (email.val().trim().length == 0) {
                    email.css('border', '2px solid red');
                } else {
                    email.css('border', '2px solid #7a7a7a');
                }
                if (email.val().trim().length > 1) {
                    if (isEmail(email.val()) == true) {
                        $.ajax({
                            type: "POST",
                            url: '<?= URL . $this->idioma; ?>/formularios/frmNewsletter',
                            dataType: 'json',
                            data: $("#frmNewsletter").serialize(), // serializes the form's elements.
                            beforeSend: function () {
                                $("#btnRegistrarNewsletter").html("<i class='fa fa-spinner fa-spin' aria-hidden='true'></i>");
                            },
                            success: function (data)
                            {
                                if (data.type == 'success') {
                                    $(".resultadoNewsletter").html(data.content);
                                }
                            }
                        });
                    } else {
                        email.css('border', '2px solid red');
                    }
                }
            }
            e.handled = true;
        });
        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }
    });
</script>

</body>

</html>