const { test } = require('node:test');
const assert = require('node:assert/strict');
const fs = require('node:fs');
const vm = require('node:vm');
const path = require('node:path');

const pos = fs.readFileSync(path.join(__dirname, '../../public/js/pos.js'), 'utf8');
const functions = fs.readFileSync(path.join(__dirname, '../../public/js/functions.js'), 'utf8');

function calculateSaleTotal({ taxId, directOption, modalOptions = [], discount = 0 }) {
    const fields = { '#tax_rate_id': taxId, '#tax_calculation_amount': 0.1, '#tax_calculation_type': 'fixed' };
    const document = {};
    let orderTax;

    function options(items) {
        return {
            length: items.length,
            data: key => items[0]?.[key],
            filter: predicate => options(items.filter(item => predicate.call(item))),
            first: () => options(items.slice(0, 1)),
        };
    }

    function $(selector) {
        if (selector === 'select#order_tax_modal option') {
            return options(modalOptions);
        }

        return {
            length: selector === 'form#edit_sell_form' ? 1 : 0,
            find: () => options(directOption ? [directOption] : []),
            val(value) {
                if (value === undefined) return fields[selector];
                fields[selector] = value;
            },
            each(callback) {
                if (selector === 'input[id="final_total_input"]') callback.call('final_total');
            },
            text(value) {
                if (selector === 'span[id="order_tax"]') orderTax = value;
                return this;
            },
            attr() {},
            trigger() {},
        };
    }

    const context = vm.createContext({
        $, document,
        Decimal: {
            div: (a, b) => ({ toNumber: () => a / b }),
            mul: (a, b) => ({ toNumber: () => a * b }),
        },
        __calculate_amount: undefined,
        __read_number: field => Number(field.val()) || 0,
        __write_number: (field, value) => field.val(value),
        __currency_trans_from_en: value => value,
        __round: value => ({ number: value, diff: 0 }),
        pos_discount: () => discount,
        calculate_balance_due() {},
        update_total_receivable_with_previous() {},
    });
    vm.runInContext(functions.slice(functions.indexOf('function __calculate_amount('), functions.indexOf('//Add specified percentage')), context);
    vm.runInContext(pos.slice(pos.indexOf('function pos_order_tax('), pos.indexOf('function pos_default_type_of_service(')), context);
    vm.runInContext(pos.slice(pos.indexOf('function calculate_billing_details('), pos.indexOf('function pos_discount(')), context);
    context.calculate_billing_details(156940);

    return { tax: orderTax, total: fields.final_total };
}

test('Direct Sale uses the selected percentage rate even when the hidden tax type is fixed', () => {
    const result = calculateSaleTotal({
        taxId: '5', directOption: { value: '5', rate: 0.1, type: 'percentage' },
    });
    assert.deepEqual(result, { tax: 156.94, total: 157096.94 });
});

test('POS uses the tax option matching the invoice and applies the rate after discount', () => {
    const result = calculateSaleTotal({
        taxId: '5',
        modalOptions: [{ value: '2', rate: 50, type: 'fixed' }, { value: '5', rate: 0.1, type: 'percentage' }],
        discount: 1000,
    });
    assert.deepEqual(result, { tax: 155.94, total: 156095.94 });
});

test('Fixed tax and no tax retain their normal calculation', () => {
    assert.deepEqual(calculateSaleTotal({
        taxId: '2', directOption: { value: '2', rate: 50, type: 'fixed' },
    }), { tax: 50, total: 156990 });
    assert.deepEqual(calculateSaleTotal({ taxId: '' }), { tax: 0, total: 156940 });
});
