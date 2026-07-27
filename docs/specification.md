# Docs Specification - Minimal ERP Sales, Inventory & Master Data System

The Minimal ERP Sales, Inventory & Master Data System provides small businesses with streamlined sales invoicing, multi-item order processing, automated stock deduction, payment recording, and inventory auditing capabilities. Built on Laravel 12 with Blade, Alpine.js, and Livewire, it integrates customer relationship records, supplier management, and product catalog controls into a clean transactional workflow. The system enforces strict database transactions (`DB::transaction`) during invoice commits to guarantee data integrity between billing subtotals and physical stock ledgers. Scope includes invoice drafting, customer linking, line-item pricing (with 11% PPN tax calculations and discount subtotals), inventory stock adjustments, payment ledger entries, and status transitions.

**Version:** 0.1.0  
**Owner:** Rizqy  
**Last Updated:** 2026-07-27

## Invoice & Sales Management - Create

### Objectives

- Create multi-item sales invoices with automatic subtotal, discount, tax (11%), and grand total calculations in under 15 seconds.
- Maintain 100% real-time stock integrity by executing atomic database transactions that decrement product stock and append `inventory_transactions` audit records upon invoice creation.

### Assumptions and Constraints

- Active user session with authenticated role containing `invoices.create` permission.
- Selected customer must exist in `customers` table and selected products must have `stock >= required qty`.
- Tax calculation defaults to 11% (`Config::get('app.tax_rate', 11)`) applied to `(subtotal - discount)`.

### Actors and Permissions

| Actor/Role | Permissions |
| --- | --- |
| Admin / Manager | `invoices.create`, `invoices.view`, `invoices.edit`, `invoices.delete`, `invoices.cancel`, `payments.create`, `inventory.adjust` |
| Sales Staff | `invoices.create`, `invoices.view`, `customers.view`, `products.view`, `payments.create` |
| Inventory Staff | `inventory.view`, `inventory.adjust`, `products.view`, `products.edit` |

### User Flow (Main)

Purpose: Primary user journey from entry to completion, focused on the happy path and key decisions.

```mermaid
graph TD
    A["ERP Navigation Menu"] --> B["Open Invoice Creation Page /app/invoices/create"]
    B --> C["Select Customer & Set Due Date"]
    C --> D["Add Product Line Items with Qty & Unit Price"]
    D --> E{"Valid Input & All Items Stock Available?"}
    E -->|Yes| F["Submit Form POST /app/invoices"]
    E -->|No| G["Display Out-of-Stock or Validation Alerts"]
    G --> D
    F --> H["Execute DB Transaction: Save Invoice, Items, Deduct Stock & Log Movement"]
    H --> I["Redirect to Invoice Detail View /app/invoices/id with Success Message"]
```

### Error and Validation Flow

Purpose: Validation, permission, and system error paths, including user feedback and recovery behavior.

```mermaid
graph TD
    A["Submit Invoice Form"] --> B{"Permission: invoices.create?"}
    B -->|No| C["Render 403 Forbidden Access Denied"]
    B -->|Yes| D{"Form Input Validated?"}
    D -->|No| E["Return Back with Field Validation Errors"]
    D -->|Yes| F{"Stock Check: Product Stock >= Qty?"}
    F -->|No| G["Throw InsufficientStockException & Return Flash Error"]
    F -->|Yes| H{"DB Transaction Commit OK?"}
    H -->|No| I["Rollback DB Transaction & Display System Exception"]
    H -->|Yes| J["Complete Order & Show Invoice Details"]
```

### Sequence Diagram - Create

Purpose: UI to API interactions for the create flow, including lookup calls and record insertion.

```mermaid
sequenceDiagram
    actor User
    participant UI
    participant API
    participant DB

    User->>UI: Navigate to /app/invoices/create
    UI->>API: GET /app/invoices/create
    API->>DB: Query Customer::all() & Product::all()
    DB-->>API: Active customers and products list
    API-->>UI: Render create form with products JSON dataset
    User->>UI: Select customer, input title, select products (qty, price), set discount & submit
    UI->>API: POST /app/invoices
    API->>DB: Begin DB::transaction
    API->>DB: Check Product stock availability
    alt Stock Available
        API->>DB: Insert record into invoices table
        API->>DB: Insert records into invoice_items table
        API->>DB: Decrement products.stock by qty
        API->>DB: Insert inventory_transactions (type: out, ref: invoice)
        API->>DB: Commit DB::transaction
        DB-->>API: Invoice ID & relational models
        API-->>UI: 302 Redirect to /app/invoices/id with success flash
        UI-->>User: Render invoice view page with printable layout
    else Stock Insufficient
        API->>DB: Rollback DB::transaction
        API-->>UI: 302 Redirect back with InsufficientStockException error
        UI-->>User: Display alert "Insufficient stock for product X"
    end
```

