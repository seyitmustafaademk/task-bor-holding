# Laravel Vehicle Assignment Management System

This project is a Laravel-based system for managing vehicle assignments to employees. It includes CRUD operations for employees, vehicles, and their assignments, with validations and database relationships.

---

## Features

- Employee Management
    - Add, update, delete, and view employees.
- Vehicle Management
    - Add, update, delete, and view vehicles.
- Assignment Management
    - Assign vehicles to employees with start and end dates.
    - Cascade delete relationships (deleting an employee or vehicle also removes related assignments).
- API Endpoints
    - RESTful routes for all resources.
- Validation
    - Store and update requests are validated with custom rules and error messages.
- Timestamp support for assignment dates.

---

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/seyitmustafaademk/task-bor-holding.git
    ```
   
2. Install dependencies:
    ```bash
    composer install
    ```
   
3. Set up the environment file:
    ```bash
    cp .env.example .env
    ```
   
4. Generate the application key:
    ```bash
    php artisan key:generate
    ```
   
5. Configure your database in the .env file:
    ```bash
    DB_CONNECTION=mariadb
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=bor_holding_case
    DB_USERNAME=root
    DB_PASSWORD=
    ```
   
6. Run migrations to create the database tables:
    ```bash
    php artisan migrate --seed
    ```
   
7. Start the Local Development Server:
    ```bash
    php artisan serve
    ```

<br>


### Employee Management Endpoints

| Method | Endpoint          | Description                |
|--------|-------------------|----------------------------|
| GET    | `/employees`      | List all employees         |
| POST   | `/employees`      | Create a new employee      |
| GET    | `/employees/{id}` | View an employee           |
| PUT    | `/employees/{id}` | Update an employee         |
| DELETE | `/employees/{id}` | Delete an employee         |


### Vehicle Management Endpoints

| Method | Endpoint         | Description               |
|--------|------------------|---------------------------|
| GET    | `/vehicles`      | List all vehicles         |
| POST   | `/vehicles`      | Create a new vehicle      |
| GET    | `/vehicles/{id}` | View a vehicle            |
| PUT    | `/vehicles/{id}` | Update a vehicle          |
| DELETE | `/vehicles/{id}` | Delete a vehicle          |


### Assignment Management Endpoints

| Method | Endpoint           | Description                     |
|--------|--------------------|---------------------------------|
| GET    | `/assignments`     | List all assignments            |
| POST   | `/assignments`     | Create a new assignment         |
| GET    | `/assignments/{id}`| View an assignment              |
| PUT    | `/assignments/{id}`| Update an assignment            |
| DELETE | `/assignments/{id}`| Delete an assignment            |


<br>

## Employee Request Rules

### StoreEmployeeRequest

| Field       | Rules                         | Description                              |
|-------------|-------------------------------|------------------------------------------|
| `firstname` | `required|string|max:30`     | The first name of the employee.          |
| `lastname`  | `required|string|max:30`     | The last name of the employee.           |
| `email`     | `required|email|unique|max:75`| Unique email address of the employee.    |
| `phone`     | `nullable|string|max:20`     | Optional phone number of the employee.   |
| `position`  | `nullable|string|max:100`    | Optional job position of the employee.   |

### UpdateEmployeeRequest

| Field       | Rules                         | Description                              |
|-------------|-------------------------------|------------------------------------------|
| `firstname` | `sometimes|string|max:30`    | The first name of the employee.          |
| `lastname`  | `sometimes|string|max:30`    | The last name of the employee.           |
| `email`     | `sometimes|email|unique|max:75`| Unique email address of the employee.   |
| `phone`     | `nullable|string|max:20`     | Optional phone number of the employee.   |
| `position`  | `nullable|string|max:100`    | Optional job position of the employee.   |


## Vehicle Request Rules

### StoreVehicleRequest

| Field      | Rules                              | Description                               |
|------------|------------------------------------|-------------------------------------------|
| `brand`    | `required|string|max:100`         | The brand of the vehicle.                 |
| `model`    | `required|string|max:100`         | The model of the vehicle.                 |
| `plate`    | `required|string|unique|max:15`   | Unique license plate of the vehicle.      |
| `color`    | `required|string|max:50`          | The color of the vehicle.                 |
| `year`     | `nullable|integer|digits:4|min:1900|max:<current_year>`| Year of manufacture. |
| `km`       | `nullable|integer|min:0`          | Kilometers driven by the vehicle.         |
| `is_active`| `boolean`                         | Whether the vehicle is active or not.     |

### UpdateVehicleRequest

| Field      | Rules                              | Description                              |
|------------|------------------------------------|------------------------------------------|
| `brand`    | `sometimes|string|max:100`        | The brand of the vehicle.                 |
| `model`    | `sometimes|string|max:100`        | The model of the vehicle.                 |
| `plate`    | `sometimes|string|unique|max:15`  | Unique license plate of the vehicle.     |
| `color`    | `sometimes|string|max:50`         | The color of the vehicle.                |
| `year`     | `nullable|integer|digits:4|min:1900|max:<current_year>`| Year of manufacture.|
| `km`       | `nullable|integer|min:0`          | Kilometers driven by the vehicle.         |
| `is_active`| `boolean`                         | Whether the vehicle is active or not.    |


## Assignment Request Rules

### StoreAssignmentRequest

| Field         | Rules                               | Description                                      |
|---------------|-------------------------------------|--------------------------------------------------|
| `employee_id` | `required|exists:employees,id`      | ID of the assigned employee.                    |
| `vehicle_id`  | `required|exists:vehicles,id`       | ID of the assigned vehicle.                     |
| `start_date`  | `required|date`                    | Start date of the assignment.                   |
| `end_date`    | `nullable|date|after_or_equal:start_date`| Optional end date of the assignment.          |

### UpdateAssignmentRequest

| Field         | Rules                               | Description                                      |
|---------------|-------------------------------------|--------------------------------------------------|
| `employee_id` | `sometimes|exists:employees,id`     | ID of the assigned employee.                    |
| `vehicle_id`  | `sometimes|exists:vehicles,id`      | ID of the assigned vehicle.                     |
| `start_date`  | `sometimes|date`                   | Start date of the assignment.                   |
| `end_date`    | `nullable|date|after_or_equal:start_date`| Optional end date of the assignment.          |
