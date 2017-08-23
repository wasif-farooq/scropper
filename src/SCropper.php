<?php
/**
* An class that wrapper class for the cropping
*
* @category   image croppering
* @package    scropper
* @author     Wasif Farooq <wasif0332@gmail.com>
* @license    http://www.php.net/license/3_01.txt  PHP License 3.01
* @version    1.0
*/

class SCropper
{
    /**
    * @var array
    * use to store cropping detail link width, height, x, y
    */
    private $details;

    /**
    * @var Handler
    * it keep current image handler
    */
    private $handler;

    /**
    * @param array $detials the cropping details
    * @param Handler $handler the handler to handle cropping w.r.t image type
    * @return void
    */
    public function __construct($details, $handler)
    {
        $this->setDetails($details);
        $this->setHandler($handler);

        foreach ($this->getDetails() as $k => $v) {
            $setter = 'set' . ucfirst($k);
            if (method_exists($this->getHandler(), $setter)) {
                $this->getHandler()->$setter($v);
            }
        }
    }

    /**
    * @access public
    * @return array
    */
    public function getDetails()
    {
        return $this->details;
    }

    /**
    * @access public
    * @param array $details details
    * @return void
    */
    public function setDetails($details)
    {
        $this->details = $details;
    }

    /**
    * @access public
    * @return Handler
    */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
    * @access public
    * @param Handler $handler handler
    * @return void
    */
    public function setHandler($handler)
    {
        $this->handler = $handler;
    }

    /**
    * @access public
    * @return string the path of cropped image
    * @throws Exception
    */
    public function crop()
    {
        $this->getHandler()->setup();
        return $this->getHandler()->process();
    }
}
