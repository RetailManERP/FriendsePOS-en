<script type="text/javascript">
const pakistanSalaryTaxSlabs = <?php echo json_encode($salary_tax_slabs ?? [], 15, 512) ?>;

function calculatePakistanSalaryTax(annualIncome) {
    let lowerLimit = 0;
    for (const slab of pakistanSalaryTaxSlabs) {
        const upperLimit = slab[0];
        if (upperLimit === null || annualIncome <= upperLimit) {
            return Math.max(0, Number(slab[1]) + ((annualIncome - lowerLimit) * Number(slab[2])));
        }
        lowerLimit = upperLimit;
    }
    return 0;
}

$(document).ready( function () {

	//add allowance row
	$('.add_allowance').click( function() {
        let id = $(this).parent().parent().parent().parent().data('id');
        $this = $(this);
        $.ajax({
            method: "GET",
            dataType: "html",
            data:{
                'employee_id': id,
                'type': 'allowance'
            },
            url: '/hrm/get-allowance-deduction-row',
            success: function(result){
                $this.closest('.allowance_table tbody').append(result);
            }
        });
    });

	//add deduction row
    $('.add_deduction').click( function() {
        let id = $(this).parent().parent().parent().parent().data('id');
        $this = $(this);
        $.ajax({
            method: "GET",
            dataType: "html",
            data:{
                'employee_id': id,
                'type': 'deduction'
            },
            url: '/hrm/get-allowance-deduction-row',
            success: function(result){
                $this.closest('.deductions_table tbody').append(result);
            }
        });
    });

    //remove allowance/deduction row
    $(document).on('click', 'button.remove_tr', function(){
        let id = $(this).parent().parent().parent().parent().data('id');
        $(this).closest('tr').remove();
        calculateTotal(id);
        calculateTotalGrossAmount();
    });

    //toggle allowance/deduction amount type
    $(document).on('change', '.amount_type', function(){
	    let tr = $(this).closest('tr');
	    if ($(this).val() == 'percent') {
	        tr.find('.percent_field').removeClass('hide');
	        tr.find('.value_field').attr('readonly', true);
	    } else {
	        tr.find('.percent_field').addClass('hide');
	        tr.find('.value_field').removeAttr('readonly');
	    }
	});

    //calculate amount per unit duration
	$(document).on('change', '.total', function() {
        let total_duration = __read_number($(this).closest('td').find('input.essentials_duration'));
        let total = __read_number($(this));
        let amount_per_unit_duration = total / total_duration;
        __write_number($(this).closest('td').find('input.essentials_amount_per_unit_duration'), amount_per_unit_duration, false, 2);
        calculateTotal($(this).data('id'));
        calculateTotalGrossAmount();
    });

    $(document).on('change', '.essentials_duration, .essentials_amount_per_unit_duration, input.allowance, input.deduction, input.percent', function() {
        let id = $(this).data('id');
        if ($(this).hasClass('allowance') || $(this).hasClass('deduction')) {
            id = $(this).parent().parent().parent().parent().data('id');
        } else if ($(this).hasClass('percent')) {
            id = $(this).parent().parent().parent().parent().parent().data('id');
        }
        calculateTotal(id);
        calculateTotalGrossAmount();
    });

    $(document).on('change', '.attendence_days', function() {
        let id = $(this).data('id');
        let days_worked = $(this).val();
        let days_in_month = $("input#days_in_month_"+id).val();
        let total_duration_unit = $("input#essentials_duration_unit_"+id).val();
        let total_work_duration = 0;

        if(total_duration_unit == 'Month'){
            total_work_duration = days_worked / days_in_month;
        }else if(total_duration_unit == 'Day'){
            total_work_duration = days_worked;
        }else if(total_duration_unit == 'Week'){
            total_work_duration = days_worked / (days_in_month / 4);
        }
        
        //__write_number($("input#essentials_duration_"+id), total_work_duration);
        $("input#essentials_duration_" + id).val(total_work_duration.toFixed(2));
        calculateTotal(id);
        calculateTotalGrossAmount();
    });

    $(document).on('change', '.leaves', function() {
        let id = $(this).data('id');
        let leaves = parseFloat($(this).val());
        let total_days_worked = parseFloat($("input#total_days_worked_"+id).val());
        let days_worked = total_days_worked + leaves;
        $("input#attendance_days_"+id).val(days_worked).trigger('change');
    });

    $(document).on('change', '.work_duration', function() {
        let id = $(this).data('id');
        let work_duration = parseFloat($(this).val());
        let shift_hours = parseFloat($("input#shift_hours_" + id).val());

        if (!isNaN(work_duration)) {
            let hours_per_day = !isNaN(shift_hours) && shift_hours > 0 ? shift_hours : 8;
            let days_worked = work_duration / hours_per_day;
            
            // Optionally round to 2 decimal places if needed
            days_worked = days_worked.toFixed(2);

            // Set the value of the attendance days input
            $("input#attendance_days_" + id).val(days_worked).trigger('change');
        }
    });

    function calculateTotal (id) {
        //calculate basic salary
    	let total_duration = __read_number($("input#essentials_duration_"+id));
	    let amount_per_unit_duration = __read_number($("input#essentials_amount_per_unit_duration_"+id));
	    let total = total_duration * amount_per_unit_duration;
	    __write_number($("input#total_"+id), total, false, 2);

        //calculate total allownace
        let total_allowance = 0;
        $("table#allowance_table_"+id).find('tbody tr').each(function () {
            let type = $(this).find('.amount_type').val();
            if (type == 'percent') {
                let percent = __read_number($(this).find('.percent'));
                let row_total = __calculate_amount('percentage', percent, total);
                __write_number($(this).find('input.allowance'), row_total);
            }
            total_allowance += __read_number($(this).find('input.allowance'));
        });
        $('#total_allowances_'+id).text(__currency_trans_from_en(total_allowance, true));

        //calculate total deduction
        let total_deduction = 0;
        $('table#deductions_table_'+id).find('tbody tr').each( function(){
            let type = $(this).find('.amount_type').val();
            if (type == 'percent') {
                let percent = __read_number($(this).find('.percent'));
                let row_total = __calculate_amount('percentage', percent, total);
                __write_number($(this).find('input.deduction'), row_total);
            }
            total_deduction += __read_number($(this).find('input.deduction'));
        });
        $('#total_deductions_'+id).text(__currency_trans_from_en(total_deduction, true));

        let pre_tax_amount = total + total_allowance - total_deduction;
        let card = $("#payroll_table .card[data-id='"+id+"']");
        let salary_tax = 0;
        if (Number(card.data('tax-enabled')) === 1) {
            let annual_income = Math.max(0, ((total + total_allowance) * 12) + Number(card.data('annual-tax-adjustment') || 0));
            salary_tax = calculatePakistanSalaryTax(annual_income) / 12;
        }
        let net_pay = Math.max(0, pre_tax_amount - salary_tax);
        $('#gross_amount_'+id).val(pre_tax_amount);
        $('#pre_tax_amount_text_'+id).text(__currency_trans_from_en(pre_tax_amount, true));
        $('#salary_tax_text_'+id).text(__currency_trans_from_en(salary_tax, true));
        $('#gross_amount_text_'+id).text(__currency_trans_from_en(net_pay, true));
        $('#net_amount_'+id).val(net_pay);
    }

    function calculateTotalGrossAmount () {
        let total_gross_amount = 0;
        $("input.net_amount").each(function () {
            let gross_amount = __read_number($(this));
            total_gross_amount += gross_amount;
        });
        $('#total_gross_amount').val(total_gross_amount);
    }

    $("#payroll_table .card[data-id]").each(function () {
        calculateTotal($(this).data('id'));
        calculateTotalGrossAmount();
    });
});
</script>
