<?php

namespace App;

class TMDBClient{

    private $api_key;
    private $base_url;

    public function __construct(){
        $this->api_key = $_ENV['TMDB_API_KEY'];
        $this->base_url = 'https://api.themoviedb.org/3/';
    }

    public function searchMovie($title){
        $url = $this->base_url . "search/movie?query=" . urlencode($title) . "&api_key=" . $this->api_key;
        return $this->cacheRequest($url);
    }

    public function getMovieDetails($movie_id){
        $url = $this->base_url . "movie/$movie_id?api_key=" . $this->api_key;
        return $this->cacheRequest($url);
    }

    public function getSimilarMovies($movie_id){
        $url = $this->base_url . "movie/$movie_id/similar?api_key=" . $this->api_key;
        return $this->cacheRequest($url);
    }

    private function makeRequest($url){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }

    private function cacheRequest($url){

        $cache_dir = __DIR__ . '/cache/';
        $cache_file = $cache_dir . md5($url) . '.json';

        if (!is_dir($cache_dir)) {
            mkdir($cache_dir, 0777, true);
        }
       
        if(file_exists($cache_file)){
        
            return json_decode(file_get_contents($cache_file), true);
        
        }

        $response = $this->makeRequest($url);
        file_put_contents($cache_file, json_encode($response));

        return $response;
    
    }
}

?>