### Acceptance Criteria

1. Authenticated user with `invoices.create` permission can create an invoice with single or multiple line items.
2. Attempting to select a product with quantity exceeding available stock aborts creation and displays a clear error message.
3. Successful creation calculates `subtotal`, `tax` (11%), and `total`, decrements product stock, logs inventory movement (`type: out`), and sets invoice status to `pending` (or `draft`).

## Invoice & Sales Management - Update

### Objectives

- Support editing of existing invoices, adjusting item quantities, applying payments, or executing invoice cancellations.
- Automatically revert previous stock deductions, recalculate totals, apply new stock subtractions, and maintain transaction logs during edits.

### Assumptions and Constraints

- Invoices with status `paid` or `cancelled` cannot have their line items edited directly; payments or cancellation must follow dedicated routes.
- Invoice update operations execute inside atomic `DB::transaction` blocks.

### Actors and Permissions

| Actor/Role | Permissions |
| --- | --- |
| Admin / Manager | `invoices.edit`, `invoices.cancel`, `payments.create` |
| Sales Staff | `invoices.edit` (draft/pending invoices only), `payments.create` |

### User Flow (Main)

```mermaid
graph TD
    A["Invoice View /app/invoices/id"] --> B{"Select Action: Edit / Pay / Cancel"}
    B -->|Edit| C["Open Edit Form /app/invoices/id/edit & Modify Items"]
    B -->|Record Payment| D["Open Payment Modal & Input Amount & Method"]
    B -->|Cancel| E["Click Cancel Invoice & Confirm"]
    C --> F["Submit PUT /app/invoices/id"]
    D --> G["Submit POST /app/invoices/id/payments"]
    E --> H["Submit POST /app/invoices/id/cancel"]
    F --> I["Revert Old Stock, Delete Items, Re-insert & Deduct New Stock"]
    G --> J["Record Payment, Recalculate Paid Sum, Update Status to Partial/Paid"]
    H --> K["Revert All Item Stock, Update Status to Cancelled"]
    I --> L["Render Updated Invoice Summary"]
    J --> L
    K --> L
```

### Sequence Diagram - Update

Purpose: UI to API interactions for update flow, including permission checks and side effects.

```mermaid
sequenceDiagram
    actor User
    participant UI
    participant API
    participant DB

    User->>UI: Open invoice details /app/invoices/id
    UI->>API: GET /app/invoices/id
    API->>DB: Query Invoice with customer, items.product, payments
    DB-->>API: Invoice model payload
    API-->>UI: Display invoice status, balance due & payment history
    alt Action: Record Payment
        User->>UI: Input payment amount, method (cash/transfer/card/giro), notes & submit
        UI->>API: POST /app/invoices/id/payments
        API->>DB: Insert record into payments table
        API->>DB: Calculate total paid sum via payments()->sum('amount')
        API->>DB: Update invoice status to partial or paid
        DB-->>API: Payment saved & updated invoice
        API-->>UI: 302 Redirect to /app/invoices/id with success flash
        UI-->>User: Display updated payment list & balance due
    else Action: Cancel Invoice
        User->>UI: Click Cancel Invoice button
        UI->>API: POST /app/invoices/id/cancel
        API->>DB: Begin DB::transaction
        API->>DB: Loop items -> Increment product stock & log inventory_transactions
        API->>DB: Update invoice status to cancelled
        API->>DB: Commit DB::transaction
        DB-->>API: Invoice cancelled
        API-->>UI: 302 Redirect to /app/invoices/id
        UI-->>User: Show invoice status badge as Cancelled
    end
```

### Acceptance Criteria

1. Users can record full or partial payments (`cash`, `transfer`, `card`, `giro`), automatically updating invoice status to `partial` or `paid`.
2. Cancelling an invoice reverts product stock levels, logs inventory transactions (`type: in`), and updates invoice status to `cancelled`.
3. Updating an invoice recalculates subtotals, taxes, and discounts while maintaining accurate stock levels via transaction rollback/re-deduction.

## Shared Diagrams and References

