<?php

namespace App\Traits;

trait DndbQuery
{
    /**
     * Function Parse Query Search to Array
     * 
     * @param string urlencode: query="video_title=Sponsbob"
     * 
     * @return array
     */
    public function ReqParse($query)
    {
        // Parse Request
        $query_request  = urldecode($query);
        $query_build    = substr($query_request, 1, -1);
        
        // Array for Where Collection
        $query_eloquent = [];

        // Check if Using Multiple Query or Not
        if(strpos($query_build, ',') !== false) {
            $query_parse = explode(',', $query_build);
            
            // Build to Single Array
            foreach($query_parse as $query_build_parse) 
            {
                $parse_explode = explode('=', $query_build_parse);

                $query_eloquent = array_merge($query_eloquent, array($parse_explode[0] => $parse_explode[1]));
            }

        } else {
            $parse_explode = explode('=', $query_build);
            $query_eloquent = [
                $parse_explode[0] => $parse_explode[1]
            ];
        }

        return $query_eloquent;
    }
}