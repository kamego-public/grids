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

	/** @var string Total column title. */
	private $totalColumnTitle;

	/**
	 * Constructor.
	 * @param $id string Grid id.
	 * @param $title string Grid title used in UI.
	 * @param $columns array Elements need to be instances of GridColumn.
	 * @param $recordSet Recordset
	 */
	public function __construct($id, $title, $columns, $recordSet)
	{
		$this->id = $id;
		$this->title = $title;
		$this->columns = $this->resetColumns($columns);
		$this->recordSet = $recordSet;
		$this->width = null;
		$this->displayRowTotals = true;
		$this->rows = array();
		$this->setTotalColumnTitle('Total');

		$this->setupRows($recordSet, $this->columns);
	}

	/**
	 * setupRows
	 * @param $recordSet
	 * @param $columns
	 */
	private function setupRows($recordSet, $columns)
	{
		$recordSet->findFirstRow();
		$this->rows = array();
		while($row = $recordSet->getRow())
		{
			$this->rows[] = new GridRow($row, $columns, true);
		}
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
	 * @param string
	 */
	public function setTotalColumnTitle($totalColumnTitle)
	{
		$this->totalColumnTitle = $totalColumnTitle;
	}

	/**
	 * @return string
	 */
	public function getTotalColumnTitle()
	{
		return $this->totalColumnTitle;
	}

	/**
	 * Render the grid HTML markup.
	 * @return string
	 */
	public function render()
	{
		// FIXME: see issue #1
		$this->recordSet->findFirstRow();

		ob_start();
		include(dirname(__FILE__) . '/templates/grid.inc.php');
		$display = ob_get_contents();
		ob_end_clean();

		return $display;
	}

	public function getColumnTotal($column)
	{
		$total = 0;
		foreach ($this->rows as $row)
		{
			$total += $row->getValueByColumn($column);
		}
		return $total;
	}
	/**
	 * @return int
	 */
	public function getGrandTotal()
	{
		$total = 0;
		foreach ($this->rows as $row)
		{
			$total += $row->getRowTotal();
		}
		return $total;
	}

	/**
	 * Whether or not to show the footer.
	 * @return boolean
	 */
	protected function showFooter()
	{
		$showFooter = false;
		// Check if any column wants to show the total.
		foreach ($this->columns as $column)
		{
			if ($column->getShowRowsTotal())
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
	protected function resetColumns($columns)
	{
		foreach ($columns as $column)
		{
			$column->resetColumn();
		}

		return $columns;
	}
}
?>
