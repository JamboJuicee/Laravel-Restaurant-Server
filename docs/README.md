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

## 4. Create models
1. `herd php artisan make:model Restaurant`
2. `herd php artisan make:model Booking`

- Make sure to add `use Illuminate\Database\Eloquent\Concerns\HasUuids;` for both Models.
- Make sure to add `use Illuminate\Database\Eloquent\Factories\HasFactory;` for Restaurant model

# 5. Add valid structure for models
1. Restaurant:
```
    use HasFactory, HasUuids;

    public function bookings() {
        return $this -> hasMany(Booking::class);
    }
```
2. Structure for bookings:
```
    use hasUuids;

    protected $fillable = ["name", "email", "datetime", "people", "restaurant_id"];

    public function restaurant() {
        return $this -> belongsTo(Restaurant::class);
    }
```

# 6. Create Restaurant Factory & add valid structure for it
1. `herd php artisan make:factory RestaurantFactory`

- Add valid structure for the factory:
```
    "id" -> $this -> faker -> uuid(),
    "name" -> $this -> faker -> company(),
    "rating" -> $this -> faker -> numberBetween(0, 5)
```