# invoice-manager

Invoice Management API with Laravel

## Models

### Customer

- name
- type `Individual(I) or Business(B)`
- email
- address
- city
- state
- postal code
- country

### Invoice

- customer_id
- amount
- status `void(V), billed(B) or paid(P)`
- billed_date
- paid_date

## Routes

```http
GET     /api/v1/customers       Get customers
GET     /api/v1/customers/:id   Get customer
GET     /api/v1/invoices        Get invoices
GET     /api/v1/invoices/:id    Get invoice
POST    /api/v1/customers       Create customer
POST    /api/v1/invoices        Create invoice
PATCH   /api/v1/customers/:id   Update customer
PUT     /api/v1/customers/:id   Update customer's data
PATCH   /api/v1/invoices/:id    Update invoice
PUT     /api/v1/invoices/:id    Update invoice's data
DELETE  /api/v1/customers/:id   Delete customer
DELETE  /api/v1/invoices/:id   Delete invoice
GET     /api/keys               Get Auth tokens
```

## Features

- [x] Filter response with query string

- [x] Include related data in response(with query string)

- [x] Bulk create customers

- [x] Bulk create invoices

- [x] Authorize operations with tokens
