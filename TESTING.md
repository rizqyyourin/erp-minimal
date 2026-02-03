# ERP Testing Documentation

## Test Environment Setup
- **Base URL**: http://localhost:8000
- **Login URL**: http://localhost:8000/login
- **App Base**: http://localhost:8000/app

## Test Credentials
- **Email**: test@gmail.com
- **Password**: password123

---

## 1. Overview/Dashboard Page

### Test Case 1.1: Dashboard Load
**Objective**: Verify dashboard displays correctly with stats
**Steps**:
1. Login with valid credentials
2. Navigate to /app (or click Overview in sidebar)
3. Verify page loads without errors

**Expected Results**:
- ✅ Page title shows "Today - Overview"
- ✅ 4 stat cards displayed:
  - MRR (Monthly Recurring Revenue)
  - Outstanding invoices count & amount
  - Low stock items count
  - Payments today amount & count
- ✅ Recent Invoices section visible
- ✅ Critical items section visible
- ✅ "+ New invoice" button in header

### Test Case 1.2: Dashboard Stats Calculation
**Objective**: Verify stats are calculated correctly
**Steps**:
1. Create test invoice with amount Rp 1,000,000
2. Refresh dashboard
3. Check MRR increases

**Expected Results**:
- ✅ MRR reflects current month invoices
- ✅ Outstanding count matches unpaid invoices
- ✅ Low stock shows items below minimum

### Test Case 1.3: Recent Invoices Display
**Objective**: Verify recent invoices list
**Steps**:
1. Create 3 test invoices
2. Check Recent Invoices section

**Expected Results**:
- ✅ Shows last 5 invoices
- ✅ Each invoice shows: number, customer, status badge, amount, due date
- ✅ Status badges: paid (green), pending (yellow), partial (blue), cancelled (gray)
- ✅ Clicking invoice navigates to detail page

### Test Case 1.4: Critical Stock Display
**Objective**: Verify critical/low stock items
**Steps**:
1. Create product with stock = 2, min_stock = 5
2. Check Critical items section

**Expected Results**:
- ✅ Shows products with stock <= min_stock
- ✅ Shows stock count and status badge
- ✅ Status: Healthy (green), Low (yellow), Critical (red)

---

## 2. Products Page

### Test Case 2.1: Products List
**Objective**: View all products
**Steps**:
1. Navigate to /app/products
2. Verify product list displays

**Expected Results**:
- ✅ Products table/list visible
- ✅ Columns: Name, SKU, Price, Stock, Status
- ✅ Pagination if > 10 products
- ✅ Search/filter functionality works

### Test Case 2.2: Create Product
**Objective**: Add new product
**Steps**:
1. Click "New Product" button
2. Fill form:
   - Name: Test Product
   - SKU: TEST-001
   - Price: 100000
   - Stock: 50
   - Min Stock: 10
   - Description: Test description
3. Click Save

**Expected Results**:
- ✅ Form validation works (required fields)
- ✅ Success message: "Product created successfully"
- ✅ Product appears in list
- ✅ SKU must be unique

### Test Case 2.3: Edit Product
**Objective**: Update existing product
**Steps**:
1. Click Edit on existing product
2. Change price to 150000
3. Click Save

**Expected Results**:
- ✅ Form pre-filled with current data
- ✅ Success message on save
- ✅ Changes reflected in list

### Test Case 2.4: Delete Product
**Objective**: Remove product
**Steps**:
1. Click Delete on product
2. Confirm deletion

**Expected Results**:
- ✅ Confirmation dialog appears
- ✅ Success message: "Product deleted successfully"
- ✅ Product removed from list
- ❌ Cannot delete if product used in invoices (should show error)

---

## 3. Customers Page

### Test Case 3.1: Customers List
**Objective**: View all customers
**Steps**:
1. Navigate to /app/customers

**Expected Results**:
- ✅ Customer table/list visible
- ✅ Columns: Name, Email, Phone, Address, Actions
- ✅ Search functionality works

