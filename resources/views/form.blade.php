@extends('layouts.admin')
@section('content')
<div class="form-builder-container">
    <!-- Header -->
    <div class="form-builder-header">
        <div class="form-title-input-wrapper">
            <input type="text"
                   id="formTitle"
                   class="form-title-input"
                   placeholder="Enter form title..."
                   maxlength="200"
                   value="Untitled Form">
            <span class="char-counter" id="charCounter">14/200</span>
        </div>
        <div class="form-url-label">
            <i class="fa fa-link"></i>
            <span>Form submission URL: <strong id="formUrl">/api/forms/submit</strong></span>
        </div>
    </div>

    <!-- Tab Bar -->
    <div class="tab-bar">
        <button class="tab-item active" data-tab="editor">Form Editor</button>
        <button class="tab-item" data-tab="settings">Settings</button>
    </div>

    <!-- Main Content -->
    <div id="editorContent" class="tab-content">
        <div class="form-builder-main">
            <!-- Drop Canvas (Left Panel) -->
            <div class="drop-canvas">
                <div class="drop-zone" id="dropZone">
                    <div class="drop-zone-empty" id="dropZoneEmpty">
                        <i class="fa fa-hand-pointer-o"></i>
                        <p>Drag elements from the right panel to build your form &rarr;</p>
                    </div>
                    <div id="fieldsContainer"></div>
                </div>
            </div>

            <!-- Field Palette (Right Panel) -->
            <div class="field-palette">
                <div class="palette-tabs">
                    <button class="palette-tab active" data-palette="addFields">Add Fields</button>
                    <button class="palette-tab" data-palette="fieldOptions">Field Options</button>
                </div>

                <!-- Add Fields Tab -->
                <div class="palette-content" id="addFieldsPanel">
                    <div class="field-tiles">
                        <!-- Input Fields -->
                        <div class="field-tile" draggable="true" data-type="text">
                            <i class="fa fa-font"></i>
                            <span>Text Input</span>
                        </div>
                        <div class="field-tile" draggable="true" data-type="textarea">
                            <i class="fa fa-align-left"></i>
                            <span>Text Area</span>
                        </div>
                        <div class="field-tile" draggable="true" data-type="number">
                            <i class="fa fa-hashtag"></i>
                            <span>Number Input</span>
                        </div>
                        <div class="field-tile" draggable="true" data-type="email">
                            <i class="fa fa-envelope-o"></i>
                            <span>Email Input</span>
                        </div>
                        <div class="field-tile" draggable="true" data-type="phone">
                            <i class="fa fa-phone"></i>
                            <span>Phone Input</span>
                        </div>
                        <div class="field-tile" draggable="true" data-type="dropdown">
                            <i class="fa fa-caret-square-o-down"></i>
                            <span>Dropdown</span>
                        </div>
                        <div class="field-tile" draggable="true" data-type="radio">
                            <i class="fa fa-dot-circle-o"></i>
                            <span>Radio Buttons</span>
                        </div>
                        <div class="field-tile" draggable="true" data-type="checkbox">
                            <i class="fa fa-check-square-o"></i>
                            <span>Checkboxes</span>
                        </div>
                        <div class="field-tile" draggable="true" data-type="date">
                            <i class="fa fa-calendar"></i>
                            <span>Date Picker</span>
                        </div>
                        <div class="field-tile" draggable="true" data-type="file">
                            <i class="fa fa-upload"></i>
                            <span>File Upload</span>
                        </div>

                        <!-- Structural Fields -->
                        <div class="field-tile" draggable="true" data-type="title">
                            <i class="fa fa-header"></i>
                            <span>Title</span>
                        </div>
                        <div class="field-tile" draggable="true" data-type="description">
                            <i class="fa fa-paragraph"></i>
                            <span>Description</span>
                        </div>
                        <div class="field-tile" draggable="true" data-type="newline">
                            <i class="fa fa-arrows-v"></i>
                            <span>New Line</span>
                        </div>
                        <div class="field-tile" draggable="true" data-type="pagebreak">
                            <i class="fa fa-file-o"></i>
                            <span>Page Break</span>
                        </div>
                        <div class="field-tile" draggable="true" data-type="hidden">
                            <i class="fa fa-eye-slash"></i>
                            <span>Hidden Field</span>
                        </div>

                        <!-- Location Fields -->
                        <div class="field-tile" draggable="true" data-type="state">
                            <i class="fa fa-map"></i>
                            <span>State</span>
                        </div>
                        <div class="field-tile" draggable="true" data-type="city">
                            <i class="fa fa-building"></i>
                            <span>City</span>
                        </div>
                        <div class="field-tile" draggable="true" data-type="statecity">
                            <i class="fa fa-map-marker"></i>
                            <span>State & City</span>
                        </div>
                    </div>
                </div>

                <!-- Field Options Tab -->
                <div class="palette-content" id="fieldOptionsPanel" style="display: none;">
                    <div class="no-field-selected" id="noFieldSelected">
                        <i class="fa fa-hand-pointer-o"></i>
                        <p>Click the edit icon on a field to configure its options</p>
                    </div>
                    <div class="field-options-panel" id="fieldOptionsForm" style="display: none;">
                        <div class="field-options-header">
                            <i class="fa fa-cog"></i>
                            <h4 id="editingFieldType">Field Options</h4>
                        </div>
                        <div class="field-options-form">
                            <!-- Label -->
                            <div class="option-group">
                                <label class="option-label">Label</label>
                                <input type="text" class="option-input" id="optionLabel" placeholder="Enter field label">
                            </div>

                            <!-- Placeholder (for input fields) -->
                            <div class="option-group" id="optionPlaceholderGroup">
                                <label class="option-label">Placeholder</label>
                                <input type="text" class="option-input" id="optionPlaceholder" placeholder="Enter placeholder text">
                            </div>

                            <!-- Min/Max Characters (for text fields) -->
                            <div class="option-row" id="optionMinMaxGroup">
                                <div class="option-group">
                                    <label class="option-label">Min Characters</label>
                                    <input type="number" class="option-input" id="optionMinChars" min="0" placeholder="0">
                                </div>
                                <div class="option-group">
                                    <label class="option-label">Max Characters</label>
                                    <input type="number" class="option-input" id="optionMaxChars" min="0" placeholder="No limit">
                                </div>
                            </div>

                            <!-- Default Value -->
                            <div class="option-group" id="optionDefaultGroup">
                                <label class="option-label">Default Value</label>
                                <input type="text" class="option-input" id="optionDefault" placeholder="Enter default value">
                            </div>

                            <!-- Options List (for dropdown, radio, checkbox) -->
                            <div class="option-group" id="optionOptionsGroup">
                                <label class="option-label">Options</label>
                                <div class="options-list-editor" id="optionsListEditor">
                                    <!-- Options will be dynamically added here -->
                                </div>
                                <button type="button" class="add-option-btn" id="addOptionBtn">
                                    <i class="fa fa-plus"></i> Add Option
                                </button>
                            </div>

                            <!-- CSS Class -->
                            <div class="option-group">
                                <label class="option-label">CSS Class</label>
                                <input type="text" class="option-input" id="optionCssClass" placeholder="e.g., custom-class">
                            </div>

                            <!-- Required Toggle -->
                            <div class="option-group">
                                <div class="toggle-wrapper">
                                    <label class="option-label">Required</label>
                                    <label class="toggle-switch">
                                        <input type="checkbox" id="optionRequired">
                                        <span class="toggle-slider"></span>
                                    </label>
                                </div>
                            </div>

                            <!-- Title Text (for title field) -->
                            <div class="option-group" id="optionTitleTextGroup" style="display: none;">
                                <label class="option-label">Title Text</label>
                                <input type="text" class="option-input" id="optionTitleText" placeholder="Enter title">
                            </div>

                            <!-- Description Text (for description field) -->
                            <div class="option-group" id="optionDescTextGroup" style="display: none;">
                                <label class="option-label">Description Text</label>
                                <textarea class="option-input" id="optionDescText" rows="3" placeholder="Enter description"></textarea>
                            </div>

                            <!-- Remove Element -->
                            <button type="button" class="remove-element-btn" id="removeElementBtn">
                                <i class="fa fa-trash"></i> Remove Element
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Tab Content (Placeholder) -->
    <div id="settingsContent" class="tab-content" style="display: none;">
        <div class="settings-placeholder">
            <i class="fa fa-cogs"></i>
            <h3>Form Settings</h3>
            <p>Form settings functionality is not required for this assignment.</p>
        </div>
    </div>

    <!-- Footer -->
    <div class="form-builder-footer">
        <button class="btn-cancel" id="cancelBtn">Cancel</button>
        <button class="btn-next" id="nextBtn">
            Next <i class="fa fa-arrow-right"></i>
        </button>
    </div>
