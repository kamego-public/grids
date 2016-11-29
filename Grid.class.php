<?php

/**
 * @package plugins/kamego/grid
 * @version 1
 * @copyright © 2016 Next Solutions
 * @class Grid
 * @brief Represents a grid object, that is capable of rendering
 *  a simple HTML grid with the passed columns and data.
 */

include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'GridColumn.class.php');

class Grid
{

	/** @var string Grid id. */
	protected $id;

	/** @var string Grid title. */
	protected $title;

	/** @var array Grid columns. */
	protected $columns;

	/** @var string The column id to be used to generate total value. */
	protected $totalColumnId = null;

	/** @var Recordset Grid data. */
	protected $data;

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
		$this->columns = $columns;
		$this->data = $data;
	}

	/**
	 * Set the column to be used to generate total value.
	 * @param $columnId string One of the grid columns id.
	 */
	public function setTotalColumnId($columnId)
	{
		$this->totalColumnId = $columnId;
	}

	/**
	 * Render the grid HTML markup.
	 * @return string
	 */
	public function render()
	{
		$display = '';
		$display .= '<table class="form">
							<thead>
								<tr>';

		foreach ($this->columns as $column)
		{
			$display .= "<th class=label style='width:200px'>" . $column->getTitle() . '</th>';
		}

		$display .= '		</tr>
						</thead>
					<tbody>';

		$totalValue = 0;
		$this->data->findFirstRow();
		while ($row = $this->data->getRow())
		{
			$display .= '<tr>';
			foreach ($this->columns as $column)
			{
				$columnId = $column->getId();
				$value = $row->$columnId;
				if ($columnId == $this->totalColumnId)
				{
					$totalValue += intval($value);
				}
				$display .= "<td>{$value}</td>";
			}
			$display .= '</tr>';
		}

		$display .= '</tbody>';

		if (!is_null($this->totalColumnId))
		{
			$display .= "<tfoot>
							<tr>
								<td>Total: </td>
								<td>$totalValue</td>
							</tr>
						</tfoot>";
		}

		$display .= "</table><br>";

		return $display;
	}
}
?>
