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
have TODO [name!,description,status,end_date!,end_time] </br>
each TODO have Many TASKS [name!,status,todo_id!]
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

