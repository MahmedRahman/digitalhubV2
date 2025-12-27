// Homepage Editor - Simplified Version
class HomepageEditor {
    constructor() {
        this.content = {};
        this.originalContent = {};
        this.isEditing = false;
        this.currentSection = null;
        this.init();
    }
    
    async init() {
        console.log('🚀 HomepageEditor: Initializing...');
        
        // Load content from server
        await this.loadContent();
        
        // Setup event listeners
        this.setupEventListeners();
        
        // Enable section edit buttons with retry mechanism
        this.enableSectionEditButtons();
        
        // Also try after a longer delay as fallback
        setTimeout(() => {
            const sections = document.querySelectorAll('[data-section]');
            if (sections.length > 0 && document.querySelectorAll('.section-edit-btn').length === 0) {
                console.log('🔄 Retrying to add edit buttons...');
                this.enableSectionEditButtons();
            }
        }, 2000);
    }
    
    async loadContent() {
        try {
            const response = await fetch('/api/homepage-content');
            const loadedContent = await response.json();
            // Deep merge with existing content to preserve unsaved changes
            if (Object.keys(this.content).length > 0) {
                this.deepMerge(this.content, loadedContent);
            } else {
                this.content = loadedContent;
            }
            this.originalContent = JSON.parse(JSON.stringify(this.content));
        } catch (error) {
            console.error('Error loading content:', error);
        }
    }
    
    setupEventListeners() {
        // Save button
        document.getElementById('save-btn')?.addEventListener('click', () => this.saveChanges());
        
        // Preview button
        document.getElementById('preview-btn')?.addEventListener('click', () => {
            window.open('/', '_blank');
        });
    }
    
