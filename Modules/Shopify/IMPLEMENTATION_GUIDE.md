# Shopify Integration Implementation Guide

## Quick Start

### Step 1: Enable the Module
The Shopify module is automatically enabled. Verify by checking:
- `modules/Shopify/module.json` - should have `"active": 1`

### Step 2: Configure Environment Variables
Edit `.env` and set:
```dotenv
SHOPIFY_ENABLED=true
SHOPIFY_SHOP_NAME=your-store-name
SHOPIFY_ACCESS_TOKEN=shpat_your_token_here
SHOPIFY_API_VERSION=2026-01
```

### Step 3: Run Migrations
```bash
php artisan migrate
```

### Step 4: Create Store Connection
Navigate to `/shopify/connections` and add your Shopify store by:
1. Entering your store name
2. Providing the access token
3. Selecting the API version
4. Clicking "Connect"

### Step 5: Start Syncing
Use console commands or UI to sync data:
```bash
php artisan shopify:sync-products
php artisan shopify:sync-orders
php artisan shopify:sync-customers
```

## Architecture Overview

### Layer 1: Service Layer
**Location**: `Services/`

- **ShopifyApiClient**: Low-level HTTP wrapper for Shopify REST API
  - Handles authentication
  - Implements rate limiting
  - Manages retries and error handling
  - Provides methods for all API endpoints

- **ShopifyProductSync**: Business logic for product synchronization
  - Fetches products from Shopify API
  - Persists to database
  - Handles variants and pricing
  - Tracks sync status

- **ShopifyOrderSync**: Order synchronization logic
  - Imports order data
  - Links customers and line items
  - Tracks fulfillment status
  - Maintains sync logs

- **ShopifyCustomerSync**: Customer data synchronization
  - Syncs customer profiles
  - Updates order history
  - Tracks customer metrics
  - Manages preferences

### Layer 2: Data Layer
**Location**: `Entities/`

- **ShopifyStore**: Configuration and connection management
- **ShopifyProduct**: Product data storage
- **ShopifyProductVariant**: Product variant details
- **ShopifyOrder**: Order information
- **ShopifyOrderLineItem**: Individual order items
- **ShopifyCustomer**: Customer profiles
- **ShopifySyncLog**: Sync operation audit trail

### Layer 3: HTTP Layer
**Location**: `Http/Controllers/`

- **ShopifyConnectionController**: Store connection management
- **ShopifyProductController**: Product management endpoints
- **ShopifyOrderController**: Order endpoints
- **ShopifyCustomerController**: Customer endpoints
- **ShopifyDashboardController**: Analytics and metrics

### Layer 4: Command Layer
**Location**: `Console/Commands/`

- Artisan commands for background sync operations
- Scheduled task support
- Progress reporting

## Data Flow

### Sync Product Flow
```
Artisan Command
  ↓
ProductSync Service
  ↓
ShopifyApiClient.getProducts()
  ↓
Process & Validate Data
  ↓
Save to shopify_products table
  ↓
Save variants to shopify_product_variants
  ↓
Update shopify_sync_logs
```

### Order Sync Flow
```
Artisan Command
  ↓
OrderSync Service
  ↓
ShopifyApiClient.getOrders()
  ↓
Sync associated customers
  ↓
Save to shopify_orders table
  ↓
Save line items
  ↓
Update sync logs
```

## API Integration Points

### HTTP Methods Implemented

```php
// GET requests
$client->get($endpoint, $query);
$client->getProducts($query);
$client->getOrders($query);
$client->getCustomers($query);
$client->getShop();

// POST requests
$client->post($endpoint, $data);
$client->createWebhook($topic, $address);

// PUT requests
$client->put($endpoint, $data);

// DELETE requests
$client->delete($endpoint);
```

### Rate Limiting Strategy

```
Initial: 2 requests/second
Burst:   40 concurrent requests
Backoff: Exponential on 429 errors
Retry:   3 attempts maximum
```

## Database Relationships

```
ShopifyStore
├── ShopifyProduct (1:N)
│   └── ShopifyProductVariant (1:N)
├── ShopifyOrder (1:N)
│   ├── ShopifyOrderLineItem (1:N)
│   └── ShopifyCustomer (1:1)
├── ShopifyCustomer (1:N)
└── ShopifySyncLog (1:N)
```

## Configuration Reference

