<?php

namespace App\Libraries
{
    class GIS
    {
        public function create_geo_json($locales)
        {
            $features = [];

            foreach ($locales as $key => $value) {
                $features[] = [
                    'type' => 'Feature',
                    'geometry' => [
                        'type' => 'Point',
                        'coordinates' => [
                            ($value->user_lng) ? (float)$value->user_lng : null,
                            ($value->user_lat) ? (float)$value->user_lat : null,
                        ]
                    ],
                    'properties' =>
                    [
                        'id' => $value->user_id,
                        'nombre' => $value->user_full_name,
                        'contacto' => $value->user_phone,
                        'comentarios' => ($value->user_comment) ? $value->user_comment : '',
                        'productos' => $value->products
                    ]
                ];
            };

            $allfeatures = [
                'type' => 'FeatureCollection',
                'features' => $features
            ];
            return json_encode($allfeatures, JSON_PRETTY_PRINT);
        }
    }
}
