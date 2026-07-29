---
slug: publish-repo
status: awaiting-approval
intent: clear
pending-action: write .omo/plans/publish-repo.md
approach: Rewrite README to describe the actual project, fix composer.json metadata, update .env.example, create main branch from lab5, and verify nothing else needs changing before publishing.
---

# Draft: publish-repo

## Components (topology ledger)
<!-- Lock the SHAPE before depth. One row per top-level component that can succeed or fail independently. -->
<!-- id | outcome (one line) | status: active|deferred | evidence path -->
1. README.md rewrite | Active
2. composer.json metadata fix | Active
3. .env.example APP_NAME update | Active
4. Branch rename lab5 → main | Active
5. Pre-publish audit | Active

## Open assumptions (announced defaults)
<!-- Record any default you adopt instead of asking, so the user can veto it at the gate. -->
<!-- assumption | adopted default | rationale | reversible? -->
1. composer.json name | `se7so27/iti-blog` matching GitHub repo URL | Yes
2. composer.json description | "ITI Blog — A full-featured blog built with Laravel 12, Inertia + Vue 3, and Tailwind CSS" | Yes
3. .env.example APP_NAME | `"ITI Blog"` matching actual .env value | Yes

## Findings (cited - path:lines)
- Current README.md is the generic Laravel skeleton (README.md:1-59) — no project-specific content
- composer.json name is `laravel/laravel`, description is "The skeleton application for the Laravel framework." (composer.json:3-5)
- .env.example has `APP_NAME=Laravel` (.env.example:1) while actual .env has `APP_NAME="ITI Blog"` (.env:1)
- `.env` is gitignored (.gitignore:3)
- `docs/` folder is gitignored (.gitignore:26)
- `database/database.sqlite` is not tracked by git
- Remote origin: `https://github.com/Se7so27/ITI-Blog.git`
- Latest code is on `lab5` branch (113 files changed vs master, 7935 insertions)
- Tests exist with Pest PHP (tests/Feature/Auth/, tests/Unit/)

## Decisions (with rationale)
1. **Branch rename `lab5` → `main`** — User explicitly chose this. Creates a `main` branch from the current `lab5` state (the latest code), which is the modern GitHub default. Leaves `master` as-is with the initial scaffold for reference.
2. **composer.json name → `se7so27/iti-blog`** — Matches the GitHub repo `Se7so27/ITI-Blog` in Composer format.
3. **composer.json description** — Describes the actual project: "ITI Blog — A full-featured blog built with Laravel 12, Inertia + Vue 3, and Tailwind CSS."
4. **.env.example APP_NAME → "ITI Blog"** — Matches the actual `.env` value.

## Scope IN
1. Rewrite README.md with full project description, features, setup instructions, tech stack, screenshots placeholder, API docs reference
2. Fix composer.json name and description metadata
3. Update .env.example APP_NAME
4. Create `main` branch from `lab5` (rename lab5 → main)
5. Pre-publish audit: verify no secrets, no leftover scaffold references, .gitignore completeness

## Scope OUT (Must NOT have)
- Do NOT delete the `master` branch (user can do that independently)
- Do NOT push to remote (user triggers that themselves)
- Do NOT modify any application code (routes, controllers, models, views)
- Do NOT add new features, fix bugs, or refactor
- Do NOT create CI/CD workflows
- Do NOT write tests (existing tests are fine)
- Do NOT modify the docs/ folder (it's gitignored and irrelevant)

## Open questions
None. User answered the branch question. All other items adopted by default with explanation above.

## Approval gate
status: awaiting-approval
<!-- When exploration is exhausted and unknowns are answered, set status: awaiting-approval. -->
<!-- That durable record is the loop guard: on a later turn read it and resume at the gate instead of re-running exploration. -->
