# AGENTS.md

## Cursor Cloud specific instructions

This is a Laravel 12 (PHP 8.3) AdminLTE admin-panel app with a Vite/Tailwind
frontend. Auth is built on Laravel Breeze, roles/permissions on
spatie/laravel-permission, and the database is SQLite
(`database/database.sqlite`).

### Services

- **Backend (Laravel)** — `php artisan serve --host=0.0.0.0 --port=8000`.
- **Frontend (Vite dev server)** — `npm run dev` (serves hot assets on `:5173`;
  the backend serves the actual pages on `:8000`). Both must run for local
  development; alternatively `npm run build` produces static assets under
  `public/build`.
- `composer dev` runs server + queue + logs + vite together via concurrently.

### One-time DB setup (already covered by the update script for deps only)

The update script only installs/refreshes dependencies. After dependencies are
installed you must have a usable database. On a fresh checkout run:

```
php artisan migrate --force
php artisan db:seed --force      # creates roles + seeded users
php artisan storage:link         # needed for avatar uploads (public disk)
```

`migrate:fresh` is safe and recreates everything.

### Seeded login credentials

- `admin@gmail.com` / `password123` (admin)
- `superadmin@gmail.com` / `password123` (superadmin)
- `user@gmail.com` / `password123` (user)

`/` redirects to `/login`; after login you land on `/dashboard`.

### Lint / test / build

- Lint: `./vendor/bin/pint --test` (omit `--test` to auto-fix). The existing
  codebase has many pre-existing style violations; Pint runs fine, it just
  reports them.
- Tests: `php artisan test` (Pest). The runner works, but the default Breeze
  test suite (`tests/Feature/Auth/*`, `tests/Feature/ProfileTest.php`) and
  `database/factories/UserFactory.php` were left targeting the stock Breeze
  schema (a `name` column and `PATCH`/`DELETE /profile` routes). The app was
  customized to `first_name`/`last_name` and `PUT /profile`, so most of those
  tests fail for pre-existing reasons unrelated to environment setup. Do not
  treat those failures as a broken environment.
- Build: `npm run build`.

### Non-obvious gotchas discovered during setup

- The repository was missing the standard
  `0001_01_01_000000_create_users_table.php` migration entirely (users /
  password_reset_tokens / sessions). It has been re-added with the columns the
  controllers and seeders actually use (`first_name`, `last_name`, `bio`,
  `is_admin`, `role`). Without it, all migrations fail.
- `database/migrations/CreateProfileSeeder.php` is NOT a real migration (it
  extends `Seeder`, not `Migration`, and references a nonexistent
  `App\Models\Profile`). The migrator harmlessly ignores it — leave it alone.
- `resources/css/app.css` is a ~17k-line FontAwesome dump used as a Vite entry.
  A single missing `{` (fixed in this branch) breaks the whole asset build.
