# ITI Blog

A full-featured blog platform built with Laravel 12, Inertia.js, and Vue 3. Includes user authentication, role-based admin dashboard, blog post management with image uploads and soft deletes, comments, tagging, GitHub OAuth login, and a REST API secured with Sanctum tokens.

## Features

- User authentication (register, login, password reset, email verification)
- GitHub OAuth login via Laravel Socialite
- Blog post CRUD with image upload and soft deletes
- Comments system on posts
- Tagging with Spatie Tags package
- Admin dashboard with role-based access
- REST API with Sanctum token authentication
- Responsive UI with Tailwind CSS

## Tech Stack

- **Backend:** Laravel 12
- **Frontend:** Inertia.js + Vue 3
- **Styling:** Tailwind CSS
- **Database:** MySQL

## Prerequisites

- PHP ^8.2
- Composer
- Node.js and npm
- MySQL

## Setup Instructions

1. Clone the repository:
   ```bash
   git clone https://github.com/Se7so27/ITI-Blog.git
   cd ITI-Blog
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Copy the environment file and configure your database credentials:
   ```bash
   cp .env.example .env
   ```

4. Generate the application key:
   ```bash
   php artisan key:generate
   ```

5. Run database migrations:
   ```bash
   php artisan migrate
   ```

6. Install and build frontend assets:
   ```bash
   npm install && npm run build
   ```

7. Start the development server:
   ```bash
   php artisan serve
   ```

### GitHub OAuth Setup

To enable GitHub login, register a new OAuth application at GitHub Developer Settings and add the following variables to your `.env` file:

```
GITHUB_CLIENT_ID=your-client-id
GITHUB_CLIENT_SECRET=your-client-secret
```

## API Documentation

A Postman collection is available at `ITI-Blog-API.postman_collection.json` in the project root. Import it into Postman to explore and test the available endpoints.

| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| POST   | `/api/login` | Authenticate and receive a Sanctum token | No |
| GET    | `/api/posts` | List all posts | Bearer Token |
| GET    | `/api/posts/{id}` | Get a single post | Bearer Token |
| POST   | `/api/posts` | Create a new post | Bearer Token |

All API requests (except login) require a `Bearer` token in the `Authorization` header. Obtain your token by calling `POST /api/login` with valid credentials.

## Screenshots

(Screenshots to be added)

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
