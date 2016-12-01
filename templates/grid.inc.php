<table class="form" <?php if ($this->getWidth()): ?> style='width:<?= $this->getWidth() ?>%'<?php endif; ?>>
	<thead>
		<tr>
			<?php foreach ($this->columns as $column): ?>
			<th class=label <?php if ($column->getWidth()): ?> style='width:<?= $column->getWidth() ?>%'<?php endif; ?>><?= $column->getTitle() ?></th>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
		<?php while ($row = $this->data->getRow()): ?>
			<tr>
			<?php foreach ($this->columns as $column): ?>
				<td><?= $this->getRowValueByColumn($column, $row) ?></td>
			<?php endforeach; ?>
			</tr>
		<?php endwhile; ?>
	</tbody>

	<?php if (!is_null($this->totalColumnId)): ?>
	<tfoot>
		<tr>
			<td colspan="<?= $this->getFooterColspan() ?>">Total: </td>
			<td><?= $this->getTotalValue() ?></td>
		</tr>
	</tfoot>
	<?php endif; ?>
</table>
<br>
