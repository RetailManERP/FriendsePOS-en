<?php
	$total_tasks = $project->tasks()->count();
	$completed_t = $project->tasks()->where('status', 'completed')->count();
	$in_progress_t = $project->tasks()->where('status', 'in_progress')->count();
	$not_started_t = $project->tasks()->where('status', 'not_started')->count();
	$progress = $total_tasks > 0 ? round(($completed_t / $total_tasks) * 100) : 0;
	$days_remaining = !empty($project->end_date) ? (int) \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($project->end_date), false) : null;
	$hours = floor(($timelog->total_seconds ?? 0) / 3600);
	$minutes = floor((($timelog->total_seconds ?? 0) / 60) % 60);
	$steps_budget_amount = isset($project->steps) ? (float) $project->steps->sum('budget') : 0;
	$budget_amount = !empty($project->budget) ? (float) $project->budget : $steps_budget_amount;
	$budget_consumed_val = isset($budget_consumed) ? (float) $budget_consumed : 0;
	$budget_remaining_val = $budget_amount - $budget_consumed_val;
	$budget_pct = $budget_amount > 0 ? min(round(($budget_consumed_val / $budget_amount) * 100), 999) : 0;
	$project_step_spends = $project_step_spends ?? [];
	$project_step_spent_total = array_sum($project_step_spends);
	$unassigned_project_spent = $budget_consumed_val - $project_step_spent_total;
?>

