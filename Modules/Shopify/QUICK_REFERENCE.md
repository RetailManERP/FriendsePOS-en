# Shopify Module - Quick Reference

## Installation (5 minutes)

```bash
# 1. Verify module exists
ls modules/Shopify/

# 2. Update .env with Shopify credentials
SHOPIFY_ENABLED=true
SHOPIFY_SHOP_NAME=my-store
SHOPIFY_ACCESS_TOKEN=shpat_xxxxx
SHOPIFY_API_VERSION=2026-01

# 3. Run database migrations
php artisan migrate

# 4. Access the module
http://localhost/BitorePOS502/public/shopify
```

## Configuration Reference

| Setting | Value | Purpose |
|---------|-------|---------|
| `SHOPIFY_ENABLED` | true/false | Enable/disable module |
| `SHOPIFY_SHOP_NAME` | store-name | Shopify store domain |
| `SHOPIFY_ACCESS_TOKEN` | shpat_xxxx | API authentication |
| `SHOPIFY_API_VERSION` | 2026-01 | API version to use |
| `SHOPIFY_SYNC_PRODUCTS` | true/false | Sync products |
| `SHOPIFY_SYNC_ORDERS` | true/false | Sync orders |
| `SHOPIFY_SYNC_CUSTOMERS` | true/false | Sync customers |
| `SHOPIFY_RATE_LIMIT_RPS` | 2 | Requests per second |
| `SHOPIFY_RETRY_MAX_ATTEMPTS` | 3 | Retry attempts |

## Common Commands

```bash
# Sync products from all stores
php artisan shopify:sync-products

# Sync products from specific store
php artisan shopify:sync-products 1

# Sync all orders
php artisan shopify:sync-orders

# Sync customers
php artisan shopify:sync-customers

# Create webhooks
php artisan shopify:create-webhooks

# Run all syncs (typical routine)
php artisan shopify:sync-products && \
php artisan shopify:sync-orders && \
php artisan shopify:sync-customers
```

## Web Routes

| Route | Purpose |
|-------|---------|
| `/shopify` | Main dashboard |
| `/shopify/connections` | Manage store connections |
| `/shopify/products` | View synced products |
| `/shopify/orders` | View synced orders |
| `/shopify/customers` | View synced customers |

## API Endpoints

```bash
# Get dashboard statistics
GET /api/shopify/stats?store_id=1

# Sync products
POST /api/shopify/products/sync
{
  "store_id": 1
}

# Sync orders
POST /api/shopify/orders/sync
{
  "store_id": 1,
  "status": "any"
}

# Sync customers
POST /api/shopify/customers/sync
{
  "store_id": 1
}

# Get products
GET /api/shopify/products?store_id=1

# Get orders
GET /api/shopify/orders?store_id=1

# Get customers
GET /api/shopify/customers?store_id=1
```

## Code Snippets

### Get API Client
```php
use Modules\Shopify\Services\ShopifyApiClient;

$client = app(ShopifyApiClient::class);
$shop = $client->getShop();
```

### Sync Products
```php
use Modules\Shopify\Services\ShopifyProductSync;

$sync = app(ShopifyProductSync::class);
$result = $sync->syncAll($storeId);
// Returns: ['success' => true, 'processed' => 150, 'failed' => 0]
```

### Query Data
```php
use Modules\Shopify\Entities\ShopifyProduct;

// Get active products
$products = ShopifyProduct::where('store_id', $storeId)
    ->where('status', 'active')
    ->with('variants')
    ->paginate(50);

// Get recent orders
$orders = ShopifyOrder::latest()
    ->with('customer', 'lineItems')
    ->limit(20)
    ->get();
```

### Error Handling
```php
use Modules\Shopify\Exceptions\ShopifyApiException;

try {
    $client->getProducts();
} catch (ShopifyApiException $e) {
    Log::error('Shopify API Error: ' . $e->getMessage());
}
```

## Database Tables

| Table | Purpose |
|-------|---------|
| `shopify_stores` | Store configurations |
| `shopify_products` | Product catalog |
| `shopify_product_variants` | Product variants |
| `shopify_orders` | Order records |
| `shopify_order_line_items` | Order line items |
| `shopify_customers` | Customer profiles |
| `shopify_sync_logs` | Sync history |

## Troubleshooting

### Issue: Connection Failed
**Solution**: Verify access token and shop name in .env

### Issue: Sync Times Out
**Solution**: Reduce SHOPIFY_SYNC_BATCH_SIZE in .env

### Issue: Rate Limited
**Solution**: Increase SHOPIFY_RETRY_DELAY or reduce SHOPIFY_RATE_LIMIT_RPS

### Issue: Data Not Syncing
**Solution**: Check `shopify_sync_logs` table for errors

## Monitoring

### Check Sync Status
```bash
# View recent sync logs
php artisan tinker
>>> ShopifySyncLog::latest()->limit(10)->get()

# Check error count
>>> ShopifySyncLog::where('status', 'failed')->count()
```

### Monitor API Usage
```php
// Get request count
$count = $apiClient->getRequestCount();
```

## Scheduling Syncs

Add to `app/Console/Kernel.php`:
```php
protected function schedule(Schedule $schedule)
{
    $schedule->command('shopify:sync-products')
        ->dailyAt('02:00')->onOneServer();
    
    $schedule->command('shopify:sync-orders')
        ->everyThirtyMinutes()->onOneServer();
    
    $schedule->command('shopify:sync-customers')
        ->dailyAt('03:00')->onOneServer();
}
```

## Module Structure

```
Shopify/
├── Config/           # Configuration
├── Console/          # Artisan commands
├── Database/         # Migrations
├── Entities/         # Models
├── Exceptions/       # Custom exceptions
├── Http/             # Controllers & routes
├── Providers/        # Service providers
├── Resources/        # Views
├── Routes/           # Route definitions
├── Services/         # Business logic
├── module.json       # Module config
└── README.md         # Full documentation
```

## Performance Tips

1. **Batch Syncs**: Use batch size of 250 (default)
2. **Stagger Commands**: Space out sync operations
3. **Index Queries**: Common filters are indexed
4. **Use Pagination**: Always paginate large datasets
5. **Monitor Logs**: Check for slow queries

## Security Best Practices

- Never commit `.env` with credentials
- Use environment variables for tokens
- Validate all webhook payloads
- Log sensitive operations
- Use HTTPS for webhooks
- Encrypt sensitive data in database

## Useful Links

- [Shopify API Documentation](https://shopify.dev/docs/api)
- [Module README](README.md)
- [Implementation Guide](IMPLEMENTATION_GUIDE.md)
- [Implementation Summary](IMPLEMENTATION_SUMMARY.md)

## Support

For detailed information:
- Refer to `README.md` for complete documentation
- Check `IMPLEMENTATION_GUIDE.md` for setup details
- Review sync logs for troubleshooting
- Check Laravel/Shopify documentation

---

**Last Updated**: February 9, 2026  
**Module Version**: 1.0.0  
**Status**: Production Ready
