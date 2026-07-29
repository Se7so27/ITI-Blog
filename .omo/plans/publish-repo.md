# publish-repo - Work Plan

## TL;DR (For humans)
<!-- Fill this LAST, after the detailed plan below is written, so it summarizes the REAL plan. -->
<!-- Plain English for a non-engineer: NO file paths, NO todo numbers, NO wave/agent/tool names. -->

**What you'll get:** Your GitHub repo will have a proper README explaining what ITI Blog is and how to run it, correct package metadata, and `main` as the default branch with your latest code instead of the old lab branches.

**Why this approach:** The README is the first thing visitors see — a generic Laravel skeleton README makes the project look abandoned. Fixing composer.json and .env.example ensures the project metadata is accurate. Creating a `main` branch from your latest `lab5` work gives the repo a clean, modern default branch.

**What it will NOT do:** No code changes (no new features, no bug fixes, no refactoring). No pushing to GitHub — that's your call. No deleting the `master` or lab branches — you can clean those up yourself.

**Effort:** Short
**Risk:** Low — all changes are metadata/README/branching, no application code touched
**Decisions to sanity-check:** Branch rename lab5 → main (your choice)

Your next move: **Approve this plan** to start execution, or ask for changes. Full execution detail follows below.

---

> TL;DR (machine): Short effort, Low risk — rewrite README, fix composer.json + .env.example metadata, create main branch from lab5, audit for leaks. 5 sequential todos, 0 application code changes.

## Scope
### Must have
1. Rewrite README.md with full project description, features, tech stack, setup, API docs
2. Fix composer.json name (`se7so27/iti-blog`) and description
3. Update .env.example APP_NAME to `"ITI Blog"`
4. Create `main` branch from current `lab5` state
5. Pre-publish audit (secrets, gitignore, leftover scaffold refs)

### Must NOT have (guardrails, anti-slop, scope boundaries)
- No application code changes (routes, controllers, models, views, Vue components)
- No new features, bug fixes, or refactoring
- No CI/CD workflows
- No test changes (existing tests stay)
- No push to remote — user triggers that
- No deletion of `master` or lab branches

## Verification strategy
> Zero human intervention - all verification is agent-executed.
- Test decision: tests-after (read-only audit, no new tests needed)
- Evidence: .omo/evidence/publish-repo/
  - task-1: README content audit
  - task-2: composer.json metadata verification
  - task-3: .env.example APP_NAME check
  - task-4: git branch -a output showing main exists
  - task-5: secrets/leaks audit log

## Execution strategy
### Parallel execution waves
> Target 5-8 todos per wave. Fewer than 3 (except the final) means you under-split.

**Wave 1** — Parallel metadata fixes (Todos 1, 2, 3)
**Wave 2** — Branch operation (Todo 4) — sequential after Wave 1
**Wave 3** — Audit (Todo 5) — sequential after Wave 2

### Dependency matrix
| Todo | Depends on | Blocks | Can parallelize with |
| --- | --- | --- | --- |
| 1. README rewrite | — | — | 2, 3 |
| 2. composer.json fix | — | — | 1, 3 |
| 3. .env.example fix | — | — | 1, 2 |
| 4. Branch main | 1, 2, 3 | 5 | — |
| 5. Pre-publish audit | 4 | — | — |

## Todos
> Implementation + Test = ONE todo. Never separate.
<!-- APPEND TASK BATCHES BELOW THIS LINE WITH edit/apply_patch - never rewrite the headers above. -->
- [ ] 1. Rewrite README.md with full project documentation
  What to do / Must NOT do: Replace the entire README.md (currently generic Laravel skeleton) with a project-specific README covering: project name/tagline, description, features list, tech stack (Laravel 12, Inertia + Vue 3, Tailwind CSS, MySQL), prerequisites, setup instructions (composer install, .env, npm install, migrate, npm run build), GitHub OAuth setup note, API documentation reference linking to the Postman collection file, screenshots placeholder, license. Must NOT include emoji, must NOT keep any generic Laravel skeleton text. Must NOT add screenshots (just a placeholder section).
  Parallelization: Wave 1 | Blocked by: — | Blocks: —
  References: Project structure explored via codegraph_explore (PostController.php, routes/web.php, routes/api.php, routes/auth.php, composer.json, package.json, .env example, models), ITI-Blog-API.postman_collection.json for API doc reference
  Acceptance criteria: `head -5 README.md | grep -q "ITI Blog"` — first lines mention the project name. `grep -q "Laravel 12" README.md` — mentions the framework. `grep -q "Inertia" README.md` — mentions Inertia. `grep -c "About Laravel\|Laravel Sponsors\|Premium Partners" README.md | xargs test 0 -eq` — no generic Laravel text remains.
  QA scenarios: Read README.md and verify: (happy) contains ITI Blog, Laravel 12, Inertia, Vue 3, Tailwind CSS, setup instructions, API reference. (failure) does NOT contain "About Laravel", "Laravel Sponsors", "Premium Partners". Evidence .omo/evidence/publish-repo/task-1-readme-audit.txt
  Commit: Y | docs: rewrite README with full project documentation

