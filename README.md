# Form Builder - Frontend UI Developer Assignment

A fully functional drag-and-drop Form Builder UI built with Laravel Blade components. This tool allows users to visually construct HTML forms by dragging input field types from a right-side panel into a canvas area.

## Features

### Core Features
- **Drag-and-Drop Interface**: Drag field types from the palette to the canvas to build forms
- **Field Reordering**: Drag fields within the canvas to reorder them
- **Field Configuration**: Edit field properties via the Field Options panel
- **Live Preview**: See changes reflected immediately on the canvas
- **JSON Export**: Generate and view the form schema as JSON

### Supported Field Types
| Category | Field Types |
|----------|-------------|
| Input Fields | Text Input, Text Area, Number Input, Email Input, Phone Input |
| Selection Fields | Dropdown, Radio Buttons, Checkboxes |
| Special Inputs | Date Picker, File Upload |
| Structural Fields | Title, Description, New Line, Page Break, Hidden Field |
| Location Fields | State, City, State & City Combined |

### Field Actions
- **Edit**: Click the pencil icon to configure field options
- **Duplicate**: Click the copy icon to create a copy of the field
- **Delete**: Click the trash icon to remove the field (with confirmation)
- **Drag Handle**: Use the bars icon to drag and reorder fields

### Field Options (configurable per field type)
- Label
- Placeholder
- Min/Max Characters
- Options List (for dropdown, radio, checkboxes)
- Required toggle
- CSS Class
- Default Value

### Bonus Features Implemented
- **LocalStorage Persistence**: Form state survives page refresh
- **Undo/Redo**: Use Ctrl+Z / Ctrl+Y (or Cmd+Z / Cmd+Y on Mac) to undo/redo actions
- **Delete Confirmation**: Toast notification before removing a field
- **Drag-over Visual Feedback**: Canvas highlights with blue border on active drag-over
- **JSON Modal**: Beautiful modal to display and copy the generated JSON schema

## Setup Instructions

### Prerequisites
- PHP >= 8.0
- Composer
- Laravel requirements (BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML)

### Installation

1. Clone the repository:
```bash
git clone https://github.com/akshaypratap1/form-builder-assignment.git
cd form-builder-assignment
```

2. Install PHP dependencies:
```bash
composer install
```

3. Copy the environment file (if not exists):
```bash
cp .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Start the development server:
```bash
php artisan serve
```

6. Open your browser and navigate to:
```
http://localhost:8000
```

## Drag-and-Drop Library Choice

### Choice: Native HTML5 Drag and Drop API

### Rationale:
1. **No External Dependencies**: Using native browser APIs means zero additional JavaScript libraries, resulting in faster load times and smaller bundle size.

2. **Assignment Requirements**: The assignment emphasizes using Laravel Blade components and avoiding separate frontend frameworks. Native drag-and-drop aligns perfectly with this philosophy.

3. **Browser Support**: HTML5 Drag and Drop is widely supported across all modern browsers (Chrome, Firefox, Safari, Edge).

4. **Simplicity**: For this use case (dragging tiles to a canvas and reordering elements), native drag-and-drop provides all the necessary functionality without the overhead of a library.

5. **Customizability**: Native implementation gives full control over the drag-and-drop behavior without being constrained by library abstractions.

### Alternative Considered:
- **SortableJS**: While SortableJS provides additional features like animation and touch support, the added complexity wasn't justified for this assignment's scope.

## Assumptions Made

1. **Form Submission URL**: A placeholder URL (`/api/forms/submit`) is displayed as the form submission endpoint. In a real application, this would be configurable.

2. **Field IDs**: Unique field IDs are generated using an incrementing counter. In production, UUIDs would be more appropriate.

3. **Settings Tab**: Per assignment requirements, the Settings tab displays a placeholder message as only the Form Editor tab needs to be functional.

4. **Validation**: Basic client-side validation settings (required, min/max chars) are configurable but not enforced in the preview. These would be used when the form is rendered for end-users.

5. **Location Fields**: State, City, and State & City Combined fields display as text inputs in the builder. In production, they would integrate with a location API for actual state/city selection.

6. **File Upload**: The File Upload field shows a native file input in preview. In production, it would integrate with the backend for actual file handling.

7. **Hidden Fields**: Hidden fields are visible in the builder for configuration but would be invisible to end-users when the form is rendered.

## Sample JSON Output

When you click the "Next" button, the form builder generates a JSON schema. Here's a sample output:

```json
{
  "formTitle": "Contact Us Form",
  "submissionUrl": "/api/forms/submit",
  "fields": [
    {
      "id": "field_1",
      "type": "title",
      "label": "Title",
      "required": false,
      "text": "Contact Information"
    },
    {
      "id": "field_2",
      "type": "text",
      "label": "Full Name",
      "required": true,
      "placeholder": "Enter your full name",
      "maxChars": 100
    },
    {
      "id": "field_3",
      "type": "email",
      "label": "Email Address",
      "required": true,
      "placeholder": "example@email.com"
    },
    {
      "id": "field_4",
      "type": "phone",
      "label": "Phone Number",
      "required": false,
      "placeholder": "+1 (555) 000-0000"
    },
    {
      "id": "field_5",
      "type": "dropdown",
      "label": "Subject",
      "required": true,
      "options": [
        "General Inquiry",
        "Technical Support",
        "Sales",
        "Other"
      ]
    },
    {
      "id": "field_6",
      "type": "textarea",
      "label": "Message",
      "required": true,
      "placeholder": "Type your message here...",
      "minChars": 10,
      "maxChars": 1000
    },
    {
      "id": "field_7",
      "type": "checkbox",
      "label": "Preferred Contact Method",
      "required": false,
      "options": [
        "Email",
        "Phone",
        "Text Message"
      ]
    },
    {
      "id": "field_8",
      "type": "radio",
      "label": "Priority",
      "required": true,
      "options": [
        "Low",
        "Medium",
        "High"
      ]
    },
    {
      "id": "field_9",
      "type": "file",
      "label": "Attachment",
      "required": false
    }
  ]
}
```

## Project Structure

```
├── app/
│   └── Http/Controllers/
│       └── GuestController.php      # Main controller
├── public/
│   └── css/
│       └── form-builder.css         # Form builder styles
├── resources/
│   └── views/
│       ├── form.blade.php           # Main form builder view
│       ├── layouts/
│       │   └── admin.blade.php      # Layout template
│       └── includes/
│           ├── css.blade.php        # CSS includes
│           ├── js.blade.php         # JS includes
│           └── navigation.blade.php # Navigation component
└── routes/
    └── web.php                      # Route definitions
```

## Technical Implementation

### UI Components
- **Header Bar**: Form title input with 200 character limit and live counter
- **Tab Bar**: Form Editor (functional) and Settings (placeholder) tabs
- **Drop Canvas**: Left panel for dropped fields with visual feedback
- **Field Palette**: Right panel with Add Fields and Field Options sub-tabs
- **Footer Actions**: Cancel and Next buttons

### State Management
- Form state is managed in a JavaScript object
- Changes are persisted to localStorage
- Undo/Redo functionality using state stacks

### Styling
- Custom CSS following modern design principles
- Responsive down to 1024px width
- Bootstrap 4 integration for base styles
- Font Awesome 4.7 for icons

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## License

This project is created as part of a Frontend UI Developer assessment.
