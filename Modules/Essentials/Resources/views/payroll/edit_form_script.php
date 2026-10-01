<div class="hide" >
    <div class="table-responsive">
<table id="hidden_allowance_table"><?php echo $__env->make('essentials::payroll.edit_allowance_and_deduction_row', ['type' => 'allowance'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></table>
</div>
</div>
<div class="hide" >
    <div class="table-responsive">
<table id="hidden_deduction_table"><?php echo $__env->make('essentials::payroll.edit_allowance_and_deduction_row', ['type' => 'deduction'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></table>
</div>
</div>
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
    $('.add_allowance').click( function() {
        var html = $('table#hidden_allowance_table tbody').html();
        $('#allowance_table tbody').append(html);
    });

    $('.add_deduction').click( function() {
        var html = $('table#hidden_deduction_table tbody').html();
        $('#deductions_table tbody').append(html);
    });

    $(document).on('click', 'button.remove_tr', function(){
        $(this).closest('tr').remove();
        calculateTotal();
    });
    $(document).on('change', '#essentials_duration, #essentials_amount_per_unit_duration, input.allowance, input.deduction, input.percent', function() {
        calculateTotal();
    });
    $(document).on('change', '#total', function() {
        var total_duration = __read_number($('#essentials_duration'));

        var total = __read_number($(this));

        var amount_per_unit_duration = total / total_duration;
        __write_number($('#essentials_amount_per_unit_duration'), amount_per_unit_duration, false, 2);
    });
    calculateTotal();
});

function calculateTotal() {
    var total_duration = __read_number($('#essentials_duration'));
    var amount_per_unit_duration = __read_number($('#essentials_amount_per_unit_duration'));
    var total = total_duration * amount_per_unit_duration;
    __write_number($('#total'), total, false, 2);

    var total_allowance = 0;
    $('input.allowance').each( function(){
        var tr = $(this).closest('tr');
        var type = tr.find('.amount_type').val();
        if (type == 'percent') {
            var percent = __read_number(tr.find('.percent'));
            var row_total = __calculate_amount('percentage', percent, total);
            __write_number($(this), row_total);
        }

        total_allowance += __read_number($(this));
        
    });
    $('#total_allowances').text(__currency_trans_from_en(total_allowance, true));

    var total_deduction = 0;
    $('input.deduction').each( function(){
        var tr = $(this).closest('tr');
        var type = tr.find('.amount_type').val();
        if (type == 'percent') {
            var percent = __read_number(tr.find('.percent'));
            var row_total = __calculate_amount('percentage', percent, total);
            __write_number($(this), row_total);
        }

        total_deduction += __read_number($(this));
    });
    $('#total_deductions').text(__currency_trans_from_en(total_deduction, true));

    let pre_tax_amount = total + total_allowance - total_deduction;
    let tax_data = $('#payroll_tax_data');
    let salary_tax = 0;
    if (Number(tax_data.data('tax-enabled')) === 1) {
        let annual_income = Math.max(0, ((total + total_allowance) * 12) + Number(tax_data.data('annual-tax-adjustment') || 0));
        salary_tax = calculatePakistanSalaryTax(annual_income) / 12;
    }
    let net_pay = Math.max(0, pre_tax_amount - salary_tax);
    $('#gross_amount').val(pre_tax_amount);
    $('#pre_tax_amount_text').text(__currency_trans_from_en(pre_tax_amount, true));
    $('#salary_tax_text').text(__currency_trans_from_en(salary_tax, true));
    $('#gross_amount_text').text(__currency_trans_from_en(net_pay, true));
}

$(document).on('change', '.amount_type', function(){
    var tr = $(this).closest('tr');
    if ($(this).val() == 'percent') {
        tr.find('.percent_field').removeClass('hide');
        tr.find('.value_field').attr('readonly', true);
    } else {
        tr.find('.percent_field').addClass('hide');
        tr.find('.value_field').removeAttr('readonly');
    }
});

</script>
