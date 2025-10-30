# Laravel Refactor Test

You have inherited a legacy controller that violates several best practices.
Your task is to refactor it into clean, testable, and maintainable code.

## Your Goals
1. Move business logic to a Service class (app/Services/OrderService.php)
2. Add a Form Request for validation
3. Use Eloquent models instead of DB facade queries
4. Fix any logic errors (especially transaction safety and order_item linkage)
5. Keep API response format the same

## Run Instructions
```bash
php artisan migrate:fresh --seed
php artisan serve
POST /orders
{
  "user_id": 1,
  "items": [
    { "product_id": 1, "quantity": 2 },
    { "product_id": 2, "quantity": 3 }
  ]
}
```

## What to do
1. Clone this repository.
2. Create a new branch called `refactor/{your-name}`.
3. Refactor the existing code to follow best practices and fix the logic issues.
4. Push your branch to the remote repository when you’re done.

You may use Postman, Insomnia, or any API testing tool you prefer to test your refactored endpoint.
