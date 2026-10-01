# Shopify API Integration Module

## Overview

The Shopify module provides comprehensive API integration for syncing products, orders, customers, and inventory between your Shopify store and the BitorePOS system. It enables seamless data synchronization and Shopify-related operations.

**API Version**: 2026-01

## Features

- **Product Synchronization**: Sync products, variants, pricing, and inventory from Shopify
- **Order Management**: Import orders, line items, and order status from Shopify
- **Customer Sync**: Synchronize customer data and purchase history
- **Inventory Tracking**: Monitor and sync inventory levels across locations
- **Webhook Support**: Real-time updates via Shopify webhooks
- **Rate Limiting**: Built-in API rate limiting and retry logic
- **Sync Logging**: Track all sync operations with detailed logs
- **Dashboard**: Monitor sync status and key metrics
- **OAuth Authentication**: Connect stores with Shopify Client ID and Client Secret flow

## Installation & Setup

### 1. Environment Configuration

Add the following to your `.env` file:

```dotenv
# Shopify Configuration
SHOPIFY_ENABLED=true
SHOPIFY_API_VERSION=2026-01

# OAuth Client Credentials (recommended)
SHOPIFY_CLIENT_ID=your_client_id
SHOPIFY_CLIENT_SECRET=your_client_secret
SHOPIFY_SCOPES=read_products,read_orders,read_customers,read_inventory,read_locations

# Legacy manual token (optional fallback)
SHOPIFY_SHOP_NAME=your-store-name
SHOPIFY_SHOP_URL=https://your-store-name.myshopify.com
SHOPIFY_ACCESS_TOKEN=shpat_your_access_token_here
SHOPIFY_API_KEY=your_api_key
SHOPIFY_API_PASSWORD=your_api_password

# Shopify Webhooks
SHOPIFY_WEBHOOKS_ENABLED=true
SHOPIFY_WEBHOOK_TOPIC=products/update,orders/create,orders/updated
SHOPIFY_WEBHOOK_ADDRESS=https://yourdomain.com/shopify/webhooks

# Shopify Sync Settings
SHOPIFY_SYNC_PRODUCTS=true
SHOPIFY_SYNC_ORDERS=true
SHOPIFY_SYNC_CUSTOMERS=true
SHOPIFY_SYNC_INVENTORY=true
SHOPIFY_SYNC_BATCH_SIZE=250

# API Rate Limiting
SHOPIFY_RATE_LIMIT_RPS=2
SHOPIFY_RATE_BURST_SIZE=40

# Retry Configuration
SHOPIFY_RETRY_MAX_ATTEMPTS=3
SHOPIFY_RETRY_DELAY=1000
```

### 2. Database Setup

Run migrations to create required tables:

```bash
php artisan migrate
```

This creates the following tables:
- `shopify_stores` - Store configurations
- `shopify_products` - Product data
- `shopify_product_variants` - Product variants
- `shopify_orders` - Order data
- `shopify_order_line_items` - Order line items
- `shopify_customers` - Customer data
- `shopify_sync_logs` - Synchronization logs

### 3. Obtain Shopify Access Token

1. Log in to your Shopify Admin
2. Go to Apps and integrations → Develop apps
3. Create a new app
4. Under Admin API access scopes, enable:
   - `read_products`, `write_products`
   - `read_orders`, `write_orders`
   - `read_customers`, `write_customers`
   - `read_inventory`, `write_inventory`
   - `read_webhooks`, `write_webhooks`
5. Generate access token from the API credentials section
6. Copy the token to `SHOPIFY_ACCESS_TOKEN` in .env

## Usage

### Web Interface

Access the Shopify module through the admin dashboard:

- **Dashboard**: `/shopify` - Overview and statistics
- **Connections**: `/shopify/connections` - Manage Shopify store connections
- **Products**: `/shopify/products` - View and manage synced products
- **Orders**: `/shopify/orders` - View and manage synced orders
- **Customers**: `/shopify/customers` - View synced customer data

### Console Commands

#### Sync Products

```bash
# Sync all products from active stores
php artisan shopify:sync-products

# Sync products from specific store
php artisan shopify:sync-products {store_id}
```

#### Sync Orders

```bash
# Sync all orders
php artisan shopify:sync-orders

# Sync orders from specific store
php artisan shopify:sync-orders {store_id}

# Sync specific order status
php artisan shopify:sync-orders {store_id} --status=unfulfilled
```

#### Sync Customers

```bash
# Sync all customers
php artisan shopify:sync-customers

# Sync customers from specific store
php artisan shopify:sync-customers {store_id}
```

#### Create Webhooks

```bash
# Create webhooks for all active stores
php artisan shopify:create-webhooks

# Create webhooks for specific store
php artisan shopify:create-webhooks {store_id}
```

### API Endpoints

#### Dashboard Stats

```
GET /api/shopify/stats?store_id={store_id}
```

Response:
```json
{
  "success": true,
  "data": {
    "products": 150,
    "orders": 45,
    "customers": 200,
    "revenue": 12500.50,
    "pending_orders": 5
  }
}
```

#### Sync Operations

```
POST /api/shopify/products/sync
POST /api/shopify/orders/sync
POST /api/shopify/customers/sync
```

Request body:
```json
{
  "store_id": 1,
  "status": "optional_status_filter"
}
```

## Module Structure

