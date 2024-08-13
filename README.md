# Conveyancing Application

This is a Laravel-based application for managing conveyancing processes. The application includes models for users, properties, conveyancing cases, documents, transactions, and notes.

## Models

### User
The `User` model represents users in the application. Users can have different roles: admin, conveyancer, or client. The relationships for the `User` model include:
- **Properties**: A user with the role of `client` can own multiple properties.
- **Conveyancing Cases**: A user with the role of `conveyancer` can manage multiple conveyancing cases, and a user with the role of `client` can be involved in multiple cases.
- **Documents**: A user can upload multiple documents related to conveyancing cases.
- **Notes**: A user can create multiple notes associated with conveyancing cases.

### Property
The `Property` model represents properties that are involved in conveyancing cases. Each property has the following relationships:
- **Owner**: The user (client) who owns the property.
- **Conveyancing Cases**: A property can be involved in multiple conveyancing cases.

### ConveyancingCase
The `ConveyancingCase` model represents the conveyancing process for a specific property. It includes details such as the conveyancer managing the case, the client involved, and the status of the case. The relationships include:
- **Property**: The property involved in the case.
- **Conveyancer**: The user (conveyancer) managing the case.
- **Client**: The user (client) involved in the case.
- **Documents**: The documents associated with the case.
- **Transactions**: The financial transactions related to the case.
- **Notes**: The notes made during the conveyancing process.

### Document
The `Document` model represents documents that are uploaded during the conveyancing process. Each document is associated with a specific conveyancing case and includes information about the file type and who uploaded it. The relationships include:
- **Conveyancing Case**: The case to which the document belongs.
- **Uploaded By**: The user who uploaded the document.

### Transaction
The `Transaction` model represents financial transactions related to a conveyancing case. This could include payments, deposits, or refunds. The relationships include:
- **Conveyancing Case**: The case to which the transaction belongs.

### Note
The `Note` model represents notes that are added to conveyancing cases. Notes can be used to track important information or updates during the process. The relationships include:
- **Conveyancing Case**: The case to which the note belongs.
- **User**: The user who created the note.

## Database Migrations
Each of the models is backed by a corresponding database table. Migrations for these tables are included in the `database/migrations` directory.

- `users` table: Stores user information.
- `properties` table: Stores property details.
- `conveyancing_cases` table: Stores details about conveyancing cases.
- `documents` table: Stores information about documents uploaded during the conveyancing process.
- `transactions` table: Stores financial transactions related to conveyancing cases.
- `notes` table: Stores notes added to conveyancing cases.

## Getting Started
1. Clone the repository.
2. Install dependencies using `composer install`.
3. Configure your `.env` file with your database and other settings.
4. Run migrations using `php artisan migrate`.
5. Run the application using `php artisan serve`.