</div>

<!-- Delete Confirmation Toast (hidden by default) -->
<div class="delete-confirm-toast" id="deleteConfirmToast" style="display: none;">
    <span>Delete this field?</span>
    <button class="btn-confirm-delete" id="confirmDeleteBtn">Delete</button>
    <button class="btn-cancel-delete" id="cancelDeleteBtn">Cancel</button>
</div>

<!-- JSON Preview Modal -->
<div class="json-modal-overlay" id="jsonModal" style="display: none;">
    <div class="json-modal">
        <div class="json-modal-header">
            <h3>Form JSON Schema</h3>
            <button class="json-modal-close" id="closeJsonModal">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <div class="json-modal-body">
            <pre id="jsonOutput"></pre>
        </div>
        <div class="json-modal-footer">
            <button class="btn-copy" id="copyJsonBtn">
                <i class="fa fa-copy"></i> Copy to Clipboard
            </button>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/form-builder.css') }}">

<script>
document.addEventListener('DOMContentLoaded', function() {
    // State Management
    let formState = {
        title: 'Untitled Form',
        submissionUrl: '/api/forms/submit',
        fields: []
    };

    let selectedFieldId = null;
    let fieldIdCounter = 0;
    let deleteFieldId = null;
    let undoStack = [];
    let redoStack = [];

    // Field Type Configurations
    const fieldTypes = {
        text: { name: 'Text Input', icon: 'fa-font', hasPlaceholder: true, hasMinMax: true, hasDefault: true },
        textarea: { name: 'Text Area', icon: 'fa-align-left', hasPlaceholder: true, hasMinMax: true, hasDefault: false },
        number: { name: 'Number Input', icon: 'fa-hashtag', hasPlaceholder: true, hasMinMax: false, hasDefault: true },
        email: { name: 'Email Input', icon: 'fa-envelope-o', hasPlaceholder: true, hasMinMax: false, hasDefault: true },
        phone: { name: 'Phone Input', icon: 'fa-phone', hasPlaceholder: true, hasMinMax: false, hasDefault: false },
        dropdown: { name: 'Dropdown', icon: 'fa-caret-square-o-down', hasOptions: true },
        radio: { name: 'Radio Buttons', icon: 'fa-dot-circle-o', hasOptions: true },
        checkbox: { name: 'Checkboxes', icon: 'fa-check-square-o', hasOptions: true },
        date: { name: 'Date Picker', icon: 'fa-calendar', hasDefault: false },
        file: { name: 'File Upload', icon: 'fa-upload' },
        title: { name: 'Title', icon: 'fa-header', isStructural: true, hasTitleText: true },
        description: { name: 'Description', icon: 'fa-paragraph', isStructural: true, hasDescText: true },
        newline: { name: 'New Line', icon: 'fa-arrows-v', isStructural: true },
        pagebreak: { name: 'Page Break', icon: 'fa-file-o', isStructural: true },
        hidden: { name: 'Hidden Field', icon: 'fa-eye-slash', hasDefault: true },
        state: { name: 'State', icon: 'fa-map', hasPlaceholder: true },
        city: { name: 'City', icon: 'fa-building', hasPlaceholder: true },
        statecity: { name: 'State & City', icon: 'fa-map-marker', hasPlaceholder: true }
    };

    // DOM Elements
    const formTitleInput = document.getElementById('formTitle');
    const charCounter = document.getElementById('charCounter');
    const dropZone = document.getElementById('dropZone');
    const dropZoneEmpty = document.getElementById('dropZoneEmpty');
    const fieldsContainer = document.getElementById('fieldsContainer');
    const fieldTiles = document.querySelectorAll('.field-tile');
    const tabItems = document.querySelectorAll('.tab-item');
    const paletteTabs = document.querySelectorAll('.palette-tab');
    const addFieldsPanel = document.getElementById('addFieldsPanel');
    const fieldOptionsPanel = document.getElementById('fieldOptionsPanel');
    const noFieldSelected = document.getElementById('noFieldSelected');
    const fieldOptionsForm = document.getElementById('fieldOptionsForm');
    const jsonModal = document.getElementById('jsonModal');
    const deleteConfirmToast = document.getElementById('deleteConfirmToast');

    // Initialize
    init();

    function init() {
        loadFromLocalStorage();
        setupEventListeners();
        updateCharCounter();
        renderFields();
    }

    function setupEventListeners() {
        // Form Title
        formTitleInput.addEventListener('input', handleTitleInput);

        // Main Tabs
        tabItems.forEach(tab => {
            tab.addEventListener('click', () => switchMainTab(tab.dataset.tab));
        });

        // Palette Tabs
        paletteTabs.forEach(tab => {
            tab.addEventListener('click', () => switchPaletteTab(tab.dataset.palette));
        });

        // Field Tiles Drag
        fieldTiles.forEach(tile => {
            tile.addEventListener('dragstart', handleTileDragStart);
            tile.addEventListener('dragend', handleTileDragEnd);
        });

        // Drop Zone
        dropZone.addEventListener('dragover', handleDragOver);
        dropZone.addEventListener('dragleave', handleDragLeave);
        dropZone.addEventListener('drop', handleDrop);

        // Option inputs
        document.getElementById('optionLabel').addEventListener('input', updateSelectedField);
        document.getElementById('optionPlaceholder').addEventListener('input', updateSelectedField);
        document.getElementById('optionMinChars').addEventListener('input', updateSelectedField);
        document.getElementById('optionMaxChars').addEventListener('input', updateSelectedField);
        document.getElementById('optionDefault').addEventListener('input', updateSelectedField);
        document.getElementById('optionCssClass').addEventListener('input', updateSelectedField);
        document.getElementById('optionRequired').addEventListener('change', updateSelectedField);
        document.getElementById('optionTitleText').addEventListener('input', updateSelectedField);
        document.getElementById('optionDescText').addEventListener('input', updateSelectedField);

        // Add Option Button
        document.getElementById('addOptionBtn').addEventListener('click', addOption);

        // Remove Element Button
        document.getElementById('removeElementBtn').addEventListener('click', () => {
            if (selectedFieldId) {
                showDeleteConfirm(selectedFieldId);
            }
        });

        // Delete Confirmation
        document.getElementById('confirmDeleteBtn').addEventListener('click', confirmDelete);
        document.getElementById('cancelDeleteBtn').addEventListener('click', cancelDelete);

        // Footer Buttons
        document.getElementById('cancelBtn').addEventListener('click', handleCancel);
        document.getElementById('nextBtn').addEventListener('click', handleNext);

        // JSON Modal
        document.getElementById('closeJsonModal').addEventListener('click', closeJsonModal);
        document.getElementById('copyJsonBtn').addEventListener('click', copyJsonToClipboard);
        jsonModal.addEventListener('click', (e) => {
            if (e.target === jsonModal) closeJsonModal();
        });

        // Keyboard shortcuts for undo/redo
        document.addEventListener('keydown', handleKeyDown);
    }

    // Title Input Handler
    function handleTitleInput() {
        formState.title = formTitleInput.value;
        updateCharCounter();
        saveToLocalStorage();
    }

    function updateCharCounter() {
        const length = formTitleInput.value.length;
        charCounter.textContent = `${length}/200`;
        charCounter.classList.remove('warning', 'danger');
        if (length > 180) charCounter.classList.add('danger');
        else if (length > 150) charCounter.classList.add('warning');
    }

    // Tab Switching
    function switchMainTab(tab) {
        tabItems.forEach(t => t.classList.remove('active'));
        document.querySelector(`[data-tab="${tab}"]`).classList.add('active');

        document.getElementById('editorContent').style.display = tab === 'editor' ? 'block' : 'none';
        document.getElementById('settingsContent').style.display = tab === 'settings' ? 'block' : 'none';
    }

    function switchPaletteTab(tab) {
        paletteTabs.forEach(t => t.classList.remove('active'));
        document.querySelector(`[data-palette="${tab}"]`).classList.add('active');

        addFieldsPanel.style.display = tab === 'addFields' ? 'block' : 'none';
        fieldOptionsPanel.style.display = tab === 'fieldOptions' ? 'block' : 'none';
    }

    // Drag and Drop from Palette
    let draggedType = null;

    function handleTileDragStart(e) {
        draggedType = e.target.dataset.type;
        e.target.classList.add('dragging');
        e.dataTransfer.effectAllowed = 'copy';
        e.dataTransfer.setData('text/plain', draggedType);
    }

    function handleTileDragEnd(e) {
        e.target.classList.remove('dragging');
        draggedType = null;
    }

    function handleDragOver(e) {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'copy';
        dropZone.classList.add('drag-over');
    }

    function handleDragLeave(e) {
        if (!dropZone.contains(e.relatedTarget)) {
            dropZone.classList.remove('drag-over');
        }
    }

    function handleDrop(e) {
        e.preventDefault();
        dropZone.classList.remove('drag-over');

        const type = e.dataTransfer.getData('text/plain');
        if (type && fieldTypes[type]) {
            saveStateForUndo();
            addField(type);
        }
    }

    // Field Management
    function addField(type, afterId = null, config = null) {
        const field = {
            id: 'field_' + (++fieldIdCounter),
            type: type,
            label: config?.label || fieldTypes[type].name,
            placeholder: config?.placeholder || '',
            minChars: config?.minChars || null,
            maxChars: config?.maxChars || null,
            defaultValue: config?.defaultValue || '',
            cssClass: config?.cssClass || '',
            required: config?.required || false,
            options: config?.options || (fieldTypes[type].hasOptions ? ['Option 1', 'Option 2', 'Option 3'] : []),
            titleText: config?.titleText || 'Section Title',
            descText: config?.descText || 'Enter description here...'
        };

        if (afterId) {
            const index = formState.fields.findIndex(f => f.id === afterId);
            formState.fields.splice(index + 1, 0, field);
        } else {
            formState.fields.push(field);
        }

        renderFields();
        saveToLocalStorage();
        return field.id;
    }

    function removeField(id) {
        formState.fields = formState.fields.filter(f => f.id !== id);
        if (selectedFieldId === id) {
            selectedFieldId = null;
            showFieldOptions(null);
        }
        renderFields();
        saveToLocalStorage();
    }

    function duplicateField(id) {
        saveStateForUndo();
        const field = formState.fields.find(f => f.id === id);
        if (field) {
            addField(field.type, id, {
                label: field.label + ' (Copy)',
                placeholder: field.placeholder,
                minChars: field.minChars,
                maxChars: field.maxChars,
                defaultValue: field.defaultValue,
                cssClass: field.cssClass,
                required: field.required,
                options: [...field.options],
                titleText: field.titleText,
                descText: field.descText
            });
        }
    }

    function selectField(id) {
        selectedFieldId = id;
        document.querySelectorAll('.placed-field').forEach(f => f.classList.remove('selected'));
        const fieldEl = document.querySelector(`[data-field-id="${id}"]`);
        if (fieldEl) fieldEl.classList.add('selected');
        showFieldOptions(id);
        switchPaletteTab('fieldOptions');
    }

    // Render Fields
    function renderFields() {
        if (formState.fields.length === 0) {
            dropZoneEmpty.style.display = 'flex';
            dropZone.classList.remove('has-fields');
            fieldsContainer.innerHTML = '';
        } else {
            dropZoneEmpty.style.display = 'none';
            dropZone.classList.add('has-fields');
            fieldsContainer.innerHTML = formState.fields.map(field => renderFieldCard(field)).join('');
            setupFieldEventListeners();
        }
    }

    function renderFieldCard(field) {
        const typeConfig = fieldTypes[field.type];
        return `
            <div class="placed-field ${selectedFieldId === field.id ? 'selected' : ''}"
                 data-field-id="${field.id}"
                 draggable="true">
                <div class="placed-field-header">
                    <div class="drag-handle">
                        <i class="fa fa-bars"></i>
                    </div>
                    <div class="field-type-badge">
                        <i class="fa ${typeConfig.icon}"></i>
                        ${typeConfig.name}
                    </div>
                    <div class="field-actions">
                        <button class="field-action-btn edit-btn" title="Edit">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <button class="field-action-btn duplicate-btn" title="Duplicate">
                            <i class="fa fa-copy"></i>
                        </button>
                        <button class="field-action-btn delete delete-btn" title="Delete">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="placed-field-content">
                    ${renderFieldPreview(field)}
                </div>
            </div>
        `;
    }

    function renderFieldPreview(field) {
        const typeConfig = fieldTypes[field.type];

        // Structural fields
        if (field.type === 'title') {
            return `<div class="title-field-preview"><h3>${field.titleText}</h3></div>`;
        }
        if (field.type === 'description') {
            return `<div class="description-field-preview"><p>${field.descText}</p></div>`;
        }
        if (field.type === 'newline') {
            return `<div class="newline-field-preview"></div>`;
        }
        if (field.type === 'pagebreak') {
            return `<div class="pagebreak-field-preview"><hr><span>Page Break</span><hr></div>`;
        }
        if (field.type === 'hidden') {
            return `<div class="hidden-field-preview"><i class="fa fa-eye-slash"></i> Hidden field: ${field.defaultValue || '(no value)'}</div>`;
        }

        let html = `<div class="placed-field-label">${field.label}${field.required ? '<span class="required-indicator">*</span>' : ''}</div>`;
        html += '<div class="placed-field-preview">';

        switch (field.type) {
            case 'text':
            case 'email':
            case 'phone':
            case 'state':
            case 'city':
                html += `<input type="text" placeholder="${field.placeholder || 'Enter ' + field.label.toLowerCase()}" value="${field.defaultValue}">`;
                break;
            case 'number':
                html += `<input type="number" placeholder="${field.placeholder || '0'}" value="${field.defaultValue}">`;
                break;
            case 'textarea':
                html += `<textarea placeholder="${field.placeholder || 'Enter text...'}">${field.defaultValue}</textarea>`;
                break;
            case 'dropdown':
                html += `<select><option>${field.options[0] || 'Select option'}</option></select>`;
                break;
            case 'radio':
                html += '<div class="options-preview">';
                field.options.forEach(opt => {
                    html += `<div class="option-item"><input type="radio" disabled> ${opt}</div>`;
                });
                html += '</div>';
                break;
            case 'checkbox':
                html += '<div class="options-preview">';
                field.options.forEach(opt => {
                    html += `<div class="option-item"><input type="checkbox" disabled> ${opt}</div>`;
                });
                html += '</div>';
                break;
            case 'date':
                html += `<input type="date">`;
                break;
            case 'file':
                html += `<input type="file">`;
                break;
            case 'statecity':
                html += `<div style="display: flex; gap: 12px;">
                    <input type="text" placeholder="Select State" style="flex: 1;">
                    <input type="text" placeholder="Select City" style="flex: 1;">
                </div>`;
                break;
        }

        html += '</div>';
        return html;
    }

    function setupFieldEventListeners() {
        // Edit buttons
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const fieldId = e.target.closest('.placed-field').dataset.fieldId;
                selectField(fieldId);
            });
        });

        // Duplicate buttons
        document.querySelectorAll('.duplicate-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const fieldId = e.target.closest('.placed-field').dataset.fieldId;
                duplicateField(fieldId);
            });
        });

        // Delete buttons
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const fieldId = e.target.closest('.placed-field').dataset.fieldId;
                showDeleteConfirm(fieldId);
            });
        });

        // Field card click to select
        document.querySelectorAll('.placed-field').forEach(field => {
            field.addEventListener('click', () => selectField(field.dataset.fieldId));
        });

        // Drag and drop for reordering
        setupFieldDragAndDrop();
    }

    // Field Drag and Drop for Reordering
    let draggedFieldId = null;

    function setupFieldDragAndDrop() {
        document.querySelectorAll('.placed-field').forEach(field => {
            field.addEventListener('dragstart', handleFieldDragStart);
            field.addEventListener('dragend', handleFieldDragEnd);
            field.addEventListener('dragover', handleFieldDragOver);
            field.addEventListener('drop', handleFieldDrop);
        });
    }

    function handleFieldDragStart(e) {
        draggedFieldId = e.target.dataset.fieldId;
        e.target.classList.add('dragging');
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/plain', draggedFieldId);
    }

    function handleFieldDragEnd(e) {
        e.target.classList.remove('dragging');
        draggedFieldId = null;
    }

    function handleFieldDragOver(e) {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
    }

    function handleFieldDrop(e) {
        e.preventDefault();
        const targetFieldId = e.target.closest('.placed-field')?.dataset.fieldId;

        if (draggedFieldId && targetFieldId && draggedFieldId !== targetFieldId) {
            saveStateForUndo();
            const draggedIndex = formState.fields.findIndex(f => f.id === draggedFieldId);
            const targetIndex = formState.fields.findIndex(f => f.id === targetFieldId);

            const [draggedField] = formState.fields.splice(draggedIndex, 1);
            formState.fields.splice(targetIndex, 0, draggedField);

            renderFields();
            saveToLocalStorage();
        }
    }

    // Field Options Panel
    function showFieldOptions(fieldId) {
        if (!fieldId) {
            noFieldSelected.style.display = 'flex';
            fieldOptionsForm.style.display = 'none';
            return;
        }

        const field = formState.fields.find(f => f.id === fieldId);
        if (!field) return;

        const typeConfig = fieldTypes[field.type];

        noFieldSelected.style.display = 'none';
        fieldOptionsForm.style.display = 'block';

        document.getElementById('editingFieldType').textContent = typeConfig.name + ' Options';

        // Show/hide option groups based on field type
        document.getElementById('optionPlaceholderGroup').style.display = typeConfig.hasPlaceholder ? 'block' : 'none';
        document.getElementById('optionMinMaxGroup').style.display = typeConfig.hasMinMax ? 'flex' : 'none';
        document.getElementById('optionDefaultGroup').style.display = typeConfig.hasDefault ? 'block' : 'none';
        document.getElementById('optionOptionsGroup').style.display = typeConfig.hasOptions ? 'block' : 'none';
        document.getElementById('optionTitleTextGroup').style.display = typeConfig.hasTitleText ? 'block' : 'none';
        document.getElementById('optionDescTextGroup').style.display = typeConfig.hasDescText ? 'block' : 'none';

        // Hide label for structural fields
        document.querySelector('.option-group:first-child').style.display = typeConfig.isStructural ? 'none' : 'block';

        // Populate values
        document.getElementById('optionLabel').value = field.label;
        document.getElementById('optionPlaceholder').value = field.placeholder || '';
        document.getElementById('optionMinChars').value = field.minChars || '';
        document.getElementById('optionMaxChars').value = field.maxChars || '';
        document.getElementById('optionDefault').value = field.defaultValue || '';
        document.getElementById('optionCssClass').value = field.cssClass || '';
        document.getElementById('optionRequired').checked = field.required;
        document.getElementById('optionTitleText').value = field.titleText || '';
        document.getElementById('optionDescText').value = field.descText || '';

        // Render options list
        if (typeConfig.hasOptions) {
            renderOptionsList(field.options);
        }
    }

    function renderOptionsList(options) {
        const container = document.getElementById('optionsListEditor');
        container.innerHTML = options.map((opt, i) => `
            <div class="option-row-item">
                <input type="text" value="${opt}" data-option-index="${i}" class="option-value-input">
                <button type="button" class="remove-option-btn" data-option-index="${i}">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        `).join('');

        // Add event listeners
        container.querySelectorAll('.option-value-input').forEach(input => {
            input.addEventListener('input', updateOptionValue);
        });
        container.querySelectorAll('.remove-option-btn').forEach(btn => {
            btn.addEventListener('click', removeOption);
        });
    }

    function addOption() {
        if (!selectedFieldId) return;
        const field = formState.fields.find(f => f.id === selectedFieldId);
        if (!field) return;

        field.options.push('New Option');
        renderOptionsList(field.options);
        renderFields();
        saveToLocalStorage();
    }

    function removeOption(e) {
        if (!selectedFieldId) return;
        const field = formState.fields.find(f => f.id === selectedFieldId);
        if (!field || field.options.length <= 1) return;

        const index = parseInt(e.target.closest('.remove-option-btn').dataset.optionIndex);
        field.options.splice(index, 1);
        renderOptionsList(field.options);
        renderFields();
        saveToLocalStorage();
    }

    function updateOptionValue(e) {
        if (!selectedFieldId) return;
        const field = formState.fields.find(f => f.id === selectedFieldId);
        if (!field) return;

        const index = parseInt(e.target.dataset.optionIndex);
        field.options[index] = e.target.value;
        renderFields();
        saveToLocalStorage();
    }

    function updateSelectedField() {
        if (!selectedFieldId) return;
        const field = formState.fields.find(f => f.id === selectedFieldId);
        if (!field) return;

        field.label = document.getElementById('optionLabel').value;
        field.placeholder = document.getElementById('optionPlaceholder').value;
        field.minChars = document.getElementById('optionMinChars').value || null;
        field.maxChars = document.getElementById('optionMaxChars').value || null;
        field.defaultValue = document.getElementById('optionDefault').value;
        field.cssClass = document.getElementById('optionCssClass').value;
        field.required = document.getElementById('optionRequired').checked;
        field.titleText = document.getElementById('optionTitleText').value;
        field.descText = document.getElementById('optionDescText').value;

        renderFields();
        saveToLocalStorage();
    }

    // Delete Confirmation
    function showDeleteConfirm(fieldId) {
        deleteFieldId = fieldId;
        deleteConfirmToast.style.display = 'flex';
    }

    function confirmDelete() {
        if (deleteFieldId) {
            saveStateForUndo();
            removeField(deleteFieldId);
            deleteFieldId = null;
        }
        deleteConfirmToast.style.display = 'none';
    }

    function cancelDelete() {
        deleteFieldId = null;
        deleteConfirmToast.style.display = 'none';
    }

    // Cancel and Next buttons
    function handleCancel() {
        if (confirm('Are you sure you want to cancel? All changes will be lost.')) {
            formState = { title: 'Untitled Form', submissionUrl: '/api/forms/submit', fields: [] };
            formTitleInput.value = formState.title;
            selectedFieldId = null;
            renderFields();
            showFieldOptions(null);
            localStorage.removeItem('formBuilderState');
        }
    }

    function handleNext() {
        const schema = generateJsonSchema();
        document.getElementById('jsonOutput').textContent = JSON.stringify(schema, null, 2);
        jsonModal.style.display = 'flex';
        console.log('Form JSON Schema:', schema);
    }

    function generateJsonSchema() {
        return {
            formTitle: formState.title,
            submissionUrl: formState.submissionUrl,
            fields: formState.fields.map(field => {
                const schema = {
                    id: field.id,
                    type: field.type,
                    label: field.label,
                    required: field.required
                };

                if (field.placeholder) schema.placeholder = field.placeholder;
                if (field.minChars) schema.minChars = parseInt(field.minChars);
                if (field.maxChars) schema.maxChars = parseInt(field.maxChars);
                if (field.defaultValue) schema.defaultValue = field.defaultValue;
                if (field.cssClass) schema.cssClass = field.cssClass;
                if (field.options && field.options.length > 0) schema.options = field.options;
                if (field.type === 'title') schema.text = field.titleText;
                if (field.type === 'description') schema.text = field.descText;

                return schema;
            })
        };
    }

    function closeJsonModal() {
        jsonModal.style.display = 'none';
    }

    function copyJsonToClipboard() {
        const jsonText = document.getElementById('jsonOutput').textContent;
        navigator.clipboard.writeText(jsonText).then(() => {
            const btn = document.getElementById('copyJsonBtn');
            btn.classList.add('copied');
            btn.innerHTML = '<i class="fa fa-check"></i> Copied!';
            setTimeout(() => {
                btn.classList.remove('copied');
                btn.innerHTML = '<i class="fa fa-copy"></i> Copy to Clipboard';
            }, 2000);
        });
    }

    // LocalStorage Persistence
    function saveToLocalStorage() {
        localStorage.setItem('formBuilderState', JSON.stringify({
            ...formState,
            fieldIdCounter
        }));
    }

    function loadFromLocalStorage() {
        const saved = localStorage.getItem('formBuilderState');
        if (saved) {
            try {
                const data = JSON.parse(saved);
                formState = {
                    title: data.title || 'Untitled Form',
                    submissionUrl: data.submissionUrl || '/api/forms/submit',
                    fields: data.fields || []
                };
                fieldIdCounter = data.fieldIdCounter || 0;
                formTitleInput.value = formState.title;
            } catch (e) {
                console.error('Error loading saved state:', e);
            }
        }
    }

    // Undo/Redo
    function saveStateForUndo() {
        undoStack.push(JSON.stringify(formState));
        redoStack = [];
        if (undoStack.length > 50) undoStack.shift();
    }

    function undo() {
        if (undoStack.length === 0) return;
        redoStack.push(JSON.stringify(formState));
        formState = JSON.parse(undoStack.pop());
        formTitleInput.value = formState.title;
        renderFields();
        saveToLocalStorage();
    }

    function redo() {
        if (redoStack.length === 0) return;
        undoStack.push(JSON.stringify(formState));
        formState = JSON.parse(redoStack.pop());
        formTitleInput.value = formState.title;
        renderFields();
        saveToLocalStorage();
    }

    function handleKeyDown(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'z') {
            e.preventDefault();
            if (e.shiftKey) {
                redo();
            } else {
                undo();
            }
        }
        if ((e.ctrlKey || e.metaKey) && e.key === 'y') {
            e.preventDefault();
            redo();
        }
    }
});
</script>
@endsection
