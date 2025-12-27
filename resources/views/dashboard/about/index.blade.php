@extends('layouts.dashboard')

@section('title', 'تعديل صفحة عن المنصة')
@section('page-title', 'تعديل صفحة عن المنصة')
@section('page-description', 'عدّل محتوى صفحة عن المنصة مباشرة')

@push('styles')
<style>
    .editor-container {
        display: flex;
        flex-direction: column;
        height: calc(100vh - 64px);
        overflow: hidden;
    }
    
    .editor-topbar {
        height: 60px;
        background: white;
        border-bottom: 2px solid #F5F6F7;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 24px;
        flex-shrink: 0;
    }
    
    .editor-main {
        display: flex;
        flex: 1;
        overflow: hidden;
    }
    
    /* Hide sidebar completely */
    .editor-sidebar {
        display: none !important;
    }
    
    .editor-content {
        flex: 1;
        overflow-y: auto;
        background: #F5F6F7;
        position: relative;
    }
    
    /* Remove white space at the end */
    #about-preview {
        padding-bottom: 0 !important;
        margin-bottom: 0 !important;
    }
    
    #about-preview > *:last-child {
        margin-bottom: 0 !important;
        padding-bottom: 0 !important;
    }
    
    .section-editable {
        position: relative !important;
        min-height: 200px;
    }
    
    .section-edit-btn {
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
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .section-edit-btn:hover {
        transform: scale(1.05) !important;
        box-shadow: 0 6px 16px rgba(4, 194, 235, 0.5) !important;
        background: #03a8c4 !important;
    }
    
    .section-edit-btn svg {
        width: 20px !important;
        height: 20px !important;
        flex-shrink: 0;
    }
    
    .edit-input-wrapper {
        margin-bottom: 12px;
    }
    
    .edit-text-input, .edit-link-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #04c2eb;
        border-radius: 8px;
        font-size: inherit;
        font-weight: inherit;
        font-family: inherit;
        color: inherit;
        background: white;
        box-shadow: 0 0 0 3px rgba(4, 194, 235, 0.2);
        outline: none;
        transition: all 0.2s;
    }
    
    .edit-link-input {
        background: #F5F6F7;
        margin-top: 10px;
        border-color: #E5E7EB;
        box-shadow: none;
    }
    
    .edit-link-input:focus {
        border-color: #04c2eb;
        box-shadow: 0 0 0 3px rgba(4, 194, 235, 0.1);
    }
    
    .edit-actions {
        position: absolute;
        bottom: 20px;
        left: 20px;
        z-index: 100;
        display: flex;
        gap: 12px;
    }
    
    .edit-actions button {
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        cursor: pointer;
    }
    
    .edit-actions .btn-save {
        background: #04c2eb;
        color: white;
    }
    
    .edit-actions .btn-cancel {
        background: white;
        color: #111111;
        border: 2px solid #111111;
    }
</style>
@endpush

@section('content')
<div class="editor-container" style="margin: -24px -32px; width: calc(100% + 64px); height: calc(100vh - 64px);">
    <!-- Top Bar -->
    <div class="editor-topbar">
        <div class="flex items-center gap-4">
            <h2 class="text-lg font-heading font-bold text-textDark">محرر صفحة عن المنصة</h2>
            <span id="unsaved-indicator" class="text-sm text-textMuted hidden">• تغييرات غير محفوظة</span>
        </div>
        <div class="flex items-center gap-3">
            <button id="preview-btn" class="px-4 py-2 rounded-lg text-sm font-medium border-2" style="border-color: #E5E7EB; color: #6B6F73;">
                معاينة
            </button>
            <button id="save-btn" class="px-6 py-2 rounded-lg text-sm font-medium btn-primary">
                حفظ
            </button>
            <a href="{{ route('dashboard.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium border-2" style="border-color: #E5E7EB; color: #6B6F73;">
                إغلاق
            </a>
        </div>
    </div>
    
    <!-- Main Content Area -->
    <div class="editor-main">
        <!-- About Page Preview -->
        <div class="editor-content" id="about-preview" style="min-height: 200px; background: #f0f0f0;">
            <!-- Hide navbar and footer in editor -->
            <style>
                #about-preview nav,
                #about-preview footer,
                #about-preview [data-editor-hidden="true"] {
                    display: none !important;
                }
                
                /* Also hide navbar and footer if they're in the included content */
                #about-preview header,
                #about-preview .navbar,
                #about-preview .footer {
                    display: none !important;
                }
                
                /* Remove white space at the end */
                #about-preview section:last-child {
                    margin-bottom: 0 !important;
                    padding-bottom: 4rem !important;
                }
            </style>
            @include('about', ['editor_mode' => true, 'content' => $content, 'isStandalone' => false])
        </div>
        
        <!-- Sidebar -->
        <div class="editor-sidebar" id="editor-sidebar" style="display: none;">
            <!-- Sidebar hidden - not needed anymore -->
        </div>
    </div>
</div>

@push('scripts')
@vite(['resources/js/dashboard-about-editor.js'])
@endpush
@endsection