### Test Case 3.2: Create Customer
**Objective**: Add new customer
**Steps**:
1. Click "New Customer"
2. Fill form:
   - Name: PT Test Customer
   - Email: customer@test.com
   - Phone: 08123456789
   - Address: Jl. Test No. 123
3. Save

**Expected Results**:
- ✅ Email validation (valid format)
- ✅ Success message displayed
- ✅ Customer appears in list

### Test Case 3.3: Customer Detail
**Objective**: View customer information
**Steps**:
1. Click on customer name

**Expected Results**:
- ✅ Customer details page loads
- ✅ Shows all customer info
- ✅ Shows customer's invoice history
- ✅ Shows total purchase amount

### Test Case 3.4: Edit & Delete Customer
**Objective**: Update and remove customer
**Steps**:
1. Edit customer phone number
2. Save
3. Delete test customer

**Expected Results**:
- ✅ Edit saves successfully
- ✅ Delete with confirmation
- ❌ Cannot delete if customer has invoices

---

## 4. Invoices Page

### Test Case 4.1: Invoices List
**Objective**: View all invoices
**Steps**:
1. Navigate to /app/invoices

**Expected Results**:
- ✅ Invoice list visible
- ✅ Columns: Invoice #, Customer, Date, Due Date, Amount, Status, Actions
- ✅ Status filter works (All, Paid, Pending, Partial, Cancelled)
- ✅ Date range filter works

### Test Case 4.2: Create Invoice
**Objective**: Create new invoice
**Preconditions**: Have at least 1 customer and 1 product
**Steps**:
1. Click "New Invoice"
2. Select Customer from dropdown
3. Set Due Date (future date)
4. Add items:
   - Select Product
   - Quantity: 2
   - Price auto-filled
   - Discount: 10%
5. Add second item
6. Verify subtotal, tax (if any), total
7. Click Create

**Expected Results**:
- ✅ Customer selection required
- ✅ At least 1 item required
- ✅ Price calculated correctly: qty × price × (1 - discount)
- ✅ Total = sum of all items
- ✅ Invoice number auto-generated (format: INV-YYYY-XXXX)
- ✅ Status defaults to "pending"
- ✅ Success message shown

### Test Case 4.3: View Invoice Detail
**Objective**: View complete invoice
**Steps**:
1. Click on invoice number

**Expected Results**:
- ✅ Shows invoice header (number, date, due date)
- ✅ Shows customer info
- ✅ Shows item list with details
- ✅ Shows subtotal, tax, total
- ✅ Shows status prominently
- ✅ Shows payment history (if any)

### Test Case 4.4: Record Payment
**Objective**: Add payment to invoice
**Steps**:
1. Open pending invoice
2. Click "Record Payment"
3. Enter amount (e.g., partial payment)
4. Select payment method
5. Add notes
6. Save

**Expected Results**:
- ✅ Payment amount cannot exceed remaining balance
- ✅ Invoice status updates:
  - Full payment: "paid"
  - Partial: "partial"
- ✅ Payment appears in payment history
- ✅ Total paid amount updated

### Test Case 4.5: Cancel Invoice
**Objective**: Cancel unpaid invoice
**Steps**:
1. Open pending invoice
2. Click "Cancel Invoice"
3. Confirm cancellation

**Expected Results**:
- ✅ Only unpaid invoices can be cancelled
- ✅ Status changes to "cancelled"
- ✅ Stock returned (if applicable)
- ✅ Success message shown
- ❌ Cannot cancel already paid invoice

---

## 5. Inventory Page

### Test Case 5.1: Inventory List
**Objective**: View stock levels
**Steps**:
1. Navigate to /app/inventory

**Expected Results**:
- ✅ Shows all products with stock levels
- ✅ Visual indicator for low/critical stock
- ✅ Shows: Product, SKU, Current Stock, Min Stock, Status

### Test Case 5.2: Stock Adjustment
**Objective**: Adjust stock manually
**Steps**:
1. Click "Adjust Stock"
2. Select Product
3. Enter adjustment:
   - Type: Add/Remove
   - Quantity: 10
   - Reason: Purchase return
