<?php
// auto-generated by sfPropelCrud
// date: 2009/01/01 18:26:05
?>
<?php use_helper('Object') ?>

<?php echo form_tag('tag/update') ?>

<?php echo object_input_hidden_tag($tag, 'getId') ?>

<table>
<tbody>
<tr>
  <th>Tag:</th>
  <td><?php echo object_input_tag($tag, 'getTag', array (
  'size' => 64,
)) ?></td>
</tr>
<tr>
  <th>Stripped tag:</th>
  <td><?php echo object_input_tag($tag, 'getStrippedTag', array (
  'size' => 80,
)) ?></td>
</tr>
<tr>
  <th>Created by:</th>
  <td><?php echo object_input_tag($tag, 'getCreatedBy', array (
  'size' => 7,
)) ?></td>
</tr>
</tbody>
</table>
<hr />
<?php echo submit_tag('save') ?>
<?php if ($tag->getId()): ?>
  &nbsp;<?php echo link_to('delete', 'tag/delete?id='.$tag->getId(), 'post=true&confirm=Are you sure?') ?>
  &nbsp;<?php echo link_to('cancel', 'tag/show?id='.$tag->getId()) ?>
<?php else: ?>
  &nbsp;<?php echo link_to('cancel', 'tag/list') ?>
<?php endif; ?>
</form>
