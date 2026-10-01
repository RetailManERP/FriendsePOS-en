<?php

return [
    // Module
    'kenya_etims' => 'Kenya eTIMS',
    'etims' => 'eTIMS',
    'etims_integration' => 'eTIMS Integration',
    'kra_etims' => 'KRA eTIMS',

    // Dashboard
    'dashboard' => 'Dashboard',
    'sales_submitted' => 'Sales Submitted',
    'sales_pending' => 'Sales Pending',
    'sales_failed' => 'Sales Failed',
    'items_registered' => 'Items Registered',
    'api_success_rate' => 'API Success Rate',
    'unread_notices' => 'Unread Notices',
    'quick_actions' => 'Quick Actions',
    'recent_api_logs' => 'Recent API Logs',
    'api_performance' => 'API Performance',

    // Device
    'device_management' => 'Device Management',
    'register_device' => 'Register Device',
    'device_serial' => 'Device Serial Number',
    'branch_id' => 'Branch ID',
    'scu_type' => 'SCU Type',
    'oscu' => 'OSCU (Online)',
    'vscu' => 'VSCU (Virtual)',
    'communication_key' => 'Communication Key',
    'initialize' => 'Initialize',
    'reinitialize' => 'Re-Initialize',
    'environment' => 'Environment',
    'sandbox' => 'Sandbox',
    'production' => 'Production',

    // Sales
    'sales' => 'Sales',
    'sale_detail' => 'Sale Detail',
    'submit_to_kra' => 'Submit to KRA',
    'retry_submission' => 'Retry Submission',
    'bulk_submit' => 'Bulk Submit',
    'cu_invoice_no' => 'CU Invoice Number',
    'cu_qr_code' => 'CU QR Code',
    'cu_signature' => 'CU Signature',
    'tax_breakdown' => 'Tax Breakdown',
    'submission_status' => 'Submission Status',
    'submitted' => 'Submitted',
    'pending' => 'Pending',
    'failed' => 'Failed',

    // Items
    'items' => 'Items',
    'item_management' => 'Item Management',
    'register_item' => 'Register Item',
    'bulk_register' => 'Bulk Register',
    'auto_create_items' => 'Auto-Create from POS Products',
    'item_code' => 'Item Code',
    'item_name' => 'Item Name',
    'item_classification' => 'Item Classification',
    'tax_type' => 'Tax Type',
    'packaging_unit' => 'Packaging Unit',
    'quantity_unit' => 'Quantity Unit',
    'origin_nation' => 'Origin Nation',
    'registered' => 'Registered',
    'not_registered' => 'Not Registered',

    // Settings
    'settings' => 'Settings',
    'configuration' => 'Configuration',
    'sync_with_kra' => 'Sync with KRA',
    'full_sync' => 'Full Sync',
    'last_synced' => 'Last Synced',
    'tax_types' => 'Tax Types',
    'payment_types' => 'Payment Types',

    // API Logs
    'api_logs' => 'API Logs',
    'api_log_detail' => 'API Log Detail',
    'endpoint' => 'Endpoint',
    'request_payload' => 'Request Payload',
    'response_body' => 'Response Body',
    'result_code' => 'Result Code',
    'result_message' => 'Result Message',
    'http_status' => 'HTTP Status',
    'response_time' => 'Response Time',
    'success' => 'Success',

    // Notices
    'notices' => 'KRA Notices',
    'notice_no' => 'Notice No',
    'unread' => 'Unread',

    // Tax Types
    'vat_standard' => 'VAT 16%',
    'vat_reduced' => 'VAT 8%',
    'vat_zero' => 'VAT 0%',
    'vat_exempt' => 'Exempt',
    'excise_duty' => 'Excise Duty',
    'treasury_levy' => 'Treasury Levy',
    'rental_income' => 'Rental Income Tax',
    'insurance_premium' => 'Insurance Premium Levy',
    'tourism_levy' => 'Tourism Levy',

    // Transaction Types
    'normal_sale' => 'Normal Sale',
    'credit_note' => 'Credit Note',
    'debit_note' => 'Debit Note',
    'cash_sale' => 'Cash Sale',
    'credit_sale' => 'Credit Sale',

    // Messages
    'device_registered' => 'Device registered successfully.',
    'device_initialized' => 'Device initialized with KRA successfully.',
    'device_deleted' => 'Device deleted successfully.',
    'sale_submitted' => 'Sale submitted to KRA successfully.',
    'sale_retry_success' => 'Sale resubmitted to KRA successfully.',
    'bulk_submit_success' => ':count sales submitted to KRA.',
    'item_registered' => 'Item registered with KRA successfully.',
    'items_auto_created' => ':count items auto-created from POS products.',
    'sync_complete' => 'Full sync with KRA completed.',
    'sync_failed' => 'Sync failed. Check API logs for details.',
    'no_active_device' => 'No active eTIMS device found. Please register and initialize a device first.',
    'submission_failed' => 'Failed to submit to KRA: :error',
    'module_installed' => 'Kenya eTIMS module installed successfully.',
    'confirm_delete' => 'Are you sure you want to delete this?',

    // Install
    'install' => 'Install',
    'install_module' => 'Install Kenya eTIMS Module',
    'uninstall_module' => 'Uninstall Kenya eTIMS Module',
    'update_module' => 'Update Kenya eTIMS Module',
];
