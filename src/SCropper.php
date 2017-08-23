<?php

class SCropper
{
    private $details;

    private $handler;

    public function __construct($details, $handler)
    {
        parent::__construct();
        $this->setDetails($details);
        $this->setHandler($handler);

        foreach ($this->getDetails() as $k => $v) {
            $setter = 'set' . ucfirst($k);
            if (method_exiss($this->getHandler(), $setter)) {
                $this->getHandler()->$setter($v);
            }
        }
    }

    public function getDetails()
    {
        return $this->details;
    }

    public function setDetails($details)
    {
        $this->details = $details;
    }

    public function getHandler()
    {
        return $this->handler;
    }
    public function setHandler($handler)
    {
        $this->handler = $handler;
    }

    public function crop()
    {
        $this->getHandler()->setup();
        return $this->getHandler()->process();
    }
}
