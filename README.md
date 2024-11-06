# How to run App

To get the application up and running locally, follow the steps below

1. **Set up the environment**:
    - Copy the `.env.example` file to `.env`:
      ```bash
      cp .env.example .env
      ```
    - Open the `.env` file and set the `DB_DATABASE` variable to the path of your SQLite database file:
      ```env
      DB_DATABASE=path_to_your_database/database.sqlite
      ```

2. **Install dependencies**:
    - Run the following command to install the required PHP dependencies:
      ```bash
      composer install
      ```
    - Alternatively, you can use `composer update` if you want to update the dependencies:
      ```bash
      composer update
      ```

3. **Run the local server**:
    - Start the Laravel development server:
      ```bash
      php artisan serve
      ```
    - This will start the server at `http://127.0.0.1:8000`.

4. **Run database migrations**:
    - Execute the migrations to create the necessary database tables:
      ```bash
      php artisan migrate
      ```

5. **Seed the database (optional)**:
    - You can seed the database with sample data by running:
      ```bash
      php artisan db:seed
      ```

After completing these steps, the application should be up and running on your local environment.

---


# API v1 Documentation

This API provides endpoints to manage books and clients. 
It includes functionality for storing, retrieving, borrowing, and returning books, as well as managing client information.

## Base URL
---

## Endpoints

### **Books**

#### `GET /books`
**Description**: Retrieves a paginated list of all books, optionally filtered by a search query.

**Query Parameters**:
- `search` (optional): Search term to filter books by title or author.

**Response**:
- 200: Successful retrieval of the book list.

---

#### `POST /books`
**Description**: Adds a new book to the collection.

**Request Body**:
- `title`: The title of the book.
- `author`: The author of the book.

**Response**:
- 201: The book was successfully created.
- 422: Validation failed.

---

#### `GET /books/{id}`
**Description**: Fetches details of a book by its ID.

**Response**:
- 200: Successful retrieval of the book details.
- 404: Book not found.

---

#### `PATCH /books/{id}/borrow`
**Description**: Marks a book as borrowed and associates it with a client.

**Request Body**:
- `client_id`: The ID of the client borrowing the book.

**Response**:
- 200: The book has been successfully borrowed.
- 400: The book is already borrowed.
- 404: Book or client not found.
- 500: Internal server error.

---

#### `PATCH /books/{id}/return`
**Description**: Marks a borrowed book as returned and disassociates it from the client.

**Response**:
- 200: The book has been successfully returned.
- 400: The book was not borrowed.
- 404: Book not found.
- 500: Internal server error.

---

### **Clients**

#### `GET /clients`
**Description**: Retrieves a list of all clients.

**Response**:
- 200: Successful retrieval of the client list.

---

#### `POST /clients`
**Description**: Adds a new client.

**Request Body**:
- `first_name`: The first_name of the client.
- `last_name`: The last_name of the client.

**Response**:
- 201: The client was successfully created.
- 500: Internal server error.

---

#### `GET /clients/{id}`
**Description**: Retrieves details of a specific client by ID, including their borrowed books.

**Response**:
- 200: Successful retrieval of the client details.
- 404: Client not found.

---

#### `DELETE /clients/{id}`
**Description**: Deletes a client by ID.

**Response**:
- 200: The client was successfully deleted.
- 404: Client not found.
- 500: Internal server error.

---
