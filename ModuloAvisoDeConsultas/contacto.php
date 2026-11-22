<?php
require_once __DIR__ . '/includes/bootstrap.php';
?>
<!doctype html>
<html lang="en">

<?php
    require_app('templates/header.php')
?>

<link href="css/formulario.css" rel="stylesheet">

<div class="container">
    <section class="main row" style="background-color:rgba(0, 0, 0, 0);">
        <div class="col-12 col-lg-6 formulario-contacto">
            <div class="titulo">
                <h2>Contacto</h2>
            </div>  
            <form action="./acciones/enviarFormulario.php" method="post">

                <label for="nombre" class="colocar_nombre">Nombre
                    <span class="obligatorio">*</span>
                </label>
                <input type="text" name="nombre" id="nombre" required="obligatorio" placeholder="Escribe tu nombre">

                <label for="email" class="colocar_email">Email
                    <span class="obligatorio">*</span>
                </label>
                <input type="email" name="email" id="email" required="obligatorio" placeholder="Escribe tu Email">

                <label for="telefono" class="colocar_telefono">Teléfono
                </label>
                <input type="tel" name="telefono" id="telefono" placeholder="Escribe tu teléfono">
    
                <label for="asunto" class="colocar_asunto">Asunto
                    <span class="obligatorio">*</span>
                </label>
                <input type="text" name="asunto" id="assunto" required="obligatorio" placeholder="Escribe un asunto">
 
                <label for="mensaje" class="mensaje">Mensaje
                    <span class="obligatorio">*</span>
                </label>                     
                <textarea name="mensaje" class="texto_mensaje" id="mensaje" required="obligatorio" placeholder="Deja aquí tu comentario..."></textarea>                   

                <button type="submit" name="enviar_formulario" id="enviar"><p>Enviar</p></button>

                <p class="aviso">
                <span class="obligatorio"> * </span>los campos son obligatorios.
                </p>  
            </form>
        </div>

        <aside class="col-12 col-lg-6">
        <div class="container">
            <div class="ubicacionUTN" style="background-color:rgba(0, 0, 0, 0);">
                <br><br><br>
                <iframe class="mapa-facultad" title="UTN Facultad Regional Rosario, Zeballos 1341" src="https://maps.google.com/maps?q=zeballos%201341%20Rosario&z=17&output=embed"></iframe>
            </div>
        </div>
        </aside>
    </section>
</div>

<?php
     require_app('templates/footer.php')
?>

</html>
