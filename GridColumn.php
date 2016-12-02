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

	/** @var string Column columnName. */
	protected $columnName;

	/** @var string Column title */
	protected $title;

	/** @var int Column width percentage */
	protected $width;

	/** @var boolean Show total flag */
	protected $showTotal;

	/** @var boolean Total value */
	protected $totalValue;

	/** @var bool  */
	protected $excludeFromTotal = false;

	/**
	 * Constructor.
	 * @param $columnName string Column id.
	 * @param $title string Column title used in UI.
	 * @param $showTotalRows boolean Whether to show total value or not.
	 */
	public function __construct($columnName, $title, $showRowsTotal = false)
	{
		$this->columnName = $columnName;
		$this->title = $title;
		$this->showRowsTotal = $showRowsTotal;
		$this->width = null;
	}

	/**
	 * @return string
	 */
	public function getColumnName()
	{
		return $this->columnName;
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
	public function getShowRowsTotal()
	{
		return $this->showRowsTotal;
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
	 * @return bool
	 */
	public function excludeFromTotal()
	{
		return $this->excludeFromTotal;
	}

	/**
	 * @param $excludeFromTotal
	 */
	public function setExcludeFromTotal($excludeFromTotal)
	{
		$this->excludeFromTotal = $excludeFromTotal == true;
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
