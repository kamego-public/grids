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

class GridRow
{
	/** @var boolean Total value */
	protected $totalValue;

	/** @var GridColumn	 */
	protected $columns;

	/**
	 * GridRow constructor.
	 * @param $row
	 * @param GridColumn $columns
	 * @param bool $showColumnTotals
	 */
	public function __construct($row, $columns, $showColumnTotals = false)
	{
		$this->row = $row;
		$this->columns = $columns;
		$this->showColumnTotals = $showColumnTotals;
	}

	/**
	 * @param GridColumn $column
	 * @return mixed
	 */
	public function getValueByColumn(& $column)
	{
		$columnName = $column->getColumnName();
		$value = $this->row->$columnName;

		return $value;
	}

	/**
	 * Sums up a total of each column in the row
	 * @return int
	 */
	public function getRowTotal()
	{
		$total = 0;
		foreach ($this->columns as $column)
		{
			if(!$column->excludeFromTotal())
			{
				$total += $this->getValueByColumn($column);
			}
		}
		return $total;
	}

	/**
	 * @return boolean
	 */
	public function getShowColumnTotals()
	{
		return $this->showColumnTotals;
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
	public function resetRow()
	{
		$this->totalValue = 0;
	}
}
?>
