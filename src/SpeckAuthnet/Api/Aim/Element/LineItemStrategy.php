<?php
namespace SpeckAuthnet\Api\Aim\Element;

use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

class LineItemStrategy implements StrategyInterface
{
    protected $hydrator;


    /**
     * Converts the given value so that it can be extracted by the hydrator.
     *
     * @param mixed $value The original value.
     * @return mixed Returns the value that should be extracted.
     */
    public function extract($value)
    {
        $data = array();
        foreach($value as $item) {
            $data[] = $this->hydrator->extract($item);
        }
        return $data;
    }

    /**
     * Converts the given value so that it can be hydrated by the hydrator.
     *
     * @param mixed $value The original value.
     * @return mixed Returns the value that should be hydrated.
     */
    public function hydrate($value)
    {
        if($value instanceof LineItem) {
            return $value;
        }

        $items = array();
        foreach($value as $itemData) {
            $item = new LineItem();
            $this->hydrator->hydrate($itemData, $item);    
            $items[] = $item;
        }
        
        
        return $items;
    }

    public function setHydrator($hydrator)
    {
        $this->hydrator = $hydrator;
        return $this;
    }
}
