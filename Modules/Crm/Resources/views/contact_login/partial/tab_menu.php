<input type="hidden" id="contact_id_for_login" value="<?php echo e($contact->id, false); ?>">
<li class="nav-item ps-3 pe-3 p-2">
   <a class="nav-link" href="#login" data-bs-toggle="tab" role="tab" aria-expanded="true">
       <i class="fas fa-user-plus"></i>
       <?php echo app('translator')->get('crm::lang.contact_persons'); ?>
   </a> 
</li>
