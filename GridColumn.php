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

	/**
	 * Constructor.
	 * @param $id string Colum id.
	 * @param $title string Column title used in UI.
	 */
	public function __construct($id, $title)
	{
		$this->id = $id;
		$this->title = $title;
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
}
?>
