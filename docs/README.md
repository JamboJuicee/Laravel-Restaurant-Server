# Laravel server implementation (Cheat-sheet)

## 1. Install API
- `herd php artisan install:api`

## 2. Create 2 migrations
- `herd php artisan make:migration create_restaurants_table`
- `herd php artisan make:migration create_bookings_table`

## 3. Create appropriate structure for migration.
1. Structure for resturants:
```
    $table->uuid('id')->primary();
    $table->string('name', 50);
    $table->integer('rating');
    $table->timestamps();
```
2. Structure for bookings: 
```
    $table->uuid('id')->primary();
    $table->string('name', 128);
    $table->string('email', 128);
    $table->dateTime('datetime');
    $table->integer('people');
    $table->foreignUuid("restaurant_id") -> constrained();
    $table->timestamps();
```