### Sync Configuration
```php
'sync' => [
    'products'    => true,      // Sync products
    'orders'      => true,      // Sync orders
    'customers'   => true,      // Sync customers
    'inventory'   => true,      // Sync inventory
    'batch_size'  => 250,       // Records per request
]
```

### Rate Limiting
```php
'rate_limit' => [
    'requests_per_second' => 2,
    'burst_size'          => 40,
]
```

### Retry Settings
```php
'retry' => [
    'max_attempts' => 3,
    'delay'        => 1000,  // milliseconds
]
```

## Error Handling

### Custom Exceptions

**ShopifyApiException**
- Thrown on API errors
- Contains HTTP status codes
- Includes response details

**ShopifySyncException**
- Thrown during sync operations
- Includes sync context
- Logged to sync logs table

### Logging

Logs are recorded to channel: `shopify`

Configure in `config/logging.php`:
```php
'channels' => [
    'shopify' => [
        'driver' => 'single',
        'path' => storage_path('logs/shopify.log'),
        'level' => 'debug',
    ],
]
```

## Webhook Integration

### Webhook Topics Supported
- `products/update` - Product changes
- `products/delete` - Product deletion
- `orders/create` - New orders
- `orders/updated` - Order modifications
- `customers/create` - New customers
- `customers/update` - Customer changes

### Webhook Handler Example
```php
// Create webhooks
php artisan shopify:create-webhooks

// Handle webhook in route
Route::post('/shopify/webhooks', [WebhookController::class, 'handle']);
```

## Testing Guide

### Test Connection
```php
$result = $apiClient->testConnection();
if ($result['success']) {
    // Connected successfully
}
```

### Manual Sync
```php
$result = app(ShopifyProductSync::class)->syncAll($storeId);
// Returns: ['success' => true, 'processed' => 150, 'failed' => 0]
```

### Query Synced Data
```php
// Get synced products
$products = ShopifyProduct::where('store_id', $storeId)->get();

// Get recent orders
$orders = ShopifyOrder::latest()->limit(10)->get();

// Check sync history
$logs = ShopifySyncLog::where('store_id', $storeId)
    ->latest()
    ->limit(20)
    ->get();
```

## Performance Considerations

### Optimization Tips

1. **Use Pagination**: Always paginate large result sets
2. **Batch Requests**: Process in chunks of 250
3. **Index Queries**: Database queries are indexed on common fields
4. **Schedule Tasks**: Run syncs during off-peak hours
5. **Monitor Logs**: Check sync logs for failures

### Query Optimization
```php
// Good: Eager load relationships
$products = ShopifyProduct::with('variants')
    ->where('store_id', $storeId)
    ->paginate(50);

// Avoid: N+1 queries
$products = ShopifyProduct::all();
foreach ($products as $product) {
    $variants = $product->variants; // Queries in loop
}
```

## Deployment Checklist

- [ ] Update `.env` with Shopify credentials
- [ ] Run `php artisan migrate`
- [ ] Set up Shopify app with required permissions
- [ ] Generate and store access token
- [ ] Test API connection via UI
- [ ] Configure webhook address (for webhooks)
- [ ] Create initial webhook records
- [ ] Set up scheduler for sync commands
- [ ] Configure logging (optional)
- [ ] Monitor first sync for errors

## Maintenance

### Regular Tasks
- Monitor sync logs for failures
- Check rate limit compliance
- Update API version as needed
- Review webhook delivery status
- Clean up old sync logs

### Backup Strategy
- Database backups include all synced data
- Sync logs preserved for audit trail
- Raw Shopify data stored in JSON fields

## Security Considerations

- **API Token**: Store securely in `.env`
- **Rate Limiting**: Prevents abuse
- **Validation**: All input validated
- **Errors**: Sensitive data not logged
- **HTTPS**: Use HTTPS for webhook addresses

## Future Enhancements

Potential improvements:
- GraphQL API support
- Inventory tracking per location
- Webhook validation (HMAC)
- Data mapping to POS products
- Two-way sync (POS to Shopify)
- Bulk operations support
- Advanced filtering options

## Support Resources

- Module Documentation: `modules/Shopify/README.md`
- Shopify API Docs: https://shopify.dev/docs/api
- Laravel Documentation: https://laravel.com/docs
- GitHub Issues: Report bugs/requests

---

**Version**: 1.0.0  
**Last Updated**: February 2026  
**Maintainer**: BitorePOS Development Team