    enableSectionEditButtons() {
        const preview = document.getElementById('homepage-preview');
        if (!preview) {
            console.error('homepage-preview not found');
            // Try again after a delay
            setTimeout(() => this.enableSectionEditButtons(), 1000);
            return;
        }
        
        // Wait for DOM to be fully ready
        const checkSections = () => {
            const sections = preview.querySelectorAll('[data-section]');
            console.log('Found sections:', sections.length);
            
            if (sections.length === 0) {
                // Try again if no sections found
                setTimeout(checkSections, 500);
                return;
            }
            
            sections.forEach((section, index) => {
                // Skip hidden sections
                if (section.getAttribute('data-editor-hidden') === 'true') {
                    console.log(`Skipping hidden section ${index}: ${section.getAttribute('data-section')}`);
                    return;
                }
                
                const sectionName = section.getAttribute('data-section');
                console.log(`Adding edit button to section ${index}: ${sectionName}`);
                this.addEditButton(section);
            });
        };
        
        // Use multiple strategies to ensure DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', checkSections);
        } else {
            setTimeout(checkSections, 100);
        }
    }
    
    addEditButton(section) {
        // Check if button already exists
        if (section.querySelector('.section-edit-btn')) {
            return; // Skip if button already exists
        }
        
        // Also check if this section already has a button by checking parent
        const sectionId = section.getAttribute('data-section');
        const existingButtons = document.querySelectorAll(`[data-section="${sectionId}"] .section-edit-btn`);
        if (existingButtons.length > 0) {
            return; // Skip if any section with same data-section already has a button
        }
        
        const editBtn = document.createElement('button');
        editBtn.className = 'section-edit-btn';
        editBtn.setAttribute('type', 'button');
        editBtn.innerHTML = `
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            <span>تعديل</span>
        `;
        
        // Apply inline styles with !important to ensure visibility
        editBtn.style.cssText = `
            position: absolute !important;
            top: 20px !important;
            left: 20px !important;
            z-index: 10000 !important;
            background: #04c2eb !important;
            color: white !important;
            padding: 12px 20px !important;
            border-radius: 10px !important;
            font-weight: 700 !important;
            font-size: 16px !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
            border: none !important;
            cursor: pointer !important;
            box-shadow: 0 4px 12px rgba(4, 194, 235, 0.4) !important;
            transition: all 0.2s !important;
            visibility: visible !important;
            opacity: 1 !important;
        `;
        
        editBtn.addEventListener('mouseenter', () => {
            editBtn.style.transform = 'scale(1.05)';
            editBtn.style.boxShadow = '0 6px 16px rgba(4, 194, 235, 0.5)';
        });
        
        editBtn.addEventListener('mouseleave', () => {
            editBtn.style.transform = 'scale(1)';
            editBtn.style.boxShadow = '0 4px 12px rgba(4, 194, 235, 0.4)';
        });
        
        editBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            e.preventDefault();
            this.startEditing(section);
        });
        
        // Ensure section has position relative
        const sectionStyle = window.getComputedStyle(section);
        if (sectionStyle.position === 'static' || !sectionStyle.position || sectionStyle.position === '') {
            section.style.position = 'relative';
        }
        
        // Insert button at the beginning of section
        section.insertBefore(editBtn, section.firstChild);
        
        console.log('✅ Edit button added successfully to section:', section.getAttribute('data-section'));
        console.log('Button element:', editBtn);
        console.log('Button computed style:', window.getComputedStyle(editBtn).display);
    }
    
    startEditing(section) {
        if (this.isEditing && this.currentSection !== section) {
            // Cancel previous editing
            this.cancelEditing();
        }
        
        this.isEditing = true;
        this.currentSection = section;
        const sectionKey = section.getAttribute('data-section');
        
        // Hide edit button
        const editBtn = section.querySelector('.section-edit-btn');
        if (editBtn) editBtn.style.display = 'none';
        
        // Convert editable elements to inputs
        const editableElements = section.querySelectorAll('[data-editable="true"]');
        editableElements.forEach(element => {
            const dataType = element.getAttribute('data-type');
            if (dataType === 'image') {
                this.setupImageUpload(element, sectionKey);
            } else {
                this.convertToInput(element, sectionKey);
            }
        });
        
        // Show save/cancel buttons
        this.showSaveButtons(section);
    }
    
    convertToInput(element, sectionKey) {
        const field = element.getAttribute('data-field');
        const currentValue = element.textContent.trim();
        const isLink = element.tagName === 'A';
        const linkFieldAttr = element.getAttribute('data-link-field');
        let linkHref = isLink ? element.getAttribute('href') : null;
        
        // If has data-link-field, get link from content
        if (linkFieldAttr && !linkHref) {
            const buttonKey = linkFieldAttr.split('.')[0];
            if (this.content[sectionKey] && this.content[sectionKey][buttonKey] && this.content[sectionKey][buttonKey].link) {
                linkHref = this.content[sectionKey][buttonKey].link;
            }
        }
        
        // Store ALL original element data - مهم جداً للحفاظ على CSS
        const originalData = {
            tag: element.tagName,
            className: element.className,
            style: element.getAttribute('style') || '',
            allAttributes: {}
        };
        
        // حفظ جميع الـ attributes
        Array.from(element.attributes).forEach(attr => {
            originalData.allAttributes[attr.name] = attr.value;
        });
        
        // Create input wrapper
        const wrapper = document.createElement('div');
        wrapper.className = 'edit-input-wrapper';
        wrapper.style.cssText = 'margin-bottom: 12px;';
        
        // Text input - تصميم بسيط وواضح
        const textInput = document.createElement('input');
        textInput.type = 'text';
        textInput.value = currentValue;
        textInput.className = 'edit-text-input';
        textInput.setAttribute('data-field', field);
        textInput.style.cssText = `
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #04c2eb;
            border-radius: 8px;
            font-size: 16px;
            font-family: inherit;
            color: #111111;
            background: white;
            box-shadow: 0 0 0 3px rgba(4, 194, 235, 0.1);
            outline: none;
        `;
        
        // Link input (if element is a link or has data-link-field)
        let linkInput = null;
        let externalCheckbox = null;
        const isExternal = element.getAttribute('target') === '_blank' || element.getAttribute('rel')?.includes('noopener');
        
        if (isLink || linkFieldAttr) {
            linkInput = document.createElement('input');
            linkInput.type = 'text';
            linkInput.value = linkHref || '';
            linkInput.className = 'edit-link-input';
            linkInput.setAttribute('data-field', linkFieldAttr || field);
            linkInput.placeholder = 'الرابط (مثال: /courses أو https://example.com)';
            linkInput.style.cssText = `
                width: 100%;
                padding: 10px 14px;
                border: 2px solid #E5E7EB;
                border-radius: 8px;
                font-size: 14px;
                font-family: inherit;
                background: #F5F6F7;
                margin-top: 10px;
                outline: none;
            `;
            linkInput.addEventListener('focus', () => {
                linkInput.style.borderColor = '#04c2eb';
                linkInput.style.boxShadow = '0 0 0 3px rgba(4, 194, 235, 0.1)';
            });
            linkInput.addEventListener('blur', () => {
                linkInput.style.borderColor = '#E5E7EB';
                linkInput.style.boxShadow = 'none';
            });
            
            // External link checkbox
            const checkboxWrapper = document.createElement('div');
            checkboxWrapper.style.cssText = 'margin-top: 10px; display: flex; align-items: center; gap: 8px;';
            
            externalCheckbox = document.createElement('input');
            externalCheckbox.type = 'checkbox';
            externalCheckbox.id = `external-${field}-${Date.now()}`;
            externalCheckbox.checked = isExternal;
            externalCheckbox.className = 'edit-external-checkbox';
            externalCheckbox.setAttribute('data-field', linkFieldAttr || field);
            externalCheckbox.style.cssText = 'width: 18px; height: 18px; cursor: pointer;';
            
            const checkboxLabel = document.createElement('label');
            checkboxLabel.setAttribute('for', externalCheckbox.id);
            checkboxLabel.textContent = 'رابط خارجي (يفتح في تاب جديد)';
            checkboxLabel.style.cssText = 'font-size: 14px; color: #6B6F73; cursor: pointer; user-select: none;';
            
            checkboxWrapper.appendChild(externalCheckbox);
            checkboxWrapper.appendChild(checkboxLabel);
            wrapper.appendChild(linkInput);
            wrapper.appendChild(checkboxWrapper);
        }
        
        textInput.addEventListener('focus', () => {
            textInput.style.borderColor = '#04c2eb';
            textInput.style.boxShadow = '0 0 0 3px rgba(4, 194, 235, 0.2)';
        });
        
        textInput.addEventListener('blur', () => {
            textInput.style.borderColor = '#04c2eb';
            textInput.style.boxShadow = '0 0 0 3px rgba(4, 194, 235, 0.1)';
        });
        
        // حفظ كل البيانات الأصلية في wrapper كـ JSON
        wrapper.setAttribute('data-original-data', JSON.stringify(originalData));
        if (isLink || linkFieldAttr) {
            wrapper.setAttribute('data-original-href', linkHref || '');
            wrapper.setAttribute('data-original-external', (element.getAttribute('target') === '_blank') ? 'true' : 'false');
        }
        
        // Replace element with inputs
        wrapper.appendChild(textInput);
        
        element.parentNode.replaceChild(wrapper, element);
        wrapper.setAttribute('data-field', field);
        wrapper.setAttribute('data-section', sectionKey);
        wrapper.setAttribute('data-is-link', (isLink || linkFieldAttr) ? 'true' : 'false');
        if (linkFieldAttr) {
            wrapper.setAttribute('data-link-field', linkFieldAttr);
        }
    }
    
    showSaveButtons(section) {
        // Remove existing buttons if any
        const existing = section.querySelector('.edit-actions');
        if (existing) existing.remove();
        
        const actions = document.createElement('div');
        actions.className = 'edit-actions';
        actions.style.cssText = `
            position: absolute;
            bottom: 20px;
            left: 20px;
            z-index: 100;
            display: flex;
            gap: 12px;
        `;
        
        const saveBtn = document.createElement('button');
        saveBtn.textContent = 'حفظ';
        saveBtn.className = 'btn-save';
        saveBtn.style.cssText = `
            background: #04c2eb;
            color: white;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
        `;
        saveBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            this.saveSection(section);
        });
        
        const cancelBtn = document.createElement('button');
        cancelBtn.textContent = 'إلغاء';
        cancelBtn.className = 'btn-cancel';
        cancelBtn.style.cssText = `
            background: white;
            color: #111111;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            border: 2px solid #111111;
            cursor: pointer;
        `;
        cancelBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            this.cancelEditing();
        });
        
        actions.appendChild(saveBtn);
        actions.appendChild(cancelBtn);
        section.appendChild(actions);
    }
    
    saveSection(section) {
        const sectionKey = section.getAttribute('data-section');
        const changes = {};
        
        // Collect all changes from inputs
        const inputWrappers = section.querySelectorAll('.edit-input-wrapper');
        inputWrappers.forEach(wrapper => {
            const field = wrapper.getAttribute('data-field');
            const textInput = wrapper.querySelector('.edit-text-input');
            const linkInput = wrapper.querySelector('.edit-link-input');
            const isLink = wrapper.getAttribute('data-is-link') === 'true';
            
            if (textInput) {
                const keys = field.split('.');
                let obj = changes;
                for (let i = 0; i < keys.length - 1; i++) {
                    const key = keys[i];
                    // Check if key is a number (array index)
                    const isArrayIndex = /^\d+$/.test(key);
                    if (isArrayIndex) {
                        const index = parseInt(key);
                        if (!Array.isArray(obj[key])) {
                            obj[key] = [];
                        }
                        // Ensure array is large enough
                        while (obj[key].length <= index) {
                            obj[key].push({});
                        }
                        if (!obj[key][index] || typeof obj[key][index] !== 'object') {
                            obj[key][index] = {};
                        }
                        obj = obj[key][index];
                    } else {
                        if (!obj[key] || typeof obj[key] !== 'object' || Array.isArray(obj[key])) {
                            obj[key] = {};
                        }
                        obj = obj[key];
                    }
                }
                const lastKey = keys[keys.length - 1];
                obj[lastKey] = textInput.value;
            }
            
            if (linkInput) {
                const linkFieldName = wrapper.getAttribute('data-link-field') || field;
                const buttonKey = linkFieldName.split('.')[0]; // e.g., "button1"
                if (!changes[buttonKey]) {
                    changes[buttonKey] = {};
                }
                changes[buttonKey]['link'] = linkInput.value;
                
                // Handle external link checkbox
                const externalCheckbox = wrapper.querySelector('.edit-external-checkbox');
                if (externalCheckbox) {
                    changes[buttonKey]['external'] = externalCheckbox.checked;
                }
            }
        });
        
        // Update content object
        if (!this.content[sectionKey]) {
            this.content[sectionKey] = {};
        }
        this.deepMerge(this.content[sectionKey], changes);
        
        // Convert inputs back to elements
        this.convertInputsToElements(section);
        
        // Remove image upload buttons
        const uploadContainers = section.querySelectorAll('[data-type="image-upload"]');
        uploadContainers.forEach(container => {
            container.remove();
        });
        
        // Hide save buttons and show edit button
        const actions = section.querySelector('.edit-actions');
        if (actions) actions.remove();
        
        const editBtn = section.querySelector('.section-edit-btn');
        if (editBtn) editBtn.style.display = 'flex';
        
        this.isEditing = false;
        this.currentSection = null;
        
        // Mark as unsaved
        this.hasUnsavedChanges = true;
        this.updateUnsavedIndicator();
    }
    
    convertInputsToElements(section) {
        const inputWrappers = section.querySelectorAll('.edit-input-wrapper');
        inputWrappers.forEach(wrapper => {
            const field = wrapper.getAttribute('data-field');
            const sectionKey = wrapper.getAttribute('data-section');
            const isLink = wrapper.getAttribute('data-is-link') === 'true';
            const textInput = wrapper.querySelector('.edit-text-input');
            const linkInput = wrapper.querySelector('.edit-link-input');
            
            // استرجاع كل البيانات الأصلية من JSON
            const originalDataStr = wrapper.getAttribute('data-original-data');
            let originalData = {
                tag: 'span',
                className: '',
                style: '',
                allAttributes: {}
            };
            
            if (originalDataStr) {
                try {
                    originalData = JSON.parse(originalDataStr);
                } catch (e) {
                    console.error('Error parsing original data:', e);
                }
            }
            
            // الحصول على القيمة الجديدة من content object أو من input
            const keys = field.split('.');
            let value = this.content[sectionKey];
            for (const key of keys) {
                if (value && typeof value === 'object') {
                    // Check if key is a number (array index)
                    const isArrayIndex = /^\d+$/.test(key);
                    if (isArrayIndex && Array.isArray(value)) {
                        const index = parseInt(key);
                        value = value[index];
                    } else if (key in value) {
                        value = value[key];
                    } else {
                        value = textInput ? textInput.value : '';
                        break;
                    }
                } else {
                    value = textInput ? textInput.value : '';
                    break;
                }
            }
            
            // إنشاء العنصر الجديد بنفس الـ tag الأصلي
            const element = document.createElement(originalData.tag);
            
            // استعادة جميع الـ classes الأصلية - مهم جداً للـ CSS
            element.className = originalData.className;
            
            // استعادة الـ style الأصلي
            if (originalData.style) {
                element.setAttribute('style', originalData.style);
            }
            
            // استعادة جميع الـ attributes الأصلية (ماعدا data-editable و data-field)
            Object.keys(originalData.allAttributes).forEach(attrName => {
                if (attrName !== 'data-editable' && attrName !== 'data-field' && attrName !== 'style') {
                    element.setAttribute(attrName, originalData.allAttributes[attrName]);
                }
            });
            
            // إضافة الـ attributes المطلوبة للتعديل
            element.setAttribute('data-editable', 'true');
            element.setAttribute('data-section', sectionKey);
            element.setAttribute('data-field', field);
            element.setAttribute('data-type', 'text');
            
            // وضع النص الجديد
            element.textContent = value || (textInput ? textInput.value : '');
            
            // إذا كان link أو له data-link-field، نحدث الـ href
            const linkField = wrapper.getAttribute('data-link-field');
            if (isLink || linkField) {
                const buttonKey = (linkField || field).split('.')[0];
                const linkValue = linkInput ? linkInput.value : (this.content[sectionKey] && this.content[sectionKey][buttonKey] && this.content[sectionKey][buttonKey].link ? this.content[sectionKey][buttonKey].link : '');
                const isExternal = this.content[sectionKey] && this.content[sectionKey][buttonKey] && this.content[sectionKey][buttonKey].external;
                
                if (linkValue) {
                    element.setAttribute('href', linkValue);
                }
                
                // Handle external link
                if (isExternal) {
                    element.setAttribute('target', '_blank');
                    element.setAttribute('rel', 'noopener noreferrer');
                } else {
                    element.removeAttribute('target');
                    element.removeAttribute('rel');
                }
                
                // Add data-link-field if it exists
                if (linkField) {
                    element.setAttribute('data-link-field', linkField);
                }
            }
            
            // استبدال wrapper بالعنصر الجديد
            wrapper.parentNode.replaceChild(element, wrapper);
        });
    }
    
    cancelEditing() {
        if (!this.currentSection) return;
        
        const section = this.currentSection;
        
        // Convert inputs back to original elements
        const inputWrappers = section.querySelectorAll('.edit-input-wrapper');
        inputWrappers.forEach(wrapper => {
            const field = wrapper.getAttribute('data-field');
            const sectionKey = wrapper.getAttribute('data-section');
            const isLink = wrapper.getAttribute('data-is-link') === 'true';
            
            // Get original element data from JSON
            const originalDataStr = wrapper.getAttribute('data-original-data');
            let originalData = {
                tag: 'span',
                className: '',
                style: '',
                allAttributes: {}
            };
            
            if (originalDataStr) {
                try {
                    originalData = JSON.parse(originalDataStr);
                } catch (e) {
                    console.error('Error parsing original data:', e);
                }
            }
            
            // Fallback to old attributes if JSON not found
            if (!originalDataStr || (originalData.tag === 'span' && !originalData.className)) {
                originalData.tag = wrapper.getAttribute('data-original-tag') || originalData.tag;
                originalData.className = wrapper.getAttribute('data-original-class') || originalData.className;
                originalData.style = wrapper.getAttribute('data-original-style') || originalData.style;
            }
            
            const originalHref = wrapper.getAttribute('data-original-href') || '';
            
            // Get original value from content
            const keys = field.split('.');
            let value = this.originalContent[sectionKey];
            for (const key of keys) {
                if (value && typeof value === 'object') {
                    // Check if key is a number (array index)
                    const isArrayIndex = /^\d+$/.test(key);
                    if (isArrayIndex && Array.isArray(value)) {
                        const index = parseInt(key);
                        value = value[index];
                    } else {
                        value = value?.[key];
                    }
                } else {
                    value = null;
                    break;
                }
            }
            
            // Create element with original data
            const element = document.createElement(originalData.tag);
            
            // Restore all original attributes
            if (originalData.allAttributes && Object.keys(originalData.allAttributes).length > 0) {
                Object.keys(originalData.allAttributes).forEach(attrName => {
                    // Skip data-editable, data-section, data-field, data-type as we'll set them manually
                    if (!['data-editable', 'data-section', 'data-field', 'data-type', 'data-link-field'].includes(attrName)) {
                        element.setAttribute(attrName, originalData.allAttributes[attrName]);
                    }
                });
            } else {
                // Fallback: restore className and style
                if (originalData.className) {
                    element.className = originalData.className;
                }
                if (originalData.style) {
                    element.setAttribute('style', originalData.style);
                }
            }
            
            // Set editable attributes
            element.setAttribute('data-editable', 'true');
            element.setAttribute('data-section', sectionKey);
            element.setAttribute('data-field', field);
            element.setAttribute('data-type', 'text');
            
            // Set text content
            element.textContent = value || '';
            
            // Handle links
            const linkFieldAttr = wrapper.getAttribute('data-link-field');
            if (isLink || linkFieldAttr) {
                const buttonKey = (linkFieldAttr || field).split('.')[0];
                let linkValue = originalHref;
                let isExternal = false;
                
                // Get link value from original content
                if (this.originalContent[sectionKey] && this.originalContent[sectionKey][buttonKey]) {
                    if (this.originalContent[sectionKey][buttonKey].link) {
                        linkValue = this.originalContent[sectionKey][buttonKey].link;
                    }
                    if (this.originalContent[sectionKey][buttonKey].external) {
                        isExternal = true;
                    }
                }
                
                if (linkValue) {
                    element.setAttribute('href', linkValue);
                }
                
                // Handle external link
                if (isExternal) {
                    element.setAttribute('target', '_blank');
                    element.setAttribute('rel', 'noopener noreferrer');
                } else {
                    element.removeAttribute('target');
                    element.removeAttribute('rel');
                }
                
                // Add data-link-field if it exists
                if (linkFieldAttr) {
                    element.setAttribute('data-link-field', linkFieldAttr);
                }
            }
            
            wrapper.parentNode.replaceChild(element, wrapper);
        });
        
        // Remove image upload buttons
        const uploadContainers = section.querySelectorAll('[data-type="image-upload"]');
        uploadContainers.forEach(container => {
            container.remove();
        });
        
        // Hide save buttons and show edit button
        const actions = section.querySelector('.edit-actions');
        if (actions) {
            actions.remove();
        }
        
        const editBtn = section.querySelector('.section-edit-btn');
        if (editBtn) {
            editBtn.style.display = 'flex';
        }
        
        // Reset editing state
        this.isEditing = false;
        this.currentSection = null;
        
        // Re-enable section edit buttons to ensure they're visible
        setTimeout(() => {
            const sections = document.querySelectorAll('[data-section]');
            sections.forEach(sec => {
                if (!sec.querySelector('.section-edit-btn')) {
                    this.addEditButton(sec);
                }
            });
        }, 100);
    }
    
    async saveChanges() {
        if (!this.hasUnsavedChanges) {
            alert('لا توجد تغييرات للحفظ');
            return;
        }
        
        const saveBtn = document.getElementById('save-btn');
        const originalText = saveBtn.textContent;
        saveBtn.textContent = 'جاري الحفظ...';
        saveBtn.disabled = true;
        
        try {
            // Get CSRF token from meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            const headers = {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            };
            
            // Add CSRF token if available
            if (csrfToken) {
                headers['X-CSRF-TOKEN'] = csrfToken;
            }
            
            const response = await fetch('/api/homepage-content/update', {
                method: 'POST',
                headers: headers,
                body: JSON.stringify({ content: this.content }),
                credentials: 'same-origin'
            });
            
            // Check if response is OK
            if (!response.ok) {
                // If 419, try to get new CSRF token
                if (response.status === 419) {
                    console.error('CSRF token mismatch. Please refresh the page.');
                    alert('انتهت صلاحية الجلسة. يرجى تحديث الصفحة والمحاولة مرة أخرى.');
                    return;
                }
                
                // Try to parse error response
                const errorText = await response.text();
                console.error('Server error:', response.status, errorText);
                throw new Error(`Server error: ${response.status}`);
            }
            
            const result = await response.json();
            
            if (result.success) {
                this.originalContent = JSON.parse(JSON.stringify(this.content));
                this.hasUnsavedChanges = false;
                this.updateUnsavedIndicator();
                
                // Reload content from server to get updated values
                await this.loadContent();
                
                // Update all elements on page with new content
                this.updateAllElements();
                
                alert('تم حفظ التغييرات بنجاح');
            } else {
                alert('حدث خطأ: ' + result.message);
            }
        } catch (error) {
            console.error('Error saving:', error);
            alert('حدث خطأ أثناء الحفظ');
        } finally {
            saveBtn.textContent = originalText;
            saveBtn.disabled = false;
        }
    }
    
    updateAllElements() {
        // Update all editable elements with current content
        const editableElements = document.querySelectorAll('[data-editable="true"]');
        editableElements.forEach(element => {
            const field = element.getAttribute('data-field');
            const sectionKey = element.getAttribute('data-section');
            const sectionContent = this.content[sectionKey];
            
            if (!sectionContent) return;
            
            // Get value from nested path
            const keys = field.split('.');
            let value = sectionContent;
            for (const key of keys) {
                if (value && typeof value === 'object') {
                    // Check if key is a number (array index)
                    const isArrayIndex = /^\d+$/.test(key);
                    if (isArrayIndex && Array.isArray(value)) {
                        const index = parseInt(key);
                        value = value[index];
                    } else if (key in value) {
                        value = value[key];
                    } else {
                        value = null;
                        break;
                    }
                } else {
                    value = null;
                    break;
                }
            }
            
            if (value !== null && value !== undefined) {
                // Update text content
                const linkField = element.getAttribute('data-link-field');
                if (element.tagName === 'A' || linkField) {
                    // For links, also update href if it's a button
                    const buttonKey = (linkField || field).split('.')[0];
                    if (sectionContent[buttonKey] && sectionContent[buttonKey].link) {
                        element.setAttribute('href', sectionContent[buttonKey].link);
                    }
                    // Handle external link
                    if (sectionContent[buttonKey] && sectionContent[buttonKey].external) {
                        element.setAttribute('target', '_blank');
                        element.setAttribute('rel', 'noopener noreferrer');
                    } else {
                        element.removeAttribute('target');
                        element.removeAttribute('rel');
                    }
                }
                element.textContent = value;
            }
        });
    }
    
    deepMerge(target, source) {
        for (const key in source) {
            if (Array.isArray(source[key])) {
                // Handle arrays - replace or merge based on structure
                if (!target[key] || !Array.isArray(target[key])) {
                    target[key] = [];
                }
                // For arrays, we'll merge by index if both are arrays
                source[key].forEach((item, index) => {
                    if (typeof item === 'object' && item !== null && !Array.isArray(item)) {
                        if (!target[key][index]) {
                            target[key][index] = {};
                        }
                        this.deepMerge(target[key][index], item);
                    } else {
                        target[key][index] = item;
                    }
                });
            } else if (typeof source[key] === 'object' && source[key] !== null) {
                if (!target[key] || Array.isArray(target[key])) {
                    target[key] = {};
                }
                this.deepMerge(target[key], source[key]);
            } else {
                target[key] = source[key];
            }
        }
    }
    
    updateUnsavedIndicator() {
        const indicator = document.getElementById('unsaved-indicator');
        if (indicator) {
            if (this.hasUnsavedChanges) {
                indicator.classList.remove('hidden');
            } else {
                indicator.classList.add('hidden');
            }
        }
    }
}

