<?php

namespace App\JsonApi\Cars;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'cars';

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
        	'make'			=> $resource->make,
			'model'			=> $resource->model,
			'year'			=> $resource->year,
			'user_id'		=> $resource->user_id,
            'created-at' => $resource->created_at->toAtomString(),
            'updated-at' => $resource->updated_at->toAtomString(),
        ];
    }

	public function getRelationships($car, $isPrimary, array $includeRelationships)
	{
		return [
			'user' => [
				self::SHOW_SELF => true,
				self::SHOW_RELATED => true
			],
		];
	}
}
