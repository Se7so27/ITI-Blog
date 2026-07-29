# Learnings

## Wave 1, Task 2 — composer.json metadata

- Changed `name` from `"laravel/laravel"` → `"se7so27/iti-blog"`
- Changed `description` from `"The skeleton application for the Laravel framework."` → `"ITI Blog — A full-featured blog built with Laravel 12, Inertia + Vue 3, and Tailwind CSS."`
- Only lines 3 and 5 were modified; all other fields left untouched
- Validated JSON with `json_decode` — output: "No error"

## Wave 1, Task 1: README.md rewrite

### What was done
- Rewrote the generic Laravel skeleton README.md into a project-specific README for ITI Blog.
- Removed all references to "About Laravel", "Laravel Sponsors", "Premium Partners", "Contributing", "Code of Conduct", "Security Vulnerabilities", badges, and links to Laravel resources.
- First line is now "# ITI Blog".

### Contents of new README
- Project description (full-featured blog platform with Laravel 12 + Inertia.js + Vue 3)
- Features list (auth, GitHub OAuth, CRUD with image upload + soft deletes, comments, tagging, admin dashboard, REST API, Tailwind CSS)
- Tech Stack (Laravel 12, Inertia.js + Vue 3, Tailwind CSS, MySQL)
- Prerequisites (PHP ^8.2, Composer, Node.js & npm, MySQL)
- Setup instructions (composer install, .env config, key:generate, migrate, npm install && npm run build, serve)
- GitHub OAuth setup note (GITHUB_CLIENT_ID and GITHUB_CLIENT_SECRET)
- API Documentation section referencing the Postman collection file with endpoint table
- Screenshots placeholder
- MIT License section

### Key observations
- composer.json confirms: PHP ^8.2, Laravel 12, Inertia, Sanctum, Socialite, Spatie Tags, Eloquent Sluggable, Ziggy
- package.json confirms: Vue 3, Inertia Vue 3 adapter, Tailwind CSS, Vite, Axios
- .env.example uses SQLite by default but project expects MySQL (DB_CONNECTION=sqlite is the default)
- API routes: POST /api/login (public), GET/POST /api/posts (authenticated via Sanctum), GET /api/posts/{id} (authenticated)
- Web routes: auth scaffold, ProfileController, PostController (with restore for soft deletes), CommentController, admin group with is-admin gate, GitHub OAuth routes
- Postman collection has 4 endpoints: Login, Get All Posts, Get Single Post, Create Post
- Notepads directory was empty before this task
