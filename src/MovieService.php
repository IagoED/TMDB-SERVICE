<?php

namespace App;

class MovieService{

    private $client;

    public function __construct(TMDBClient $client){
    
        $this->client = $client;

    }

    public function getMovieInfo($title){
    
        $search_result = $this->client->searchMovie($title);

        if(isset($search_result['results'][0])){
        
            $movie = $search_result['results'][0];
            $movie_details = $this->client->getMovieDetails($movie['id']);
            $similar_movies = $this->client->getSimilarMovies($movie['id']);

            $response = [
                'title' => $movie_details['title'],
                'original_title' => $movie_details['original_title'],
                'average_rating' => $movie_details['vote_average'],
                'release_date' => $movie_details['release_date'],
                'description' => $movie_details['overview'],
                'similar_movies' => $this->formatSimilarMovies($similar_movies['results'])
            ];

            return $response;
        
        }

        return null;

    }

    private function formatSimilarMovies($movies){
    
        $similar_movies = [];
        foreach(array_slice($movies, 0, 5) as $movie){
        
            $similar_movies[] = $movie['title'] . " (" . substr($movie['release_date'], 0, 4) . ")";
        
        }

        return $similar_movies;
    
    }

}

?>