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

	<?php if ($this->showFooter()): ?>
	<tfoot>
		<tr>
			<td>Total: </td>
			<?php foreach ($this->columns as $index => $column): ?>
				<?php if ($index === 0) continue; ?>
				<?php if ($column->getShowTotal()): ?>
					<td><?= $column->getTotalValue() ?></td>
				<?php else: ?>
					<td></td>
				<?php endif; ?>
			<?php endforeach; ?>
		</tr>
	</tfoot>
	<?php endif; ?>
</table>
<br>
