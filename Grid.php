<?php

/**
 * @package plugins/kamego/grid
 * @version 1
 * @copyright © 2016 Next Solutions
 * @class Grid
 * @brief Represents a grid object, that is capable of rendering
 *  a simple HTML grid with the passed columns and data.
 */

namespace Kamego\Grids;

class Grid
{

	/** @var string Grid id. */
	private $id;

	/** @var string Grid title. */
	private $title;

	/** @var array Grid columns. */
	private $columns;

	/** @var Recordset Grid data. */
	private $data;

	/** @var int Grid width percentage. */
	private $width;

	/**
	 * Constructor.
	 * @param $id string Grid id.
	 * @param $title string Grid title used in UI.
	 * @param $columns array Elements need to be instances of GridColumn.
	 * @param $data Recordset
	 */
	public function __construct($id, $title, $columns, $data)
	{
		$this->id = $id;
		$this->title = $title;
		$this->columns = $this->resetColumns($columns);
		$this->data = $data;
		$this->width = null;
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
	 * Render the grid HTML markup.
	 * @return string
	 */
	public function render()
	{
		// FIXME: see issue #1
		$this->data->findFirstRow();

		ob_start();
		include(dirname(__FILE__) . '/templates/grid.inc.php');
		$display = ob_get_contents();
		ob_end_clean();

		return $display;
	}

	/**
	 * Returns the row value and also checks for the total column
	 *  id, if it matches the passed column, sum up the row value.
	 * @var $column GridColumn
	 * @var $row RowModel
	 * @return mixed The passed row value for the passed column.
	 */
	public function getRowValueByColumn($column, $row)
	{
		$columnId = $column->getId();

		// FIXME: see issue #1
		$value = $row->$columnId;

		if ($column->getShowTotal())
		{
			$column->setTotalValue($column->getTotalValue() + $value);
		}

		return $value;
	}

	/**
	 * Whether or not to show the footer.
	 * @return boolean
	 */
	private function showFooter()
	{
		$showFooter = false;
		// Check if any column wants to show the total.
		foreach ($this->columns as $column)
		{
			if ($column->getShowTotal())
			{
				$showFooter = true;
				break;
			}
		}

		return $showFooter;
	}

	/**
	 * Call reset methods on every column.
	 * @param $columns array
	 * @return array
	 */
	private function resetColumns($columns)
	{
		foreach ($columns as $column)
		{
			$column->resetColumn();
		}

		return $columns;
	}
}
?>
