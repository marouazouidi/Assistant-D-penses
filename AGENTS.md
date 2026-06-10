# AGENTS.md

## Project

Name: Assistant Expenses

Description:

A Laravel application that allows a small shop owner to paste raw supplier receipt text and automatically extract structured expense data using artificial intelligence.

The AI returns structured output which is validated and stored in the database.

The extraction process is executed asynchronously using Laravel Queues.

---

## Business Goals

* Eliminate manual receipt entry.
* Transform unstructured text into structured financial data.
* Automatically categorize expenses.
* Ensure data reliability and consistency.
* Enable expense tracking over time.

---

## Tech Stack

### Backend

* Laravel 13
* PHP 8.3

### Database

* MySQL

### Authentication

* Laravel Breeze

### AI Integration

* Laravel AI SDK
* Groq API (via configurable provider)

### Queue System

* Laravel Queue
* Database driver

### Testing

* Pest PHP

### Tools

* Git & GitHub
* Jira
* OpenSpec
* Laravel Debugbar

---

## System Architecture

### User

Handles authentication and owns receipts.

### Receipt (Recu)

Fields:

* text_source
* status
* raw_payload

Relationship:
User hasMany Receipts

### Expense (Depense)

Fields:

* label
* quantity
* unit_price
* category

Relationship:
Receipt hasMany Expenses

---

## Required Enums

### ReceiptStatus

* pending
* processed
* failed

### ExpenseCategory

* food
* drinks
* hygiene
* maintenance
* other

Enums must be used with Eloquent casts.

---

## Validation Rules

All input validation must be handled using Form Request classes.

Example:

* StoreReceiptRequest

Controllers must NOT contain validation logic.

---

## AI Extraction Rules

All extraction must use Laravel AI SDK.

Direct HTTP calls to Groq API are strictly forbidden.

The AI response must follow this JSON contract:

```json
{
  "articles": [
    {
      "label": "string",
      "quantity": 0,
      "unit_price": 0,
      "category": "food|drinks|hygiene|maintenance|other"
    }
  ],
  "total_estimated": 0,
  "currency": "MAD"
}
```

---

## Queue Processing (Mandatory)

AI processing must NEVER run inside controllers.

Workflow:

1. Receipt is created
2. Status set to pending
3. Job is dispatched
4. Queue worker processes job
5. Expenses are created
6. Status updated to processed or failed

The user must receive an immediate response without waiting.

---

## Eloquent Rules

Mandatory usage of:

* Relationships
* Eager loading (with, withCount)
* Casts (Enums, Arrays)

Avoid N+1 queries. Debug using Laravel Debugbar.

---

## Git Workflow

Mandatory branches:

* feature/auth
* feature/receipts-crud
* feature/ai-extraction
* feature/queue-processing
* feature/expenses
* feature/tests

No direct commits to main.

---

## Commit Conventions

All commits must be clear and descriptive.

Examples:

* feat(auth): implement authentication system
* feat(receipts): add receipt CRUD
* feat(queue): add AI extraction job
* feat(ai): integrate Laravel AI structured output
* test(ai): add deterministic extraction test with fake AI
* docs(spec): update OpenSpec documentation

Any AI-assisted work must be explicitly mentioned.

---

## OpenSpec Workflow

Before implementing any feature:

1. Proposal
2. Specification
3. Tasks

Folder structure:

```
specs/
  auth/
  receipts/
  ai-extraction/
```

Each feature must contain:

* proposal.md
* spec.md
* tasks.md

No feature is implemented without a specification.

---

## Testing Strategy

Critical features must be tested:

* Authentication
* Receipt creation
* AI extraction
* Expense persistence

Use Pest PHP.

Use Laravel AI fakes to avoid real API calls.

---

## Best Practices

* Follow MVC architecture strictly
* Keep controllers thin
* Use service classes when needed
* Follow SOLID principles where applicable
* Use strict typing in PHP
* Handle exceptions properly
* Log important errors
* Avoid duplication

---

## Development Workflow

For each feature:

1. Create OpenSpec
2. Switch to Plan mode
3. Validate plan
4. Implement feature
5. Write tests
6. Commit changes
7. Push to GitHub

No implementation without planning.