```
Shopify/
├── Config/
│   └── config.php                 # Configuration file
├── Console/
│   └── Commands/                  # Artisan commands
├── Database/
│   └── Migrations/                # Database migrations
├── Entities/                      # Eloquent models
├── Exceptions/                    # Custom exceptions
├── Http/
│   ├── Controllers/               # Route controllers
│   ├── Middleware/                # Custom middleware
│   └── Requests/                  # Form requests
├── Providers/
│   ├── ShopifyServiceProvider.php
│   └── RouteServiceProvider.php
├── Resources/
│   └── views/                     # Blade templates
├── Routes/
│   ├── web.php                    # Web routes
│   └── api.php                    # API routes
├── Services/                      # Business logic
├── module.json                    # Module configuration
├── composer.json
└── package.json
```

## Database Schema

### shopify_stores
| Column | Type | Notes |
|--------|------|-------|
| id | Bigint | Primary key |
| business_id | Bigint | Foreign key to businesses |
| shop_name | String | Shopify store name |
| shop_url | String | Shopify store URL |
| access_token | String | API access token |
| api_version | String | API version |
| is_active | Boolean | Store status |
| last_sync_at | Timestamp | Last sync timestamp |
| webhook_created_at | Timestamp | Webhook creation time |

### shopify_products
| Column | Type | Notes |
|--------|------|-------|
| id | Bigint | Primary key |
| store_id | Bigint | Foreign key |
| shopify_product_id | String | Unique Shopify ID |
| title | String | Product title |
| sku | String | Product SKU |
| price | Decimal | Product price |
| quantity | Integer | Available quantity |
| status | String | active/archived |
| sync_status | String | Sync status |
| synced_at | Timestamp | Last sync time |

## API Client Service

### Basic Usage

```php
use Modules\Shopify\Services\ShopifyApiClient;

$client = app(ShopifyApiClient::class);

// Get products
$products = $client->getProducts([
    'limit' => 100,
    'status' => 'active'
]);

// Get orders
$orders = $client->getOrders([
    'status' => 'any',
    'limit' => 50
]);

// Get customers
$customers = $client->getCustomers(['limit' => 100]);

// Test connection
$result = $client->testConnection();
```

## Sync Services

### Product Sync

```php
use Modules\Shopify\Services\ShopifyProductSync;

$productSync = app(ShopifyProductSync::class);

// Sync all products
$result = $productSync->syncAll($storeId, [
    'status' => 'active'
]);

// Result: ['success' => true, 'processed' => 150, 'failed' => 0]
```

### Order Sync

```php
use Modules\Shopify\Services\ShopifyOrderSync;

$orderSync = app(ShopifyOrderSync::class);

$result = $orderSync->syncAll($storeId, [
    'status' => 'any'
]);
```

### Customer Sync

```php
use Modules\Shopify\Services\ShopifyCustomerSync;

$customerSync = app(ShopifyCustomerSync::class);

$result = $customerSync->syncAll($storeId);
```

## Error Handling

The module includes custom exceptions for better error handling:

```php
use Modules\Shopify\Exceptions\ShopifyApiException;
use Modules\Shopify\Exceptions\ShopifySyncException;

try {
    $apiClient->getProducts();
} catch (ShopifyApiException $e) {
    Log::error('Shopify API Error: ' . $e->getMessage());
}
```

## Models/Entities

### ShopifyStore
- Relations: `products()`, `orders()`, `customers()`
- Methods: Available through standard Eloquent query builder

### ShopifyProduct
- Relations: `store()`, `variants()`
- Fillable: title, description, handle, vendor, price, cost, etc.

### ShopifyOrder
- Relations: `store()`, `customer()`, `lineItems()`
- Scopes: Can filter by status, date range, etc.

### ShopifyCustomer
- Relations: `store()`, `orders()`
- Searchable fields: email, first_name, last_name

## Performance Optimization

### Rate Limiting
The module implements Shopify's rate limiting:
- Default: 2 requests per second
- Burst size: 40 requests
- Auto-backoff on 429 (Too Many Requests) responses

### Batch Processing
- Batch size: 250 records per request (configurable)
- Pagination support for large datasets
- Cursor-based pagination implementation

### Database Optimization
- Indexed fields: SKU, handle, email, status
- Efficient queries with eager loading
- Soft deletes for data preservation

## Scheduling

Add to `app/Console/Kernel.php` to schedule syncs:

```php
protected function schedule(Schedule $schedule)
{
    // Sync products daily at 2 AM
    $schedule->command('shopify:sync-products')
        ->dailyAt('02:00')
        ->onOneServer();

    // Sync orders every 30 minutes
    $schedule->command('shopify:sync-orders')
        ->everyThirtyMinutes()
        ->onOneServer();

    // Sync customers daily at 3 AM
    $schedule->command('shopify:sync-customers')
        ->dailyAt('03:00')
        ->onOneServer();
}
```

## Troubleshooting

### Connection Failed
- Verify `SHOPIFY_ACCESS_TOKEN` is correct
- Check API version compatibility
- Ensure store name matches Shopify domain

### Sync Errors
- Check sync logs: `shopify_sync_logs` table
- Verify database connectivity
- Review Laravel error logs

### Rate Limit Issues
- Adjust `SHOPIFY_RATE_LIMIT_RPS` in .env
- Increase batch processing intervals
- Use staggered scheduling for multiple commands

## Support & Documentation

For Shopify API documentation, visit:
- [Shopify Admin API Reference](https://shopify.dev/docs/api/admin-rest)
- [Shopify GraphQL API](https://shopify.dev/docs/api/admin-graphql)
- [Shopify Webhooks](https://shopify.dev/docs/api/admin-rest/2026-01/resources/webhook)

## License

MIT License. See LICENSE file for details.
