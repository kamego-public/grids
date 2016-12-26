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

	/** @var array Categories. */
	private $categories;

	/** @var Recordset Grid data. */
	private $data;

	/** @var int Grid width percentage. */
	private $width;

	/** @var boolean Display row totals flag */
	private $displayRowTotals;

	/** @var string Total column title. */
	private $totalColumnTitle;

	/**
	 * Constructor.
	 * @param $id string Grid id.
	 * @param $title string Grid title used in UI.
	 * @param $columns array Elements need to be instances of GridColumn.
	 * @param $recordSet Recordset optional Can be null if categories are used.
	 * @param $categories Array GridCategory objects, each with its own record sets.
	 */
	public function __construct($id, $title, $columns, $recordSet = null, $categories = array())
	{
		$this->id = $id;
		$this->title = $title;
		$this->columns = $this->resetColumns($columns);
		$this->recordSet = $recordSet;
		$this->categories = $categories;
		$this->width = null;
		$this->setDisplayRowTotals(true);
		$this->rows = array();
		$this->setTotalColumnTitle('Total');

		$this->setupRows($recordSet, $this->columns);
	}

	/**
	 * Set the display row totals flag.
	 * @param $displayRowTotals boolean
	 */
	public function setDisplayRowTotals($displayRowTotals)
	{
		$this->displayRowTotals = (boolean) $displayRowTotals;
	}

	/**
	 * setupRows
	 * @param $recordSet
	 * @param $columns
	 */
	private function setupRows($recordSet, $columns)
	{
		if ($this->recordSet)
		{
			$category = new GridCategory('default', 'default', $this->recordSet);
			array_unshift($this->categories, $category);
		}

		foreach ($this->categories as $category)
		{
			$this->createRows($category->getId(), $category->getRecordSet());
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

	/**
	 * Get the number of columns this grid will render.
	 * @return int
	 */
	protected function getColumnsCount()
	{
		$columnsCount = count($this->columns);
		if ($this->displayRowTotals)
		{
			$columnsCount++;
		}

		return $columnsCount;
	}

	/**
	 * Create the grid row objects.
	 * @param $categoryId string
	 * @param $recordSet RecordSet
	 */
	private function createRows($categoryId, $recordSet)
	{
		$columns = $this->columns;
		$recordSet->findFirstRow();
		$this->rows[$categoryId] = array();
		while($row = $recordSet->getRow())
		{
			$this->rows[$categoryId][] = new GridRow($row, $columns, true);
		}
	}
}
?>
