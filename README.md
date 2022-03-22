<h1>Todo Application</h1>
<h3>What it focues on ?</h3>
<ul>
  <li>SOLID principles</li>
  <li>Using Repository pattern</li>
  <li>Input validation</li>
  <li>Code cleaniness</li>
  <li>Naming convention</li>
  <li>Full REST Api</li>
  <li>Simple CRUD using graphql</li>
</ul>

======

#### Archeticture
have TODO [name.description,status,end_date,end_time]
each TODO have Many TASKS [name.status]
will do full CRUD on both of them
- when TODO finished -> all his tasks finished too
- when TODO deleted -> all his tasks deleted too

======

<h3>How To run it?</h3>

  1. cp .env.example .env
  2. add your database at .env file
  3. run `php artisan migrate`
  4. run `php artisan serve`


======

#### APIS
<span>you can simple find it by run `php artisan route:list` </span>

* +--------+---------------+---------------------+--------------------+--------------------------------------------------------------+-------------------
| Domain | Method        | URI                 | Name              | Middleware                                                      |
+--------+---------------+---------------------+--------------------+--------------------------------------------------------------+---------------------
|        | POST          | api/v1/task         | task.store         | api                                                             |
|        | GET|HEAD      | api/v1/task         | task.index         | api                                                             |
|        | POST          | api/v1/task/finish  | task.finish        | api                                                             |
|        | GET|HEAD      | api/v1/task/{task}  | task.show          | api                                                             |
|        | PUT|PATCH     | api/v1/task/{task}  | task.update        | api                                                             |
|        | DELETE        | api/v1/task/{task}  | task.destroy       | api                                                             |
|        | GET|HEAD      | api/v1/todo         | todo.index         | api                                                             |
|        | POST          | api/v1/todo         | todo.store         | api                                                             |
|        | POST          | api/v1/todo/finish  | todo.finish        | api                                                             |
|        | GET|HEAD      | api/v1/todo/{todo}  | todo.show          | api                                                             |
|        | PUT|PATCH     | api/v1/todo/{todo}  | todo.update        | api                                                             |
|        | DELETE        | api/v1/todo/{todo}  | todo.destroy       | api                                                             |
|        | GET|POST|HEAD | graphql             | graphql            | Nuwave\Lighthouse\Support\Http\Middleware\AcceptJson            |
|        |               |                     |                    |                                                                 | 
+--------+---------------+---------------------+--------------------+--------------------------------------------------------------+---------------------
