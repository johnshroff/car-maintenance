<?php

namespace App\JsonApi\MaintenanceEvents;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'maintenance-events';

    /**
     * @param $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
        	'car_id'	 				=> $resource->car_id,
			'mileage'	 				=> $resource->mileage,
			'business_name' 			=> $resource->business_name,
			'maintenance_service_id'	=> $resource->maintenance_service_id,
            'created-at' 				=> $resource->created_at->toAtomString(),
            'updated-at' 				=> $resource->updated_at->toAtomString(),
        ];
    }

	public function getRelationships($event, $isPrimary, array $includeRelationships)
	{
		return [
			'maintenance-service' => [
				self::SHOW_SELF => true,
				self::SHOW_RELATED => true
			],
		];
	}
}
