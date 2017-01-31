<!--
  @param $category optional It will restrict the total to the passed category.
//-->
<?php if (isset($category)) $column = null; ?>

<?php foreach ($this->columns as $index => $column): ?>
	<td style="text-align: <?php echo $column->getAlignFlag(); ?>">
		<?php if ($column->getShowRowsTotal()): ?>
			<?php echo $this->getColumnTotal($column, $category) ?></td>
		<?php endif; ?>
	</td>
<?php endforeach; ?>
