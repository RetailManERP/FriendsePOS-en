<div class="direct-chat-msg">
  	<div class="direct-chat-info clearfix">
    	<span class="direct-chat-name float-start"><?php echo e($comment->added_by->user_full_name, false); ?></span>
    	<span class="direct-chat-timestamp float-end"><?php echo format_datetime_br($comment->created_at); ?></span>
  	</div>

  	<div class="direct-chat-text" style="margin-left: 0;">
    	<?php echo e($comment->comment, false); ?>


    	<?php if(auth()->user()->id == $comment->comment_by): ?>
    		<i class="delete-comment fa fa-trash float-end text-danger" style="cursor: pointer;" data-comment_id="<?php echo e($comment->id, false); ?>"></i>
    	<?php endif; ?>
  	</div>
</div>
