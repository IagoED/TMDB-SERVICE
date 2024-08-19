<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use App\TMDBClient;
use App\MovieService;

$client = new TMDBClient();
$service = new MovieService($client);

if(isset($_GET['title'])){

    $title = $_GET['title'];
    $movie_info = $service->getMovieInfo($title);

    if($movie_info){

        $html = file_get_contents(__DIR__ . '/templates/movie_info.html');
        
        $html = str_replace('{{title}}', htmlspecialchars($movie_info['title']), $html);
        $html = str_replace('{{original_title}}', htmlspecialchars($movie_info['original_title']), $html);
        $html = str_replace('{{average_rating}}', htmlspecialchars($movie_info['average_rating']), $html);
        $html = str_replace('{{release_date}}', htmlspecialchars($movie_info['release_date']), $html);
        $html = str_replace('{{description}}', htmlspecialchars($movie_info['description']), $html);
        
        if(!empty($movie_info['similar_movies'])){
            $similar_movies_html = '<ul class="list-group">';
            foreach($movie_info['similar_movies'] as $similar_movie){
                $similar_movies_html .= '<li class="list-group-item">'.htmlspecialchars($similar_movie).'</li>';
            }
            $similar_movies_html .= '</ul>';
        }else{
            $similar_movies_html = '<p>No se encontraron películas similares.</p>';
        }
        $html = str_replace('{{similar_movies}}', $similar_movies_html, $html);

        echo $html;
    }else{
    
        echo "<div class='alert alert-danger' role='alert'>Película no encontrada</div>";    
    }

}else{

    echo "<div class='alert alert-warning' role='alert'>Porfavor, proporciona un título de película.</div>";        

}

?>