4. Save

**Expected Results**:
- ✅ Stock updated correctly
- ✅ Adjustment history recorded
- ✅ Shows who made adjustment and when
- ❌ Cannot go below 0 stock

---

## 6. Reports Page

### Test Case 6.1: View Reports
**Objective**: View financial reports
**Steps**:
1. Navigate to /app/reports

**Expected Results**:
- ✅ Shows multiple report sections:
  - Revenue report (chart)
  - Top products
  - Top customers
  - Outstanding payments
- ✅ Date range selector works
- ✅ Charts render correctly

### Test Case 6.2: Export Report
**Objective**: Export report data
**Steps**:
1. Set date range
2. Click "Export to PDF/Excel"

**Expected Results**:
- ✅ File downloads successfully
- ✅ Data matches displayed report

---

## 7. Users Page

### Test Case 7.1: Users List
**Objective**: View team members
**Steps**:
1. Navigate to /app/users

**Expected Results**:
- ✅ Shows user list
- ✅ Shows: Name, Email, Role, Status, Joined Date
- ✅ Cannot delete own account

### Test Case 7.2: Create User
**Objective**: Add team member
**Steps**:
1. Click "New User"
2. Fill form:
   - Name: Test User
   - Email: testuser@company.com
   - Password: password123
   - Role: Select from dropdown
3. Save

**Expected Results**:
- ✅ Email must be unique
- ✅ Password minimum 6 characters
- ✅ User can login with credentials
- ✅ Success message shown

### Test Case 7.3: Delete User
**Objective**: Remove team member
**Steps**:
1. Click Delete on other user (not yourself)
2. Confirm

**Expected Results**:
- ✅ Confirmation required
- ❌ Cannot delete own account (error message)
- ✅ Success message for valid deletion

---

## 8. Suppliers Page

### Test Case 8.1: Suppliers List
**Objective**: View suppliers
**Steps**:
1. Navigate to /app/suppliers

**Expected Results**:
- ✅ Supplier list visible
- ✅ Shows: Name, Contact, Email, Phone, Address

### Test Case 8.2: CRUD Operations
**Objective**: Create, Read, Update, Delete supplier
**Steps**:
1. Create new supplier with all fields
2. View supplier details
3. Edit supplier info
4. Delete supplier

**Expected Results**:
- ✅ All CRUD operations work
- ✅ Validation on required fields
- ❌ Cannot delete if supplier linked to products

---

## Edge Cases & Error Handling

### Error Scenarios to Test:

1. **Unauthorized Access**
   - Try accessing /app/* without login
   - Expected: Redirect to login page

2. **Invalid Data**
   - Submit forms with empty required fields
   - Submit with invalid email format
   - Submit with duplicate unique fields (SKU, Email)
   - Expected: Validation errors displayed

3. **Concurrent Actions**
   - Edit same record from two browsers
   - Expected: Last save wins or conflict warning

4. **Large Data Sets**
   - Test with 100+ products/invoices
   - Expected: Pagination works, page loads < 3 seconds

5. **Deleted References**
   - Try to create invoice with deleted customer
   - Expected: Customer not in dropdown

---

## Test Execution Checklist

- [ ] Login works
- [ ] Dashboard loads with stats
- [ ] Products CRUD works
- [ ] Customers CRUD works
- [ ] Invoices CRUD works
- [ ] Payments can be recorded
- [ ] Inventory shows stock levels
- [ ] Stock adjustment works
- [ ] Reports display correctly
- [ ] Users can be managed
- [ ] Suppliers can be managed
- [ ] Validation works on all forms
- [ ] Error messages are clear
- [ ] Success messages shown
- [ ] Navigation works smoothly
- [ ] Responsive on mobile (optional)

---

## Automation Test Commands

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=ProductTest

# Test with coverage
php artisan test --coverage
```

## Notes
- All monetary values in Indonesian Rupiah (IDR)
- Date format: DD MMM YYYY (e.g., 02 Feb 2026)
- Invoice numbers: INV-YYYY-XXXX format
- Test with realistic data volumes
