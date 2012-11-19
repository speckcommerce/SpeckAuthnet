<?php
namespace SpeckAuthnetTest\Api\Aim\Element;

use PHPUnit_Framework_TestCase,
	SpeckAuthnet\Api\Aim\Element\LineItem,
	SpeckAuthnet\Bootstrap;

class LineItemTest extends PHPUnit_Framework_TestCase
{
	protected $sm;

    public function setUp()
    {
        $this->sm = Bootstrap::getServiceManager();
    }

    public function testInstantiation()
    {
    	$lineItem = new LineItem();
    	$data = array(
    		'id' => '1',
    		'name' => 'item 1',
    		'description' => 'description 1',
    		'quantity' => '1',
    		'unit_price' => '10.00'
    	);
    	$hydrator = $this->sm->get('Aim\Hydrator');
    	$hydrator->hydrate($data, $lineItem);

    	$this->assertTrue($lineItem instanceof LineItem);
    	$this->assertEquals('1', $lineItem->getId());
    	$this->assertEquals('item 1', $lineItem->getName());
    	$this->assertEquals('description 1', $lineItem->getDescription());
    	$this->assertEquals('1', $lineItem->getQuantity());
    	$this->assertEquals('N', $lineItem->getTaxable());
    	$this->assertEquals('10.00', $lineItem->getUnitPrice());
    	$this->assertEquals('1%3C%7C%3Eitem+1%3C%7C%3Edescription+1%3C%7C%3E1%3C%7C%3E10.00%3C%7C%3EN', $lineItem->__toString());
    }
}
