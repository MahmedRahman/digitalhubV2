@extends('layouts.dashboard')

@section('title', 'تعديل الصفحة الرئيسية')
@section('page-title', 'تعديل الصفحة الرئيسية')
@section('page-description', 'عدّل محتوى الصفحة الرئيسية مباشرة')

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
    #homepage-preview {
        padding-bottom: 0 !important;
        margin-bottom: 0 !important;
    }
    
    #homepage-preview > *:last-child {
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
    
    .editor-sidebar {
        width: 350px;
        background: white;
        border-left: 2px solid #F5F6F7;
        overflow-y: auto;
        flex-shrink: 0;
    }
    
    .editor-mode [data-editable="true"] {
        position: relative;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .editor-mode [data-editable="true"]:hover {
        outline: 2px dashed #04c2eb;
        outline-offset: 2px;
    }
    
    .editor-mode [data-editable="true"].selected {
        outline: 2px solid #04c2eb;
        outline-offset: 2px;
        background-color: rgba(4, 194, 235, 0.05);
    }
    
    .editor-mode [data-section].section-selected {
        outline: 2px solid #04c2eb;
        outline-offset: 2px;
        position: relative;
    }
    
    .editor-mode [data-section].section-selected::before {
        content: attr(data-section-name);
        position: absolute;
        top: -10px;
        right: 10px;
        background: #04c2eb;
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        z-index: 10;
    }
    
    .property-group {
        padding: 16px;
        border-bottom: 1px solid #F5F6F7;
    }
    
    .property-group-title {
        font-weight: 700;
        font-size: 14px;
        color: #111111;
        margin-bottom: 12px;
    }
    
    .property-item {
        margin-bottom: 16px;
    }
    
    .property-label {
        display: block;
        font-size: 13px;
        font-weight: 500;
        color: #6B6F73;
        margin-bottom: 6px;
    }
    
    .property-input {
        width: 100%;
        padding: 8px 12px;
        border: 2px solid #E5E7EB;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.2s;
    }
    
    .property-input:focus {
        outline: none;
        border-color: #04c2eb;
        box-shadow: 0 0 0 3px rgba(4, 194, 235, 0.1);
    }
    
    .color-input-group {
        display: flex;
        gap: 8px;
        align-items: center;
    }
    
    .color-picker {
        width: 50px;
        height: 40px;
        border: 2px solid #E5E7EB;
        border-radius: 8px;
        cursor: pointer;
    }
    
    .color-input {
        flex: 1;
    }
</style>
@endpush

@section('content')
<div class="editor-container" style="margin: -24px -32px; width: calc(100% + 64px); height: calc(100vh - 64px);">
    <!-- Top Bar -->
    <div class="editor-topbar">
        <div class="flex items-center gap-4">
            <h2 class="text-lg font-heading font-bold text-textDark">محرر الصفحة الرئيسية</h2>
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
        <!-- Homepage Preview -->
        <div class="editor-content" id="homepage-preview" style="min-height: 200px; background: #f0f0f0;">
            <!-- Hide navbar, footer, and courses section in editor -->
            <style>
                #homepage-preview nav,
                #homepage-preview footer,
                #homepage-preview [data-section="courses"],
                #homepage-preview [data-editor-hidden="true"] {
                    display: none !important;
                }
                
                /* Also hide navbar and footer if they're in the included content */
                #homepage-preview header,
                #homepage-preview .navbar,
                #homepage-preview .footer {
                    display: none !important;
                }
                
                /* Remove white space at the end */
                #homepage-preview {
                    padding-bottom: 0 !important;
                    margin-bottom: 0 !important;
                }
                
                #homepage-preview > *:last-child {
                    margin-bottom: 0 !important;
                    padding-bottom: 0 !important;
                }
                
                #homepage-preview section:last-child {
                    margin-bottom: 0 !important;
                    padding-bottom: 4rem !important;
                }
            </style>
            @include('home', ['editor_mode' => true, 'content' => $content, 'isStandalone' => false])
        </div>
        
        <!-- Sidebar -->
        <div class="editor-sidebar" id="editor-sidebar" style="display: none;">
            <!-- Sidebar hidden - not needed anymore -->
        </div>
    </div>
</div>

@push('scripts')
@vite(['resources/js/dashboard-homepage-editor.js'])
@endpush
@endsection

