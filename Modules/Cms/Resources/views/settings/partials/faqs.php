<div class="pos-tab-content">
	<h4>
		<i class="fas fa-info-circle"></i>
		Add Frequently asked questions by your customer
	</h4> <br>
	<?php for($i=0;$i<6;$i++): ?>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
                    <?php echo Form::label('question_'.$i, __('cms::lang.question') . ':' ); ?>

                    <?php echo Form::textarea('faqs['.$i.'][question]', !empty($details['faqs'][$i]['question']) ? $details['faqs'][$i]['question'] : null, ['class' => 'form-control', 'rows' => 2, 'id' => 'question_'.$i]); ?>

               </div>
			</div>
			<div class="col-md-6">
				<?php echo Form::label('answer_'.$i, __('cms::lang.answer') . ':' ); ?>

				<?php echo Form::textarea('faqs['.$i.'][answer]', !empty($details['faqs'][$i]['answer']) ? $details['faqs'][$i]['answer'] : null, ['class' => 'form-control ', 'rows' => 2 ,'id' => 'answer_'.$i]); ?>

			</div>
		</div>
		<br/>
	<?php endfor; ?>
</div>
