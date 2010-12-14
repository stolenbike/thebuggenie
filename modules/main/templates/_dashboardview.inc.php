<?php switch($type):
		  case TBGDashboard::DASHBOARD_VIEW_PREDEFINED_SEARCH : ?>
	<?php case TBGDashboard::DASHBOARD_VIEW_SAVED_SEARCH : ?>
			<?php include_component('search/results_view',  array_merge($parameters, array('search' => true, 'default_message' => 'No issue'))); ?>
	<?php break; ?>		
	
	<?php case TBGDashboard::DASHBOARD_VIEW_LOGGED_ACTION : ?>
		<div class="rounded_box mediumgrey borderless cut_bottom" style="margin-top: 5px; font-weight: bold; font-size: 13px;">
			<?php echo image_tag('collapse.png', array('id' => 'dashboard_'.$id.'_collapse', 'onclick' => "Effect.toggle('dashboard_{$id}', 'slide'); this.src = (this.src == '" . image_url('collapse.png', false, 'core', false) . "') ? '" . image_url('expand.png', false, 'core', false) . "' : '" . image_url('collapse.png', false, 'core', false) . "'")); ?>
			<?php echo __('What you\'ve done recently'); ?>
		</div>
		<div id="dashboard_<?php echo $id; ?>">
		<?php if (count($tbg_user->getLatestActions()) > 0): ?>
			<table cellpadding=0 cellspacing=0 style="margin: 5px;">
				<?php $prev_date = null; ?>
				<?php foreach ($tbg_user->getLatestActions() as $action): ?>
					<?php $date = tbg_formatTime($action['timestamp'], 5); ?>
					<?php if ($date != $prev_date): ?>
						<tr>
							<td class="latest_action_dates" colspan="2"><?php echo $date; ?></td>
						</tr>
					<?php endif; ?>
					<?php include_component('main/logitem', array('log_action' => $action, 'include_project' => true, 'pad_length' => 60)); ?>
					<?php $prev_date = $date; ?>
				<?php endforeach; ?>
			</table>
		<?php else: ?>
			<div class="faded_out" style="padding: 5px 5px 15px 5px;"><?php echo __("You haven't done anything recently"); ?></div>
		<?php endif; ?>
		</div>
	<?php break; ?>
	
<?php endswitch;?>

<?php TBGEvent::createNew('core', 'dashboard_main_' . $id)->trigger(); ?>