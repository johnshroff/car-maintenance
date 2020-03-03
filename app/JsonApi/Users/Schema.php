<?php

namespace App\JsonApi\Users;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'users';

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
        	'name'			=> $resource->name,
			'email'			=> $resource->email,
            'created-at' 	=> $resource->created_at->toAtomString(),
            'updated-at' 	=> $resource->updated_at->toAtomString(),
        ];
    }

	public function getRelationships($user, $isPrimary, array $includeRelationships)
	{
		return [
			'cars' => [
				self::SHOW_SELF => true,
				self::SHOW_RELATED => true
			],
		];
	}
}
