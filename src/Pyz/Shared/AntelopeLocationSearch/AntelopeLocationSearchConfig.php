<?php

namespace Pyz\Shared\AntelopeLocationSearch;

use Spryker\Shared\Kernel\AbstractBundleConfig;

class AntelopeLocationSearchConfig extends AbstractBundleConfig
{
    /**
     * @api
     *
     * @var string
     */
    public const ANTELOPE_LOCATION_PUBLISH_SEARCH_QUEUE = 'publish.search.antelope_location';

    /**
     * @api
     *
     * @var string
     */
    public const ANTELOPE_LOCATION_SYNC_SEARCH_QUEUE = 'sync.search.antelope_location';

    /**
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_PYZ_ANTELOPE_LOCATION_CREATE = 'Entity.pyz_antelope_location.create';

    /**
     * @api
     *
     * @var string
     */
    public const ENTITY_PYZ_ANTELOPE_LOCATION_UPDATE = 'Entity.pyz_antelope_location.update';

    /**
     * @api
     *
     * @var string
     */
    public const ENTITY_PYZ_ANTELOPE_LOCATION_DELETE = 'Entity.pyz_antelope_location.delete';

    /**
     * @api
     *
     * @var string
     */
    public const ANTELOPE_LOCATION_PUBLISH = 'AntelopeLocationSearch.antelope_location.publish';

    /**
     * @api
     */
    public const ANTELOPE_LOCATION_UNPUBLISH = 'AntelopeLocationSearch.antelope_location.unpublish';
}
