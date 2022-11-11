# Laravel Roles Permissions

Example laravel project to manage role with they permission for each route.

## Installation

1. Add id_role to User table
2. Create role, menu, and permission table, you can check the structure in migration folder

```bash
  database/migrations/2012_11_11_014127_create_roles_table.php
  database/migrations/2022_11_11_014203_create_menus_table.php
  database/migrations/2022_11_11_021825_create_permissions_table.php
```

3. fill all data for each table

- role : all user role
- menu : all route (require route_name)
- permission : relationship id_role and id_menu

4. use middleware check.roles in route.

## Usage/Examples Middleware

```php
<?php
namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;
use Illuminate\Http\Request;

class CheckRoles
{
  public function handle(Request $request, Closure $next)
  {
    $routeName = Route::currentRouteName();
    // $role = Auth::user()->id_role;
    $role = 1; //example
    // get permission data from table permissions
    $permission = Permission::with(['role', 'menu'])->whereRelation('menu', 'route_name', '=', $routeName)->whereRelation('role', 'id', '=', $role)->first();
    // if data not found, then redirect to home page
    if (!$permission && $routeName != 'home') {
        return redirect(route('home')); //change with home url
    }
    return $next($request);
  }
}
```
