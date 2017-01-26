<table class="form" <?php if ($this->getWidth()): ?> style='width:<?php echo $this->getWidth() ?>%'<?php endif; ?>>
	<thead>
		<tr>
			<?php foreach ($this->columns as $column): ?>
				<th class=label <?php if ($column->getWidth()): ?> style='width:<?php echo $column->getWidth() ?>%'<?php endif; ?>><?php echo $column->getTitle() ?></th>
			<?php endforeach; ?>
			<?php if ($this->displayRowTotals): ?>
                <th class=label><?php echo $this->getTotalColumnTitle() ?></th>
			<?php endif; ?>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($this->categories as $category): ?>
			<?php if ($category->getId() !== 'default'): ?>
				<tr>
					<td class="category" colspan="<?php echo $this->getColumnsCount() ?>"><?php echo $category->getTitle() ?> </td>
				</tr>
			<?php endif; ?>
			<?php if (empty($this->rows[$category->getId()])): ?>
				<tr>
					<td colspan="<?php echo $this->getColumnsCount() ?>"><?php echo $this->getEmptyGridText() ?></td>
				</tr>
			<?php endif; ?>
			<?php foreach ($this->rows[$category->getId()] as $row): ?>
				<tr>
				<?php foreach ($this->columns as $column): ?>
					<td><?php echo $row->getContent($column); ?></td>
				<?php endforeach; ?>
				<?php if ($this->displayRowTotals): ?>
					<td><?php echo $row->getRowTotal(); ?></td>
				<?php endif; ?>
				</tr>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</tbody>

	<?php if ($this->showFooter()): ?>
	<tfoot>
		<tr>
			<td>Total: </td>
			<?php foreach ($this->columns as $index => $column): ?>
				<?php if ($index === 0) continue; ?>
				<?php if ($column->getShowRowsTotal()): ?>
					<td><?php echo $this->getColumnTotal($column) ?></td>
				<?php else: ?>
					<td></td>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php if ($this->displayRowTotals): ?>
                <td><?php echo $this->getGrandTotal(); ?></td>
			<?php endif; ?>
		</tr>
	</tfoot>
	<?php endif; ?>
</table>
<br>
