<?php

/**
 * @package plugins/kamego/grid
 * @version 1
 * @copyright © 2016 Next Solutions
 * @class GridCategory
 * @brief Represents a grid category that can be used to group rows.
 */

namespace Kamego\Grids;

class GridCategory
{

	/** @var string Grid category id. */
	private $id;

	/** @var string Grid category title. */
	private $title;

	/** @var RecordSet Data associated with the category. */
	private $recordSet;

	/**
	 * Constructor.
	 * @param $id string
	 * @param $title string
	 */
	public function __construct($id, $title, $recordSet)
	{
		$this->id = $id;
		$this->title = $title;
		$this->recordSet = $recordSet;
	}

	//
	// Getters and setters.
	//
	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @return RecordSet
	 */
	public function getRecordSet()
	{
		return $this->recordSet;
	}
}

