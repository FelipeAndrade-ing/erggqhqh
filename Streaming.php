<?php
// Clave de API de YouTube Data
$apiKey = "AIzaSyAusovbghRW69QNrwZGQ19dHBNbDEKv0JY";


$query = "Terror";  //Aqui va la palabrita clave ok?

// URL de la API para buscar videos en vivo con la palabra clave
$url = "https://www.googleapis.com/youtube/v3/search?part=snippet&eventType=live&type=video&q=" . urlencode($query) . "&key=" . $apiKey;

// Hacer la solicitud a la API
$response = file_get_contents($url);
if ($response === FALSE) {
    die("Error al obtener datos de YouTube.");
}

// Decodificar la respuesta JSON

$data = json_decode($response, true);
//Incluimos fuentesitas de google
echo '<link href="https://fonts.googleapis.com/css2?family=Creepster&family=Nosifer&display=swap" rel="stylesheet">';
// Incluimos el bostrapsito
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">';
// Luego mis estilitos
echo '<link rel="stylesheet" href="Estilos.css">';
// Aqui vemos si si hay transimisiones en vivo o si no 
if (isset($data['items']) && count($data['items']) > 0) {
    echo "<div class='container my-5'>";
    echo "<h1>Transmisiones en Vivo de '$query'</h1>";
    echo "<div class='row'>";  // Empieza la fila para los videos

    // Iterar sobre los videos encontrados
    foreach ($data['items'] as $item) {
        $videoId = $item['id']['videoId'];
        $title = $item['snippet']['title'];

        echo "<div class='col-md-4 mb-4'>"; 
        echo "<div class='card'>";
        echo "<iframe class='card-img-top' 
                        width='100%' 
                        height='215' 
                        src='https://www.youtube.com/embed/$videoId' 
                        frameborder='0' 
                        allowfullscreen>
              </iframe>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>$title</h5>";
        echo "</div>";  
        echo "</div>"; 
        echo "</div>";  
    }

    echo "</div>";
    echo "</div>";  
} else {
    echo "<div class='container my-5'><p class='alert alert-warning'>No se encontraron transmisiones en vivo sobre '$query'.</p></div>";
}

?>
