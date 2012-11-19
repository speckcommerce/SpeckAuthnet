<?php
namespace SpeckAuthnet\Api\Aim\Element;

class LineItem
{
	protected $id;
	protected $name;
	protected $description;
	protected $quantity;
	protected $unitPrice;
	protected $taxable = 'N';

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($itemName)
    {
        $this->name = $itemName;
    }

    public function getName()
    {
        return $this->name;
    }


    /**
     * get description
     *
     * @return string description
     */
    public function getDescription() 
    {
        return $this->description;
    }
    
    /**
     * set description
     *
     * @param String $description Description
     */
    public function setDescription($description) 
    {
        $this->description = $description;
    
        return $this;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setTaxable($taxable)
    {
        $this->taxable = $taxable;
    }

    public function getTaxable()
    {
        return $this->taxable;
    }

    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;
    }

    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

	public function __toString()
	{
		$data = array(
			$this->id, 
			$this->name,
			$this->description,
			$this->quantity,
			$this->unitPrice,
			$this->taxable
		);
		return urlencode(join($data, "<|>"));
	}
}