<!DOCTYPE html>
<?php
require_once './temperaturas.php';

function mostrar_Temperatura($ciudad, $pais) {
    $cliente = new Temperaturas();
    $unicacion = new GetWeather();
    $unicacion->CityName = $ciudad;
    $unicacion->CountryName = $pais;

    $temp = $cliente->GetWeather($unicacion);
    echo "<h1>Valor de la temperatura</h1>";
}

function mostrar_ciudades($pais) {
    $cliente = new Temperaturas();
    $ciudad = new GetCitiesByCountry();
    $ciudad->CountryName = $pais;
    $ciudades = $cliente->GetCitiesByCountry($ciudad);
    //print_r($ciudades);
    $ciudades_ARRAY = NEW SimpleXMLElement($ciudades->GetCitiesByCountryResult);
    echo '<hr />';
    $smj = "<select name=ciudad>";
    //var_dump($ciudades_ARRAY);
    foreach ($ciudades_ARRAY->Table as $index => $pais) {
        $smj .= "<option name=$pais->City>$pais->City</option>";
    }
    $smj .= "</select>";
    return $smj;
}

switch ($_POST['enviar']) {
    case "Ver ciudades":

        $pais = $_POST['pais'];
        $smj = mostrar_ciudades($pais);
        break;
    case "Ver temperatura":
        $ciudad = $_POST['ciudad'];
        $pais = $_POST['pais'];
        mostrar_Temperatura($ciudad, $pais);
        break;
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="index.php" method="POST">
            <?php echo $smj; ?>
            <input type="text" name="pais">
            <input type="submit" value="Ver ciudades" name="enviar">
            <input type="submit" value="Ver temperatura" name="enviar">
        </form>
    </body>
</html>