<div class="row">
	
	<div class="col-md-8">
		
		<div style="background:#fff;border-radius:12px;border:1px solid #e5e7eb;padding:20px;margin-bottom:16px;">
			<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
				<h4 style="font-size:13px;font-weight:600;color:#374151;margin:0;">
					<i class="fas fa-chart-pie" style="color:#3b82f6;margin-right:4px;"></i>
					<?php echo app('translator')->get('project::lang.task_progress'); ?>
				</h4>
				<span style="font-size:22px;font-weight:700;color:<?php if($progress >= 75): ?> #16a34a <?php elseif($progress >= 50): ?> #2563eb <?php elseif($progress >= 25): ?> #ca8a04 <?php else: ?> #9ca3af <?php endif; ?>;">
					<?php echo e($progress, false); ?>%
				</span>
			</div>
			<div style="width:100%;background:#f3f4f6;border-radius:9999px;height:10px;overflow:hidden;margin-bottom:16px;">
				<div style="height:100%;border-radius:9999px;background:<?php if($progress >= 75): ?> #22c55e <?php elseif($progress >= 50): ?> #3b82f6 <?php elseif($progress >= 25): ?> #eab308 <?php else: ?> #d1d5db <?php endif; ?>;width:<?php echo e($progress, false); ?>%;transition:width 0.7s;"></div>
			</div>
			<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;">
				<div style="text-align:center;padding:10px;border-radius:8px;background:#f9fafb;">
					<div style="font-size:18px;font-weight:700;color:#1f2937;"><?php echo e($total_tasks, false); ?></div>
					<div style="font-size:11px;color:#6b7280;font-weight:500;margin-top:2px;"><?php echo app('translator')->get('project::lang.total_tasks'); ?></div>
				</div>
				<div style="text-align:center;padding:10px;border-radius:8px;background:#f0fdf4;">
					<div style="font-size:18px;font-weight:700;color:#16a34a;"><?php echo e($completed_t, false); ?></div>
					<div style="font-size:11px;color:#16a34a;font-weight:500;margin-top:2px;"><?php echo app('translator')->get('project::lang.completed'); ?></div>
				</div>
				<div style="text-align:center;padding:10px;border-radius:8px;background:#eff6ff;">
					<div style="font-size:18px;font-weight:700;color:#2563eb;"><?php echo e($in_progress_t, false); ?></div>
					<div style="font-size:11px;color:#2563eb;font-weight:500;margin-top:2px;"><?php echo app('translator')->get('project::lang.in_progress'); ?></div>
				</div>
				<div style="text-align:center;padding:10px;border-radius:8px;background:#fefce8;">
					<div style="font-size:18px;font-weight:700;color:#ca8a04;"><?php echo e($project->incomplete_task, false); ?></div>
					<div style="font-size:11px;color:#ca8a04;font-weight:500;margin-top:2px;"><?php echo app('translator')->get('project::lang.incompleted_tasks'); ?></div>
				</div>
			</div>
		</div>

		
		<?php if($budget_amount > 0): ?>
		<?php
			$budget_bar_color = $budget_pct >= 100 ? '#dc2626' : ($budget_pct >= 75 ? '#ca8a04' : '#16a34a');
			$budget_text_color = $budget_pct >= 100 ? '#dc2626' : ($budget_pct >= 75 ? '#ca8a04' : '#16a34a');
		?>
		<div style="background:#fff;border-radius:12px;border:1px solid #e5e7eb;padding:20px;margin-bottom:16px;">
			<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
				<h4 style="font-size:13px;font-weight:600;color:#374151;margin:0;">
					<i class="fas fa-wallet" style="color:#16a34a;margin-right:4px;"></i>
					<?php echo app('translator')->get('project::lang.budget_overview'); ?>
				</h4>
				<span style="font-size:22px;font-weight:700;color:<?php echo e($budget_text_color, false); ?>;">
					<?php echo e($budget_pct, false); ?>%
				</span>
			</div>
			<div style="width:100%;background:#f3f4f6;border-radius:9999px;height:10px;overflow:hidden;margin-bottom:16px;">
				<div style="height:100%;border-radius:9999px;background:<?php echo e($budget_bar_color, false); ?>;width:<?php echo e(min($budget_pct, 100), false); ?>%;transition:width 0.7s;"></div>
			</div>
			<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;">
				<div style="text-align:center;padding:10px;border-radius:8px;background:#f0f9ff;">
					<div style="font-size:16px;font-weight:700;color:#0369a1;">
						<span class="display_currency" data-currency_symbol="true"><?php echo e($budget_amount, false); ?></span>
					</div>
					<div style="font-size:11px;color:#0369a1;font-weight:500;margin-top:2px;"><?php echo app('translator')->get('project::lang.budget'); ?></div>
				</div>
				<div style="text-align:center;padding:10px;border-radius:8px;background:#fef2f2;">
					<div style="font-size:16px;font-weight:700;color:#dc2626;">
						<span class="display_currency" data-currency_symbol="true"><?php echo e($budget_consumed_val, false); ?></span>
					</div>
					<div style="font-size:11px;color:#dc2626;font-weight:500;margin-top:2px;"><?php echo app('translator')->get('project::lang.budget_consumed'); ?></div>
				</div>
				<div style="text-align:center;padding:10px;border-radius:8px;background:<?php echo e($budget_remaining_val < 0 ? '#fee2e2' : '#f0fdf4', false); ?>;">
					<div style="font-size:16px;font-weight:700;color:<?php echo e($budget_remaining_val < 0 ? '#dc2626' : '#16a34a', false); ?>;">
						<span class="display_currency" data-currency_symbol="true"><?php echo e($budget_remaining_val, false); ?></span>
					</div>
					<div style="font-size:11px;color:<?php echo e($budget_remaining_val < 0 ? '#dc2626' : '#16a34a', false); ?>;font-weight:500;margin-top:2px;">
						<?php if($budget_remaining_val < 0): ?>
							<?php echo app('translator')->get('project::lang.over_budget'); ?>
						<?php else: ?>
							<?php echo app('translator')->get('project::lang.budget_remaining'); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>

		<?php if(isset($project->steps) && $project->steps->count() > 0): ?>
		<div style="background:#fff;border-radius:12px;border:1px solid #e5e7eb;padding:20px;margin-bottom:16px;">
			<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
				<h4 style="font-size:13px;font-weight:600;color:#374151;margin:0;">
					<i class="fas fa-layer-group" style="color:#2563eb;margin-right:4px;"></i>
					<?php echo app('translator')->get('project::lang.steps_budget_overview'); ?>
				</h4>
			</div>
			<div class="table-responsive">
				<table class="table table-condensed" style="margin-bottom:0;">
					<thead>
						<tr>
							<th><?php echo app('translator')->get('project::lang.step_name'); ?></th>
							<th class="text-right"><?php echo app('translator')->get('project::lang.step_budget'); ?></th>
							<th class="text-right"><?php echo app('translator')->get('project::lang.step_spent'); ?></th>
							<th class="text-right"><?php echo app('translator')->get('project::lang.step_remaining'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $__currentLoopData = $project->steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php
								$step_budget = (float) ($step->budget ?? 0);
								$step_spent = (float) ($project_step_spends[$step->id] ?? 0);
								$step_remaining = $step_budget - $step_spent;
							?>
							<tr>
								<td>
									<strong><?php echo e($step->name, false); ?></strong>
									<br><small class="text-muted"><?php echo app('translator')->get('project::lang.' . $step->status); ?></small>
								</td>
								<td class="text-right"><span class="display_currency" data-currency_symbol="true"><?php echo e($step_budget, false); ?></span></td>
								<td class="text-right"><span class="display_currency" data-currency_symbol="true"><?php echo e($step_spent, false); ?></span></td>
								<td class="text-right <?php echo e($step_remaining < 0 ? 'text-danger' : 'text-success', false); ?>">
									<span class="display_currency" data-currency_symbol="true"><?php echo e($step_remaining, false); ?></span>
								</td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php if(abs($unassigned_project_spent) > 0.0001): ?>
							<tr>
								<td><strong><?php echo app('translator')->get('project::lang.unassigned_project_expenses'); ?></strong></td>
								<td class="text-right">-</td>
								<td class="text-right"><span class="display_currency" data-currency_symbol="true"><?php echo e($unassigned_project_spent, false); ?></span></td>
								<td class="text-right">-</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
		<?php endif; ?>

		
		<?php $extra_stats_count = 0;
			if(isset($project->settings['enable_notes_documents']) && $project->settings['enable_notes_documents']) $extra_stats_count++;
			if(isset($project->settings['enable_timelog']) && $project->settings['enable_timelog']) $extra_stats_count++;
			// Invoice stats hidden for now; preserved here so they can be re-enabled later.
			// if((isset($project->settings['enable_invoice']) && $project->settings['enable_invoice']) && $is_lead_or_admin) $extra_stats_count += 2;
		?>
		<?php if($extra_stats_count > 0): ?>
		<div style="display:grid;grid-template-columns:repeat(<?php echo e(min($extra_stats_count, 4), false); ?>,1fr);gap:12px;margin-bottom:16px;">
			<?php if(isset($project->settings['enable_notes_documents']) && $project->settings['enable_notes_documents']): ?>
				<div style="background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:16px;text-align:center;">
					<div style="width:40px;height:40px;border-radius:50%;background:#e0e7ff;color:#4f46e5;display:flex;align-items:center;justify-content:center;margin:0 auto 8px auto;">
						<i class="fas fa-file-alt"></i>
					</div>
					<div style="font-size:18px;font-weight:700;color:#1f2937;"><?php echo e($project->note_and_documents_count, false); ?></div>
					<div style="font-size:12px;color:#6b7280;margin-top:2px;"><?php echo app('translator')->get('project::lang.documents_and_notes'); ?></div>
				</div>
			<?php endif; ?>
			<?php if(isset($project->settings['enable_timelog']) && $project->settings['enable_timelog']): ?>
				<div style="background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:16px;text-align:center;">
					<div style="width:40px;height:40px;border-radius:50%;background:#cffafe;color:#0891b2;display:flex;align-items:center;justify-content:center;margin:0 auto 8px auto;">
						<i class="fas fa-clock"></i>
					</div>
					<div style="font-size:18px;font-weight:700;color:#1f2937;"><?php echo e(sprintf('%02d:%02d', $hours, $minutes), false); ?></div>
					<div style="font-size:12px;color:#6b7280;margin-top:2px;"><?php echo app('translator')->get('project::lang.total_time'); ?></div>
				</div>
			<?php endif; ?>
			
			<?php if(false && (isset($project->settings['enable_invoice']) && $project->settings['enable_invoice']) && $is_lead_or_admin): ?>
				<div style="background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:16px;text-align:center;">
					<div style="width:40px;height:40px;border-radius:50%;background:#dcfce7;color:#16a34a;display:flex;align-items:center;justify-content:center;margin:0 auto 8px auto;">
						<i class="fas fa-money-bill-wave"></i>
					</div>
					<div style="font-size:18px;font-weight:700;color:#1f2937;">
						<span class="subtotal display_currency" data-currency_symbol="true"><?php echo e($invoice->paid, false); ?></span>
					</div>
					<div style="font-size:12px;color:#6b7280;margin-top:2px;"><?php echo app('translator')->get('project::lang.total_paid'); ?></div>
				</div>
				<div style="background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:16px;text-align:center;">
					<div style="width:40px;height:40px;border-radius:50%;background:#fee2e2;color:#dc2626;display:flex;align-items:center;justify-content:center;margin:0 auto 8px auto;">
						<i class="fas fa-exclamation-circle"></i>
					</div>
					<div style="font-size:18px;font-weight:700;color:#1f2937;">
						<span class="subtotal display_currency" data-currency_symbol="true"><?php echo e($transaction->total - $invoice->paid, false); ?></span>
					</div>
					<div style="font-size:12px;color:#6b7280;margin-top:2px;"><?php echo app('translator')->get('project::lang.total_due'); ?></div>
				</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>

		
		<div style="background:#fff;border-radius:12px;border:1px solid #e5e7eb;padding:20px;">
			<h4 style="font-size:13px;font-weight:600;color:#374151;margin:0 0 12px 0;">
				<i class="fas fa-align-left" style="color:#9ca3af;margin-right:4px;"></i>
				<?php echo app('translator')->get('project::lang.description'); ?>
			</h4>
			<?php if(!empty($project->description)): ?>
				<div style="font-size:13px;color:#4b5563;line-height:1.6;"><?php echo $project->description; ?></div>
			<?php else: ?>
				<p style="color:#9ca3af;font-size:13px;font-style:italic;margin:0;"><?php echo app('translator')->get('project::lang.no_description'); ?></p>
			<?php endif; ?>
		</div>
	</div>

	
	<div class="col-md-4">
		
		<div class="project-panel">
			<div class="project-panel-header">
				<h4>
					<i class="fas fa-info-circle"></i>
					<?php echo app('translator')->get('project::lang.project_details'); ?>
				</h4>
			</div>
			<div class="project-panel-body">
				
				<div style="display:flex;align-items:center;justify-content:space-between;padding:8px 0;border-bottom:1px solid #f3f4f6;">
					<span style="font-size:12px;color:#6b7280;font-weight:500;"><?php echo app('translator')->get('sale.status'); ?></span>
					<?php
						$statusStyles = [
							'not_started' => 'background:#f3f4f6;color:#4b5563;',
							'in_progress' => 'background:#dbeafe;color:#1d4ed8;',
							'on_hold'     => 'background:#fef9c3;color:#92400e;',
							'cancelled'   => 'background:#fee2e2;color:#dc2626;',
							'completed'   => 'background:#dcfce7;color:#15803d;',
						];
					?>
					<span style="display:inline-flex;align-items:center;padding:3px 10px;border-radius:9999px;font-size:11px;font-weight:500;<?php echo e($statusStyles[$project->status] ?? '', false); ?>">
						<?php echo app('translator')->get('project::lang.'.$project->status); ?>
					</span>
				</div>
				
				<div style="display:flex;align-items:center;justify-content:space-between;padding:8px 0;border-bottom:1px solid #f3f4f6;">
					<span style="font-size:12px;color:#6b7280;font-weight:500;"><?php echo app('translator')->get('project::lang.lead'); ?></span>
					<span style="font-size:12px;color:#1f2937;font-weight:500;">
						<i class="fas fa-user-tie" style="color:#9ca3af;margin-right:4px;"></i><?php echo e($project->lead->user_full_name, false); ?>

					</span>
				</div>
				
				<?php if(isset($project->customer->name)): ?>
					<div style="display:flex;align-items:center;justify-content:space-between;padding:8px 0;border-bottom:1px solid #f3f4f6;">
						<span style="font-size:12px;color:#6b7280;font-weight:500;"><?php echo app('translator')->get('role.customer'); ?></span>
						<span style="font-size:12px;color:#1f2937;font-weight:500;">
							<i class="fa fa-briefcase" style="color:#9ca3af;margin-right:4px;"></i><?php echo e($project->customer->name, false); ?>

						</span>
					</div>
					<?php if(isset($project->customer->mobile)): ?>
						<div style="display:flex;align-items:center;justify-content:space-between;padding:8px 0;border-bottom:1px solid #f3f4f6;">
							<span style="font-size:12px;color:#6b7280;font-weight:500;"><?php echo app('translator')->get('contact.mobile'); ?></span>
							<span style="font-size:12px;color:#1f2937;"><?php echo e($project->customer->mobile, false); ?></span>
						</div>
					<?php endif; ?>
				<?php endif; ?>
				
				<?php if(isset($project->start_date)): ?>
					<div style="display:flex;align-items:center;justify-content:space-between;padding:8px 0;border-bottom:1px solid #f3f4f6;">
						<span style="font-size:12px;color:#6b7280;font-weight:500;"><?php echo app('translator')->get('business.start_date'); ?></span>
						<span style="font-size:12px;color:#1f2937;"><?php echo e(\Carbon::createFromTimestamp(strtotime($project->start_date))->format(session('business.date_format')), false); ?></span>
					</div>
				<?php endif; ?>
				<?php if(isset($project->end_date)): ?>
					<div style="display:flex;align-items:flex-start;justify-content:space-between;padding:8px 0;border-bottom:1px solid #f3f4f6;">
						<span style="font-size:12px;color:#6b7280;font-weight:500;"><?php echo app('translator')->get('project::lang.end_date'); ?></span>
						<span style="font-size:12px;font-weight:500;text-align:right;color:<?php echo e((!is_null($days_remaining) && $days_remaining < 0 && $project->status != 'completed') ? '#dc2626' : '#1f2937', false); ?>;">
							<?php echo e(\Carbon::createFromTimestamp(strtotime($project->end_date))->format(session('business.date_format')), false); ?>

							<?php if(!is_null($days_remaining) && $project->status != 'completed'): ?>
								<br><small style="color:<?php echo e($days_remaining < 0 ? '#dc2626' : ($days_remaining == 0 ? '#ca8a04' : '#16a34a'), false); ?>;">
									<?php if($days_remaining < 0): ?>(<?php echo e(abs($days_remaining), false); ?> <?php echo app('translator')->get('project::lang.days_overdue'); ?>)
									<?php elseif($days_remaining == 0): ?>(<?php echo app('translator')->get('home.today'); ?>)
									<?php else: ?>
									<?php endif; ?>
								</small>
							<?php endif; ?>
						</span>
					</div>
				<?php endif; ?>
				
				<?php if($budget_amount > 0): ?>
					<div style="display:flex;align-items:center;justify-content:space-between;padding:8px 0;border-bottom:1px solid #f3f4f6;">
						<span style="font-size:12px;color:#6b7280;font-weight:500;"><?php echo app('translator')->get('project::lang.budget'); ?></span>
						<span style="font-size:12px;color:#1f2937;font-weight:500;">
							<i class="fas fa-wallet" style="color:#16a34a;margin-right:4px;"></i>
							<span class="display_currency" data-currency_symbol="true"><?php echo e($budget_amount, false); ?></span>
						</span>
					</div>
				<?php endif; ?>
				
				<?php if($project->categories->count() > 0): ?>
					<div style="display:flex;align-items:flex-start;justify-content:space-between;padding:8px 0;border-bottom:1px solid #f3f4f6;">
						<span style="font-size:12px;color:#6b7280;font-weight:500;"><?php echo app('translator')->get('project::lang.category'); ?></span>
						<div style="display:flex;flex-wrap:wrap;gap:4px;justify-content:flex-end;">
							<?php $__currentLoopData = $project->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<span style="display:inline-flex;align-items:center;padding:2px 8px;border-radius:9999px;font-size:11px;font-weight:500;background:#f3e8ff;color:#7c3aed;"><?php echo e($category->name, false); ?></span>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
				<?php endif; ?>
				
				<?php $fields = json_decode($busines->prj_setting) ?? []; $fields = $fields->custom_fields ?? []; ?>
				<?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if(!empty($project->$key)): ?>
						<div style="display:flex;align-items:center;justify-content:space-between;padding:8px 0;border-bottom:1px solid #f3f4f6;">
							<span style="font-size:12px;color:#6b7280;font-weight:500;"><?php echo e($field, false); ?></span>
							<span style="font-size:12px;color:#1f2937;"><?php echo e($project->$key, false); ?></span>
						</div>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
				<?php
					$project_address = implode(', ', array_filter([
						$project->address_line_1,
						$project->address_line_2,
						$project->city,
						$project->state,
						$project->country,
						$project->zip_code,
					]));
					$customer_address = isset($project->customer) ? implode(', ', array_filter([
						$project->customer->address_line_1,
						$project->customer->address_line_2,
						$project->customer->city,
						$project->customer->state,
						$project->customer->country,
						$project->customer->zip_code,
					])) : '';
				?>
				<?php if(!empty($project_address) || !empty($customer_address)): ?>
					<div style="padding:8px 0;">
						<span style="font-size:12px;color:#6b7280;font-weight:500;display:block;margin-bottom:4px;"><?php echo app('translator')->get('business.address'); ?></span>
						<span style="font-size:12px;color:#374151;">
							<?php echo e(!empty($project_address) ? $project_address : $customer_address, false); ?>

						</span>
					</div>
				<?php endif; ?>
			</div>
		</div>

		
		<div style="background:#fff;border-radius:12px;border:1px solid #e5e7eb;overflow:hidden;">
			<div style="padding:12px 20px;border-bottom:1px solid #f3f4f6;">
				<h4 style="font-size:13px;font-weight:600;color:#374151;margin:0;">
					<i class="fas fa-users" style="color:#9ca3af;margin-right:4px;"></i>
					<?php echo app('translator')->get('project::lang.team_members'); ?>
					<span style="font-size:11px;font-weight:400;color:#9ca3af;margin-left:4px;">(<?php echo e($project->members->count(), false); ?>)</span>
				</h4>
			</div>
			<div style="padding:16px;">
				<div>
					<?php $__currentLoopData = $project->members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div style="display:flex;align-items:center;gap:10px;padding:4px 0;">
							<?php if(isset($member->media->display_url)): ?>
								<img src="<?php echo e($member->media->display_url, false); ?>" alt="<?php echo e($member->user_full_name, false); ?>"
									style="width:32px;height:32px;border-radius:50%;object-fit:cover;border:1px solid #e5e7eb;flex-shrink:0;display:block;">
							<?php else: ?>
								<div style="width:32px;height:32px;border-radius:50%;background:#3b82f6;color:#fff;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:600;flex-shrink:0;">
									<?php echo e(strtoupper(substr($member->first_name, 0, 1)), false); ?><?php echo e(strtoupper(substr($member->last_name ?? '', 0, 1)), false); ?>

								</div>
							<?php endif; ?>
							<div style="min-width:0;">
								<div style="font-size:12px;font-weight:500;color:#1f2937;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?php echo e($member->user_full_name, false); ?></div>
								<?php if($project->lead_id == $member->id): ?>
									<span style="font-size:10px;color:#2563eb;font-weight:500;"><?php echo app('translator')->get('project::lang.lead'); ?></span>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