### Error and Validation Flow

Purpose: Validation, permission, and system error paths, including user feedback and recovery behavior.

```mermaid
graph TD
    A["Submit Action"] --> B{"Permission OK?"}
    B -->|No| C["Show Access Denied"]
    B -->|Yes| D{"Validation OK?"}
    D -->|No| E["Highlight Invalid Fields"]
    D -->|Yes| F{"API Success?"}
    F -->|No| G["Show Error Message"]
    F -->|Yes| H["Continue Success Flow"]
```

### Data Model (ERD)

Purpose: Tables, relations, and key constraints required by this feature.

```mermaid
erDiagram
    users ||--o{ invoices : creates
    customers ||--o{ invoices : places
    suppliers ||--o{ products : supplies
    invoices ||--o{ invoice_items : contains
    products ||--o{ invoice_items : included_in
    invoices ||--o{ payments : receives
    products ||--o{ inventory_transactions : logs

    users {
        bigint id PK
        string name
        string email UK
        string password
        datetime created_at
        datetime updated_at
    }

    customers {
        bigint id PK
        string name
        string email UK
        string phone
        text address
        string company
        datetime created_at
        datetime updated_at
    }

    suppliers {
        bigint id PK
        string name
        string email UK
        string phone
        text address
        string company
        datetime created_at
        datetime updated_at
    }

    products {
        bigint id PK
        string name
        string sku UK
        decimal price
        decimal cost
        integer stock
        integer min_stock
        string unit
        datetime created_at
        datetime updated_at
    }

    invoices {
        bigint id PK
        bigint customer_id FK
        string invoice_number UK
        string title
        string reference
        decimal subtotal
        decimal discount
        decimal tax
        decimal total
        enum status
        date due_date
        string payment_method
        datetime created_at
        datetime updated_at
        datetime deleted_at
    }

    invoice_items {
        bigint id PK
        bigint invoice_id FK
        bigint product_id FK
        integer qty
        decimal price
        decimal subtotal
        datetime created_at
        datetime updated_at
    }

    payments {
        bigint id PK
        bigint invoice_id FK
        decimal amount
        enum method
        datetime paid_at
        text notes
        datetime created_at
        datetime updated_at
    }

    inventory_transactions {
        bigint id PK
        bigint product_id FK
        integer qty
        enum type
        string reference_type
        bigint reference_id
        text notes
        datetime created_at
        datetime updated_at
    }
```

### API Contract Reference

| No | File | Description |
| --- | --- | --- |
| 1 | [contract-api/feature-openapi.yaml](contract-api/feature-openapi.yaml) | OpenAPI spec for ERP routes, request validations, models, and error responses. |

### Mock Data Reference

| No | File | Description |
| --- | --- | --- |
| 1 | [mockoon/feature-mock.json](mockoon/feature-mock.json) | Mock endpoints and sample JSON payloads for ERP invoices, products, and payments. |

### State or Status Lifecycle (Optional)

Invoices follow the state transition lifecycle: `draft` -> `pending` -> `partial` -> `paid` (or `overdue`/`cancelled`). Invoices with `due_date` prior to current date without full payment transition to `overdue`.

### Edge Cases

- **Race Condition on Stock**: Two concurrent requests attempting to purchase the last available item stock trigger `InsufficientStockException` on the second transaction and safely rollback.
- **Partial Payments**: Multiple small payments logged until cumulative sum equals or exceeds `invoices.total`, transitioning status from `partial` to `paid`.
- **Invoice Cancellation**: Cancelling an invoice with logged payments preserves payment audit records while restoring inventory stock via `type: in` transaction logs.

### Observability

- **Inventory Audit Trail**: Every stock change is permanently logged in `inventory_transactions` with `reference_type` (`invoice`, `invoice_update`, `invoice_cancel`, `manual_adjust`) and `reference_id`.
- **Performance Indexes**: Indexes applied on `invoices.status`, `invoices.customer_id`, `invoices.invoice_number`, `invoice_items.invoice_id`, `payments.invoice_id`, and `inventory_transactions.product_id`.
- **Exception Logging**: `InsufficientStockException` logged with product ID, requested quantity, and available stock metrics.

## Change Log

| Date | Author | Change |
| --- | --- | --- |
| 2026-07-27 | Rizqy | Fixed Mermaid syntax syntax errors (double quotes around nodes with slashes/braces, non-nested sequence diagram alt blocks, clean ERD enums). |
