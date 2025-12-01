# Document Request Feature Implementation

This document outlines the document request feature that has been implemented for the Barangay Document Requests application.

## Overview

The document request feature allows authenticated users to submit requests for various barangay documents and track the status of those requests.

## Database Schema

### `document_requests` Table

The following columns are included:

| Column | Type | Description |
|--------|------|-------------|
| id | ID | Primary key |
| user_id | Foreign Key | References the authenticated user |
| transaction_id | String (Unique) | Unique transaction identifier (e.g., TXN-ABC123DEF) |
| last_name | String | Last name of the requester |
| first_name | String | First name of the requester |
| document_type | String | Type of document requested |
| date_requested | Timestamp | When the request was submitted |
| status | Enum | Current status (pending, approved, rejected, completed) |
| created_at | Timestamp | Record creation timestamp |
| updated_at | Timestamp | Record update timestamp |

**Migration File:** `database/migrations/2025_12_01_000000_create_document_requests_table.php`

## Models

### DocumentRequest Model
- **Location:** `app/Models/DocumentRequest.php`
- **Relationships:** Belongs to User
- **Fillable Fields:** user_id, transaction_id, last_name, first_name, document_type, date_requested, status

### User Model (Updated)
- **Location:** `app/Models/User.php`
- **New Relationship:** Has many DocumentRequests

## Controllers

### DocumentRequestController
- **Location:** `app/Http/Controllers/DocumentRequestController.php`
- **Methods:**
  - `index()` - Display all document requests for authenticated user with pagination
  - `create()` - Show form to create new request
  - `store()` - Save new document request to database
  - `show()` - Display details of a specific request

## Routes

All document request routes are protected by authentication middleware:

```php
Route::middleware(['auth'])->group(function () {
    Route::resource('document-requests', DocumentRequestController::class);
});
```

**Available Routes:**
- `GET /document-requests` - List all user's document requests
- `GET /document-requests/create` - Show creation form
- `POST /document-requests` - Store new request
- `GET /document-requests/{document-request}` - Show request details

## Views

### 1. `resources/views/document-requests/index.blade.php`
Main table displaying all document requests with columns:
- Transaction ID
- Last Name
- First Name
- Document Type
- Date Requested
- Status (with color-coded badges)
- Action (View link)

Features:
- Pagination (10 items per page)
- "New Request" button
- Empty state when no requests exist
- Status color coding (Yellow=pending, Blue=approved, Green=completed, Red=rejected)

### 2. `resources/views/document-requests/create.blade.php`
Form to create a new document request with fields:
- Last Name (required)
- First Name (required)
- Document Type (dropdown with preset options)

Pre-filled document types:
- Birth Certificate
- Marriage Certificate
- Death Certificate
- Barangay Clearance
- Certificate of Residency

### 3. `resources/views/document-requests/show.blade.php`
Detailed view of a specific request displaying:
- Transaction ID
- Status
- Last Name
- First Name
- Document Type
- Date Requested (formatted with time)

### 4. `resources/views/layouts/app.blade.php`
Master layout template with:
- Navigation bar
- User authentication display
- Success message alerts
- Tailwind CSS styling

## Key Features

1. **User Authentication:** All document request features require authentication
2. **Transaction IDs:** Auto-generated unique transaction IDs for tracking
3. **Status Tracking:** Requests can have status: pending, approved, rejected, or completed
4. **Pagination:** Large lists are paginated (10 items per page)
5. **Responsive Design:** Uses Tailwind CSS for responsive UI
6. **User Isolation:** Users only see their own document requests

## Usage

### Setup

1. Run migrations to create the `document_requests` table:
```bash
php artisan migrate
```

2. Update authentication routes if needed (ensure Laravel authentication is configured)

### Creating a Request

1. Navigate to `/document-requests` (authenticated users only)
2. Click "New Request" button
3. Fill in Last Name, First Name, and select Document Type
4. Click "Submit Request"
5. You'll be redirected to the list view with a success message

### Viewing Requests

1. Go to `/document-requests` to see all your requests
2. Click "View" to see detailed information about a specific request
3. Requests are sorted by most recent first

## Validation

- **Last Name:** Required, string, max 255 characters
- **First Name:** Required, string, max 255 characters
- **Document Type:** Required, string, max 255 characters

## Future Enhancements

Potential features to add:
- Admin panel to manage request statuses
- Email notifications when status changes
- Document upload for supporting files
- Request cancellation/withdrawal
- Advanced filtering and search
- Export requests to CSV/PDF
- Payment integration for paid documents
- QR code generation for transaction tracking
