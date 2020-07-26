<?php

namespace App\Libraries
{
    class GIS
    {
        public function create_geo_json($locales)
        {
            $features = array();

            foreach($locales as $key => $value)
            {
                $features[] = array(
                    'type' => 'Feature',
                    'geometry' => array(
                        'type' => 'Point', 
                        'coordinates' => array(
                            ($value->longitude)? (float)$value->longitude : null,
                            ($value->latitude)? (float)$value->latitude : null,
                        )
                    ),
                    'properties' => array
                    (
                        'id' => $value->user_id,
                        'nombre' => $value->user_full_name,
                        'contacto' => $value->user_phone,
                        'comentarios' => ($value->user_comment)? $value->user_comment : '',
                        'productos' => $value->products
                    )
                );
            };

            $allfeatures = array(
                'type' => 'FeatureCollection', 
                'features' => $features
            );
            return json_encode($allfeatures, JSON_PRETTY_PRINT);
        }
    }
}