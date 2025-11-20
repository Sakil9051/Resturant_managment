# Branch Protection Rules Configuration

This document outlines the recommended branch protection rules for the repository.

## Main Branch Protection

### Required Settings

1. **Require pull request reviews before merging**
   - Required approving reviews: 1
   - Dismiss stale pull request approvals when new commits are pushed: ✅
   - Require review from Code Owners: ✅

2. **Require status checks to pass before merging**
   - Require branches to be up to date before merging: ✅
   - Status checks that are required:
     - `test` (Run Tests)
     - `code-quality` (Code Quality Checks)
     - `security` (Security Scan)

3. **Require conversation resolution before merging**: ✅

4. **Require signed commits**: ✅ (Recommended)

5. **Require linear history**: ✅

6. **Include administrators**: ✅

7. **Restrict who can push to matching branches**
   - Only allow specific people/teams to push

8. **Allow force pushes**: ❌

9. **Allow deletions**: ❌

## Develop Branch Protection

### Required Settings

1. **Require pull request reviews before merging**
   - Required approving reviews: 1

2. **Require status checks to pass before merging**
   - Status checks that are required:
     - `test` (Run Tests)
     - `code-quality` (Code Quality Checks)

3. **Allow force pushes**: ❌

4. **Allow deletions**: ❌

## How to Apply These Rules

### Via GitHub Web Interface

1. Go to **Settings** → **Branches**
2. Click **Add rule** under "Branch protection rules"
3. Enter branch name pattern (e.g., `main` or `develop`)
4. Enable the settings listed above
5. Click **Create** or **Save changes**

### Via GitHub CLI

```bash
# Install GitHub CLI if not already installed
# https://cli.github.com/

# Protect main branch
gh api repos/Sakil9051/Resturant_managment/branches/main/protection \
  --method PUT \
  --field required_status_checks='{"strict":true,"contexts":["test","code-quality","security"]}' \
  --field enforce_admins=true \
  --field required_pull_request_reviews='{"required_approving_review_count":1,"dismiss_stale_reviews":true}' \
  --field restrictions=null \
  --field required_linear_history=true \
  --field allow_force_pushes=false \
  --field allow_deletions=false

# Protect develop branch
gh api repos/Sakil9051/Resturant_managment/branches/develop/protection \
  --method PUT \
  --field required_status_checks='{"strict":true,"contexts":["test","code-quality"]}' \
  --field required_pull_request_reviews='{"required_approving_review_count":1}' \
  --field restrictions=null \
  --field allow_force_pushes=false \
  --field allow_deletions=false
```

## CODEOWNERS File

Create a `.github/CODEOWNERS` file to automatically request reviews:

```
# Default owners for everything in the repo
*       @Sakil9051

# Specific ownership
/app/Controllers/    @Sakil9051
/app/Models/         @Sakil9051
/app/Views/          @Sakil9051
/.github/            @Sakil9051
```

## Rulesets (New GitHub Feature)

For more advanced protection, consider using GitHub Rulesets:

1. Go to **Settings** → **Rules** → **Rulesets**
2. Create a new ruleset
3. Apply to specific branches
4. Configure rules as needed

## Verification

After applying rules, verify by:

1. Attempting to push directly to `main` (should fail)
2. Creating a PR without passing checks (should be blocked)
3. Creating a PR with passing checks (should be mergeable)

## Notes

- Adjust the number of required reviewers based on team size
- Consider requiring specific reviewers for critical files
- Enable "Require deployments to succeed" if using deployment workflows
- Regularly review and update protection rules as team grows
