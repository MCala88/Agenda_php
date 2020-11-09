
<!DOCTYPE html>
<html>
<body>

<!--Creamos el formuladio donde introduciremos el nombre y el telefono-->
<form method="post">
    <label for="nombre">Nombre:</label><br>
    <input type="text" id="nombre" name="nombre" type='hidden'><br>
    <label for="telefono">Número de teléfono:</label><br>
    <input type="number" id="telefono" name="telefono" type='hidden'><br><br>
    <input type="submit" value="Enviar">

<?php

if (!isset($_POST['submit'])) {
    if (!isset($_POST['libreta'])) {
        // Declaro un array asociativo de los valores 'nombre' y 'telefono'
            $agenda = @array($_POST['nombre'] => $_POST['telefono']);
            // En caso contrario, entraría en este condicional de 'else'
        } else {
            //Los datos que recibo de mi input hidden convirtiéndolos en 'string'.
            parse_str($_POST['libreta'], $agenda);
            // Creo un array de soporte para recibir los datos del POST.
            $agenda_sop = array($_POST['nombre'] => $_POST['telefono']);
            // Actualizo agenda mediante una función sacada de phpdocs.
            $agenda = array_merge($agenda, $agenda_sop);
            if (!empty($_POST['nombre']) && empty($_POST['telefono'])) {
                /* Elimina la variable indicada en este caso, 'unset' me está eliminando tanto
                la 'key' como su 'value' asociado dentro del array $agenda */
                unset($agenda[$_POST['nombre']]);
            }
        // Mando un alert si el campo nombre está vacío
        if (empty($_POST['nombre'])) {
            echo '<script>alert("Introduzca el nombre")</script>';
        }
    }



if (isset($agenda)) {
    $agenda_txt = http_build_query($agenda);
}

echo '<input type="hidden" id="libreta" name="libreta" value="' . $agenda_txt . '">';

    
echo "<h1>Agenda de contactos</h1>";

foreach ($agenda as $nombre => $telefono){                          // Muestra la lista de la agenda
    if ($agenda[$nombre] != null & $nombre != null) {          
        echo "<pre>" . "- " . $nombre . ": " . $telefono . "</pre>";
    }
}
}
?>   
</form>
</body>
</html>