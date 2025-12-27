// Homepage Editor - Simplified Version
class AboutEditor {
    constructor() {
        this.content = {};
        this.originalContent = {};
        this.isEditing = false;
        this.currentSection = null;
        this.init();
    }
    
    async init() {
        console.log('🚀 AboutEditor: Initializing...');
        
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
            const response = await fetch('/api/about-content');
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
                const preview = document.getElementById('about-preview');
                if (!preview) {
                    console.error('about-preview not found');
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
            this.convertToInput(element, sectionKey);
        });
        
        // Show save/cancel buttons
        this.showSaveButtons(section);
    }
    
    convertToInput(element, sectionKey) {
        const field = element.getAttribute('data-field');
        const currentValue = element.textContent.trim();
        const isLink = element.tagName === 'A';
        const linkHref = isLink ? element.getAttribute('href') : null;
        
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
        
        // Link input (if element is a link)
        let linkInput = null;
        if (isLink) {
            linkInput = document.createElement('input');
            linkInput.type = 'text';
            linkInput.value = linkHref || '';
            linkInput.className = 'edit-link-input';
            linkInput.setAttribute('data-field', field);
            linkInput.placeholder = 'الرابط (مثال: /courses)';
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
        if (isLink) {
            wrapper.setAttribute('data-original-href', linkHref || '');
        }
        
        // Replace element with inputs
        wrapper.appendChild(textInput);
        if (linkInput) {
            wrapper.appendChild(linkInput);
        }
        
        element.parentNode.replaceChild(wrapper, element);
        wrapper.setAttribute('data-field', field);
        wrapper.setAttribute('data-section', sectionKey);
        wrapper.setAttribute('data-is-link', isLink ? 'true' : 'false');
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
            
            if (linkInput && isLink) {
                const buttonKey = field.split('.')[0]; // e.g., "button1"
                if (!changes[buttonKey]) {
                    changes[buttonKey] = {};
                }
                changes[buttonKey]['link'] = linkInput.value;
            }
        });
        
        // Update content object
        if (!this.content[sectionKey]) {
            this.content[sectionKey] = {};
        }
        this.deepMerge(this.content[sectionKey], changes);
        
        // Convert inputs back to elements
        this.convertInputsToElements(section);
        
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
            
            // إذا كان link، نحدث الـ href
            if (isLink) {
                const buttonKey = field.split('.')[0];
                const linkValue = linkInput ? linkInput.value : (this.content[sectionKey] && this.content[sectionKey][buttonKey] && this.content[sectionKey][buttonKey].link ? this.content[sectionKey][buttonKey].link : '');
                if (linkValue) {
                    element.setAttribute('href', linkValue);
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
            if (isLink) {
                const linkField = field.includes('.text') ? field.replace('.text', '.link') : field + '.link';
                const linkValue = this.getNestedProperty(this.originalContent[sectionKey], linkField) || originalHref;
                if (linkValue) {
                    element.setAttribute('href', linkValue);
                } else if (originalHref) {
                    element.setAttribute('href', originalHref);
                }
            }
            
            wrapper.parentNode.replaceChild(element, wrapper);
        });
        
        // Hide save buttons and show edit button
        const actions = section.querySelector('.edit-actions');
        if (actions) actions.remove();
        
        const editBtn = section.querySelector('.section-edit-btn');
        if (editBtn) editBtn.style.display = 'flex';
        
        this.isEditing = false;
        this.currentSection = null;
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
                    const response = await fetch('/api/about-content/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                },
                body: JSON.stringify({ content: this.content })
            });
            
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
                if (element.tagName === 'A') {
                    // For links, also update href if it's a button
                    const buttonKey = field.split('.')[0];
                    if (sectionContent[buttonKey] && sectionContent[buttonKey].link) {
                        element.setAttribute('href', sectionContent[buttonKey].link);
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

// Make AboutEditor available globally
window.AboutEditor = AboutEditor;

// Function to initialize editor
function initAboutEditor() {
    console.log('🔍 Looking for about-preview...');
    const preview = document.getElementById('about-preview');
    console.log('📦 about-preview element:', preview);
    
    if (preview) {
        console.log('✅ Found about-preview! Initializing AboutEditor...');
        window.aboutEditor = new AboutEditor();
        return true;
    } else {
        console.warn('⚠️ about-preview not found yet');
        return false;
    }
}

// Try multiple times with increasing delays
let attempts = 0;
const maxAttempts = 10;

function tryInit() {
    attempts++;
    console.log(`🔄 Attempt ${attempts}/${maxAttempts} to find about-preview...`);
    
    if (initAboutEditor()) {
        console.log('✅ Successfully initialized!');
        return;
    }
    
    if (attempts < maxAttempts) {
        setTimeout(tryInit, 500 * attempts); // Increasing delay
    } else {
        console.error('❌ Failed to find about-preview after all attempts');
        // Try one more time with querySelector as fallback
        const preview = document.querySelector('[id="about-preview"]');
        if (preview) {
            console.log('✅ Found with querySelector! Initializing...');
            window.aboutEditor = new AboutEditor();
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
    if (!window.aboutEditor) {
        console.log('🔄 Window load fallback: trying again...');
        tryInit();
    }
});
