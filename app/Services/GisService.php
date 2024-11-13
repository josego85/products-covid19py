<?php

namespace App\Services;

class GisService
{
    private const FEATURE_TYPE = 'Feature';
    private const GEOMETRY_TYPE = 'Point';
    private const COLLECTION_TYPE = 'FeatureCollection';

    public function createGeoJson(array $locales): string
    {
        $features = array_map([$this, 'createFeature'], $locales);

        return json_encode([
            'type' => self::COLLECTION_TYPE,
            'features' => $features
        ], JSON_PRETTY_PRINT);
    }

    private function createFeature($value): array
    {
        return  [
            'type' => self::FEATURE_TYPE,
            'geometry' => [
                'type' => self::GEOMETRY_TYPE,
                'coordinates' => [
                    $value->user_lng ? (float)$value->user_lng : null,
                    $value->user_lat ? (float)$value->user_lat : null,
                ]
            ],
            'properties' =>
            [
                'id' => $value->user_id,
                'nombre' => $value->user_full_name,
                'contacto' => $value->user_phone,
                'comentarios' => $value->user_comment ?? '',
                'productos' => $value->products
            ]
        ];
    }
}