// Make HomepageEditor available globally
window.HomepageEditor = HomepageEditor;

// Function to initialize editor
function initHomepageEditor() {
    console.log('🔍 Looking for homepage-preview...');
    const preview = document.getElementById('homepage-preview');
    console.log('📦 homepage-preview element:', preview);
    
    if (preview) {
        console.log('✅ Found homepage-preview! Initializing HomepageEditor...');
        window.homepageEditor = new HomepageEditor();
        return true;
    } else {
        console.warn('⚠️ homepage-preview not found yet');
        return false;
    }
}

// Try multiple times with increasing delays
let attempts = 0;
const maxAttempts = 10;

function tryInit() {
    attempts++;
    console.log(`🔄 Attempt ${attempts}/${maxAttempts} to find homepage-preview...`);
    
    if (initHomepageEditor()) {
        console.log('✅ Successfully initialized!');
        return;
    }
    
    if (attempts < maxAttempts) {
        setTimeout(tryInit, 500 * attempts); // Increasing delay
    } else {
        console.error('❌ Failed to find homepage-preview after all attempts');
        // Try one more time with querySelector as fallback
        const preview = document.querySelector('[id="homepage-preview"]');
        if (preview) {
            console.log('✅ Found with querySelector! Initializing...');
            window.homepageEditor = new HomepageEditor();
        }
    }
}

