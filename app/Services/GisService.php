<?php

namespace App\Services;

class GisService
{
    private const FEATURE_TYPE = 'Feature';
    private const GEOMETRY_TYPE = 'Point';
    private const COLLECTION_TYPE = 'FeatureCollection';

    public function createGeoJson(array $locales): string | false
    {
        $features = array_map([$this, 'createFeature'], $locales);

        return json_encode([
            'type' => self::COLLECTION_TYPE,
            'features' => $features
        ], JSON_PRETTY_PRINT);
    }

    /**
     * @param object{
     *     user_id: int,
     *     user_full_name: string,
     *     user_phone: string,
     *     user_comment?: string,
     *     products: array,
     *     user_lng?: float,
     *     user_lat?: float
     * } $value
     */
    private function createFeature(Object $value): array
    {
        return  [
            'type' => self::FEATURE_TYPE,
            'geometry' => [
                'type' => self::GEOMETRY_TYPE,
                'coordinates' => [
                    isset($value->user_lng) ? (float)$value->user_lng : null,
                    isset($value->user_lat) ? (float)$value->user_lat : null,
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
