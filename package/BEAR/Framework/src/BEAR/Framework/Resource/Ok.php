<?php
/**
 *  BEAR.Framework
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace BEAR\Framework\Resource;

use BEAR\Resource\Object as ResourceObject;
use BEAR\Resource\AbstractObject;

/**
 * Ok page
 *
 * @package    BEAR.Framework
 * @subpackage Page
 */
class Ok extends AbstractObject implements ResourceObject
{
    public $code = 200;
    public $headers = [];
    public $body = '';

    public function __construct()
    {
    }

    public function onGet()
    {
        return $this;
    }
}