- [ ] 2. Fix composer.json package name and description
  What to do / Must NOT do: In composer.json, change `"name": "laravel/laravel"` to `"name": "se7so27/iti-blog"` and change `"description": "The skeleton application for the Laravel framework."` to `"description": "ITI Blog — A full-featured blog built with Laravel 12, Inertia + Vue 3, and Tailwind CSS."`. Must NOT change any other fields. Must NOT modify the require/require-dev dependencies.
  Parallelization: Wave 1 | Blocked by: — | Blocks: —
  References: composer.json:3-5 (current name and description), GitHub remote origin `Se7so27/ITI-Blog.git`
  Acceptance criteria: `grep -q '"name": "se7so27/iti-blog"' composer.json` — name matches. `grep -q 'ITI Blog' composer.json` — description mentions the project. `grep -q '"laravel/laravel"' composer.json && exit 1 || exit 0` — old name is gone.
  QA scenarios: Read composer.json lines 1-10: (happy) name is se7so27/iti-blog, description is ITI Blog. (failure) no "laravel/laravel" remains. Evidence .omo/evidence/publish-repo/task-2-composer-audit.txt
  Commit: Y | chore: fix composer.json package name and description

- [ ] 3. Update .env.example APP_NAME
  What to do / Must NOT do: Change `APP_NAME=Laravel` to `APP_NAME="ITI Blog"` in .env.example to match the actual .env value. Must NOT change any other environment variables. Must NOT touch the actual .env file.
  Parallelization: Wave 1 | Blocked by: — | Blocks: —
  References: .env.example:1 (APP_NAME=Laravel), .env:1 (APP_NAME="ITI Blog")
  Acceptance criteria: `grep -q 'APP_NAME="ITI Blog"' .env.example` — updated. `grep -q 'APP_NAME=Laravel' .env.example && exit 1 || exit 0` — old value gone.
  QA scenarios: Read .env.example line 1: (happy) APP_NAME="ITI Blog". (failure) no APP_NAME=Laravel remains. Evidence .omo/evidence/publish-repo/task-3-env-audit.txt
  Commit: Y | chore: update .env.example APP_NAME to match project

- [ ] 4. Create main branch from lab5
  What to do / Must NOT do: Create a new `main` branch at the current `lab5` HEAD. This is done with: `git checkout lab5 && git branch -m lab5 main`. This renames `lab5` to `main` in-place (no merge needed). Must NOT delete the `master` branch. Must NOT push to remote. Must NOT delete any other lab branches.
  Parallelization: Wave 2 | Blocked by: Todos 1, 2, 3 committed | Blocks: Todo 5
  References: Current HEAD on lab5 (hash bf4eb37), remote origin with master as default
  Acceptance criteria: `git branch --list main | grep -q main` — main exists. `git rev-parse main` outputs the same hash as lab5's last commit. `git branch --list lab5 | wc -c` is 0 — lab5 no longer exists as a branch name.
  QA scenarios: Run `git branch -a`: (happy) shows `* main` as current branch, `master` still exists, lab branch names may show in remotes. (failure) main doesn't exist or lab5 still exists locally. Evidence .omo/evidence/publish-repo/task-4-branch-audit.txt
  Commit: N (infrastructure — no new content to commit)

- [ ] 5. Pre-publish audit: verify no leaks or scaffold remnants
  What to do / Must NOT do: Run a thorough audit before publishing is final. Check: (1) `grep -r "APP_KEY=" .env.example` — must not have a real key. (2) `git ls-files | grep -i "\.env$"` — .env must not be tracked. (3) `git ls-files database/database.sqlite` — sqlite file must not be tracked. (4) `grep -rn "laravel/laravel" composer.json` — must be gone. (5) `grep -rn "skeleton" composer.json` — must be gone. (6) `grep -rn "About Laravel\|Laravel Sponsors" README.md` — must be gone. Log all results to evidence file. Must NOT modify any files during this step.
  Parallelization: Wave 3 | Blocked by: Todo 4 | Blocks: —
  References: .env.example, .gitignore, composer.json, README.md, .env
  Acceptance criteria: All 6 checks pass — exit code 0 on all grep-for-present checks and exit code 1 on all grep-for-absent checks. Evidence file written to .omo/evidence/publish-repo/task-5-audit.txt with pass/fail per check.
  QA scenarios: Read the audit evidence file: (happy) all 6 checks show PASS. (failure) any check shows FAIL. Evidence .omo/evidence/publish-repo/task-5-audit.txt
  Commit: N (audit only, no changes)

## Final verification wave
> Runs in parallel after ALL todos. ALL must APPROVE. Surface results and wait for the user's explicit okay before declaring complete.
- [ ] F1. Plan compliance audit — verify all 5 todos completed with evidence files
- [ ] F2. Code quality review — verify no application code was modified (git diff --stat should only show README.md, composer.json, .env.example)
- [ ] F3. Real manual QA — Read the new README.md end-to-end; verify git branch output shows main as active
- [ ] F4. Scope fidelity — confirm nothing from Must NOT have was violated

## Commit strategy
- Todo 1 → `docs: rewrite README with full project documentation`
- Todo 2 → `chore: fix composer.json package name and description`
- Todo 3 → `chore: update .env.example APP_NAME to match project`
- Todo 4 → No commit (branch rename is infrastructure)
- Todo 5 → No commit (audit only)

Final commit summary on `main`: 3 new commits on top of the existing `lab5` history.

## Success criteria
1. README.md describes the ITI Blog project, not Laravel skeleton
2. composer.json has correct name (`se7so27/iti-blog`) and project description
3. .env.example has APP_NAME="ITI Blog"
4. `main` branch exists at lab5 HEAD
5. Pre-publish audit passes all 6 security/cleanliness checks
6. git diff shows ONLY README.md, composer.json, .env.example changed (no application code touched)
