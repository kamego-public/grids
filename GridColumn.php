<?php

/**
 * @package plugins/kamego/grid
 * @version 1
 * @copyright © 2016 Next Solutions
 * @class GridColumn
 * @brief Represents a grid column object used by grids.
 * @see Grid
 */

namespace Kamego\Grids;

class GridColumn
{

	/** @var string Column id. */
	private $id;

	/** @var string Column title */
	private $title;

	/** @var int Column width percentage */
	private $width;

	/** @var boolean Show total flag */
	private $showTotal;

	/** @var boolean Total value */
	private $totalValue;

	/**
	 * Constructor.
	 * @param $id string Colum id.
	 * @param $title string Column title used in UI.
	 * @param $showTotal boolean Whether to show total value or not.
	 */
	public function __construct($id, $title, $showTotal = false)
	{
		$this->id = $id;
		$this->title = $title;
		$this->showTotal = $showTotal;
		$this->width = null;
	}

	/**
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @param $title string
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}

	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param $width int
	 */
	public function setWidth($width)
	{
		$this->width = $width;
	}

	/**
	 * @return int
	 */
	public function getWidth()
	{
		return $this->width;
	}

	/**
	 * @return boolean
	 */
	public function getShowTotal()
	{
		return $this->showTotal;
	}

	/**
	 * @param $totalValue int
	 */
	public function setTotalValue($totalValue)
	{
		$this->totalValue = $totalValue;
	}

	/**
	 * @return int
	 */
	public function getTotalValue()
	{
		return $this->totalValue;
	}

	/**
	 * Perform any operation needed to make sure
	 *  this object is not carrying any state from
	 *  previous usage.
	 */
	public function resetColumn()
	{
		$this->totalValue = 0;
	}
}
?>
