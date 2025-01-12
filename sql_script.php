//Departments Table
CREATE TABLE departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);
// Employees Table
CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    department_id INT,
    FOREIGN KEY (department_id) REFERENCES departments(id)
);

//Contacts Table
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT,
    phone_number VARCHAR(20) NOT NULL,
    FOREIGN KEY (employee_id) REFERENCES employees(id)
);
