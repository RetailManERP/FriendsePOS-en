		
		<div id="paypal-button-container" style="padding:30px;"></div>
     
		<script src="https://www.paypal.com/sdk/js?client-id=<?php echo e(config('paypal.client_id'), false); ?>&currency=<?php echo e($system_currency->code, false); ?>"></script>


<script>
paypal.Buttons({
	// Order is created on the server and the order id is returned
	createOrder() {
		const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
		return fetch("<?php echo e(route('paypalExpressCheckout'), false); ?>", {
			method: "POST",
			headers: {
			"Content-Type": "application/json",
			"X-CSRF-TOKEN": csrfToken,
			},
		// use the "body" param to optionally pass additional order information
		// like product skus and quantities
		body: JSON.stringify({
		  price: '<?php echo e($package->price, false); ?>',
		  package_name: '<?php echo e($package->name, false); ?>',
		}),
	  })
	  .then((response) => response.json())
	  .then((order) => order.id);
	},
	// Finalize the transaction on the server after payer approval
	onApprove(data) {
		
		const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	  	return fetch("<?php echo e(route('capturePaypalOrder'), false); ?>", {
		method: "POST",
		headers: {
		  "Content-Type": "application/json",
		  "X-CSRF-TOKEN": csrfToken,
		},
		body: JSON.stringify({
			orderID: data.orderID,
			package_id: "<?php echo e($package->id, false); ?>",
			gateway: "<?php echo e($v, false); ?>",
			business_id: "<?php echo e($user['business_id'], false); ?>",
			user_id: "<?php echo e($user['id'], false); ?>",
			coupon_code: "<?php echo e(request()->get('code') ?? null, false); ?>",
		})
	  })
	  .then((response) => response.json())
	  .then((responseData) => {
		if(responseData.success){
			toastr.success(responseData.msg);
			window.location.href = "<?php echo e(route('subscription.index'), false); ?>";
		}else{
			toastr.error(responseData.msg);
		}
	  });
	}
  }).render('#paypal-button-container');
</script>
