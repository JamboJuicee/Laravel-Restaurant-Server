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
    "id" => $this -> faker -> uuid(),
    "name" => $this -> faker -> company(),
    "rating" => $this -> faker -> numberBetween(0, 5)
```

# 7. Creating seeder for Restaurant
1. `herd php artisan make:seeder RestaurantSeeder`

- Import Restaurant model to the seeder: `use App\Models\Restaurant;`

- Add valid Restaurant seeder structure:
```
    public function run(): void
    {
        Restaurant::factory(10) -> create();
    }
```

- Modify *DatabaseSeeder.php* by replacing the function *run()* with this:
```
    public function run(): void
    {
        $this -> call([
            RestaurantSeeder::class
        ]);
    }
```

# 8. Executing migrations
- From herd terminal execute: `herd php artisan migrate --seed`

# 9. Create controller
- From herd terminal execute: `herd php artisan make:controller RestaurantController`

1. Inport models to the Controller:
```
    use App\Models\Booking;
    use App\Models\Restaurant;
```

2. Define 3 functions in the controller:
```
    public function getAllRestaurants() {
        return [ "data" => Restaurant::all() ];
    }

    public function getBookings(Restaurant $restaurant) {
        return [ "data" => $restaurant -> bookings ];
    }

    public function addBooking(Request $request) {
        $booking = new Booking($request -> all());

        $booking -> save();

        return $booking;
    }
```

# 10. Link Api routes to the controller
1. Add import of the Restaurant Controller: `use App\Http\Controllers\RestaurantController;`

2. Add 3 routes:
```
    Route::get("/restaurants", [RestaurantController::class, "getRestaurants"]);
    Route::get("/restaurants/{restaurant}/bookings", [RestaurantController::class, "getBookings"]);
    Route::post("/bookings", [RestaurantController::class, "addBooking"]);
```

# 11. And now is the best time to test the server-side using postman and fix the issues!