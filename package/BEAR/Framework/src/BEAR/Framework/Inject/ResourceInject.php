<?php
/**
 * BEAR.Framework
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace BEAR\Framework\Inject;

use BEAR\Resource\ResourceInterface;
use Ray\Di\Di\Inject;

/**
 * Inject resource client
 *
 * @package    BEAR.Framework
 * @subpackage Inject
 */
trait ResourceInject
{

    /**
     * @Inject
     */
    public function setResource(ResourceInterface $resource)
    {
        $this->resource = $resource;
    }
}
