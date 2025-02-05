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
     *     full_name: string,
     *     phone_number: string,
     *     comment?: string,
     *     products: array,
     *     longitude?: float,
     *     latitude?: float,
     * } $value
     */
    private function createFeature(Object $value): array
    {
        return  [
            'type' => self::FEATURE_TYPE,
            'geometry' => [
                'type' => self::GEOMETRY_TYPE,
                'coordinates' => [
                    (float)$value->longitude ??  null,
                    (float)$value->latitude ?? null,
                ]
            ],
            'properties' =>
            [
                'id' => $value->user_id,
                'nombre' => $value->full_name,
                'contacto' => $value->phone_number,
                'comentarios' => $value->comment ?? '',
                'productos' => $value->products
            ]
        ];
    }
}