// Start trying immediately
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        console.log('📄 DOM Content Loaded');
        tryInit();
    });
} else {
    console.log('📄 DOM already loaded');
    tryInit();
}

// Also try on window load
window.addEventListener('load', () => {
    console.log('🪟 Window Loaded');
    if (!window.homepageEditor) {
        console.log('🔄 Window load fallback: trying again...');
        tryInit();
    }
});

// Image upload functionality
HomepageEditor.prototype.setupImageUpload = function(element, sectionKey) {
    const field = element.getAttribute('data-field');
    const currentImage = element.querySelector('img');
    const currentImageSrc = currentImage ? currentImage.getAttribute('src') : null;
    
    // Create file input (hidden)
    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.accept = 'image/*';
    fileInput.style.display = 'none';
    fileInput.id = `image-upload-${field}-${Date.now()}`;
    
    // Create upload button container
    const buttonContainer = document.createElement('div');
    buttonContainer.className = 'image-upload-button-container';
    buttonContainer.style.cssText = `
        margin-top: 12px;
        text-align: center;
    `;
    
    // Create upload button
    const uploadButton = document.createElement('button');
    uploadButton.type = 'button';
    uploadButton.className = 'image-upload-btn';
    uploadButton.innerHTML = `
        <svg class="w-5 h-5 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        ${currentImageSrc ? 'تغيير الصورة' : 'رفع صورة'}
    `;
    uploadButton.style.cssText = `
        background: #04c2eb;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.2s;
    `;
    
    uploadButton.addEventListener('mouseenter', () => {
        uploadButton.style.background = '#03a8c4';
        uploadButton.style.transform = 'scale(1.05)';
    });
    
    uploadButton.addEventListener('mouseleave', () => {
        uploadButton.style.background = '#04c2eb';
        uploadButton.style.transform = 'scale(1)';
    });
    
    // Click to upload
    uploadButton.addEventListener('click', () => {
        fileInput.click();
    });
    
    // Handle file selection
    fileInput.addEventListener('change', async (e) => {
        const file = e.target.files[0];
        if (!file) return;
        
        // Validate file
        if (!file.type.startsWith('image/')) {
            alert('الرجاء اختيار ملف صورة');
            return;
        }
        
        if (file.size > 5 * 1024 * 1024) {
            alert('حجم الملف يجب أن يكون أقل من 5MB');
            return;
        }
        
        // Show loading
        const originalText = uploadButton.innerHTML;
        uploadButton.innerHTML = '<span>جاري الرفع...</span>';
        uploadButton.disabled = true;
        
        // Upload image
        const formData = new FormData();
        formData.append('image', file);
        formData.append('section', sectionKey);
        formData.append('field', field);
        
        try {
            // Get CSRF token from meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            const headers = {
                'Accept': 'application/json'
            };
            
            // Add CSRF token if available
            if (csrfToken) {
                headers['X-CSRF-TOKEN'] = csrfToken;
            }
            
            const response = await fetch('/api/homepage-content/upload-image', {
                method: 'POST',
                headers: headers,
                body: formData
            });
            
            const result = await response.json();
            
            if (result.success) {
                // Update content
                if (!this.content[sectionKey]) {
                    this.content[sectionKey] = {};
                }
                this.content[sectionKey][field] = result.image_path;
                
                // Update image preview
                if (currentImage) {
                    // Remove any overlays that might be covering the image first
                    const parent = currentImage.parentElement;
                    if (parent) {
                        const overlays = parent.querySelectorAll('.absolute.inset-0');
                        overlays.forEach(overlay => {
                            overlay.style.display = 'none';
                            overlay.style.visibility = 'hidden';
                        });
                    }
                    
                    // Force reload the image with cache busting
                    const newSrc = result.image_url + '?t=' + Date.now();
                    currentImage.src = '';
                    currentImage.onerror = () => {
                        console.error('Failed to load image:', newSrc);
                    };
                    currentImage.onload = () => {
                        currentImage.style.display = 'block';
                        currentImage.style.opacity = '1';
                        currentImage.style.visibility = 'visible';
                    };
                    currentImage.src = newSrc;
                } else {
                    // If no image exists, check if we need to replace SVG
                    const svg = element.querySelector('svg');
                    const overlay = element.querySelector('.absolute.inset-0');
                    
                    if (svg) {
                        // Remove SVG
                        svg.remove();
                    }
                    
                    if (overlay) {
                        // Remove overlay
                        overlay.remove();
                    }
                    
                    // Create new image
                    const img = document.createElement('img');
                    img.src = result.image_url;
                    img.alt = 'Hero Image';
                    img.className = 'w-full max-w-md rounded-xl shadow-lg';
                    img.style.cssText = 'display: block !important; width: 100%; max-width: 28rem; border-radius: 0.75rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); object-fit: cover; visibility: visible !important; opacity: 1 !important; z-index: 1; position: relative;';
                    img.onerror = () => {
                        console.error('Failed to load image:', result.image_url);
                        alert('فشل تحميل الصورة. يرجى المحاولة مرة أخرى.');
                    };
                    
                    // Insert image at the beginning of the element
                    if (element.firstChild) {
                        element.insertBefore(img, element.firstChild);
                    } else {
                        element.appendChild(img);
                    }
                }
                
                // Update button text
                uploadButton.innerHTML = `
                    <svg class="w-5 h-5 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    تغيير الصورة
                `;
                uploadButton.disabled = false;
                
                // Mark as unsaved
                this.hasUnsavedChanges = true;
                this.updateUnsavedIndicator();
            } else {
                alert('حدث خطأ: ' + (result.message || 'فشل رفع الصورة'));
                uploadButton.innerHTML = originalText;
                uploadButton.disabled = false;
            }
        } catch (error) {
            console.error('Error uploading image:', error);
            alert('حدث خطأ أثناء رفع الصورة');
            uploadButton.innerHTML = originalText;
            uploadButton.disabled = false;
        }
    });
    
    buttonContainer.appendChild(uploadButton);
    buttonContainer.appendChild(fileInput);
    
    // Add button container after the element
    element.parentNode.insertBefore(buttonContainer, element.nextSibling);
    
    // Store reference for cleanup
    element.setAttribute('data-upload-container', 'true');
    buttonContainer.setAttribute('data-field', field);
    buttonContainer.setAttribute('data-section', sectionKey);
    buttonContainer.setAttribute('data-type', 'image-upload');
};
