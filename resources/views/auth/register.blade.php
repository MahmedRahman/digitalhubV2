@extends('layouts.app')

@section('title', 'إنشاء حساب')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-bgSoft py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-heading font-bold text-textDark">
                    إنشاء حساب جديد
                </h2>
            </div>
            <form class="mt-8 space-y-6" action="#" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium mb-2" style="color: #111111;">الاسم</label>
                        <input id="name" name="name" type="text" required class="appearance-none relative block w-full px-3 py-3 border rounded-xl focus:outline-none sm:text-sm" style="border-color: #F5F6F7; color: #111111;" placeholder="الاسم الكامل" onfocus="this.style.borderColor='#04c2eb'; this.style.boxShadow='0 0 0 3px rgba(4, 194, 235, 0.3)'" onblur="this.style.borderColor='#F5F6F7'; this.style.boxShadow='none'">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium mb-2" style="color: #111111;">البريد الإلكتروني</label>
                        <input id="email" name="email" type="email" required class="appearance-none relative block w-full px-3 py-3 border rounded-xl focus:outline-none sm:text-sm" style="border-color: #F5F6F7; color: #111111;" placeholder="البريد الإلكتروني" onfocus="this.style.borderColor='#04c2eb'; this.style.boxShadow='0 0 0 3px rgba(4, 194, 235, 0.3)'" onblur="this.style.borderColor='#F5F6F7'; this.style.boxShadow='none'">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium mb-2" style="color: #111111;">كلمة المرور</label>
                        <input id="password" name="password" type="password" required class="appearance-none relative block w-full px-3 py-3 border rounded-xl focus:outline-none sm:text-sm" style="border-color: #F5F6F7; color: #111111;" placeholder="كلمة المرور" onfocus="this.style.borderColor='#04c2eb'; this.style.boxShadow='0 0 0 3px rgba(4, 194, 235, 0.3)'" onblur="this.style.borderColor='#F5F6F7'; this.style.boxShadow='none'">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium mb-2" style="color: #111111;">تأكيد كلمة المرور</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required class="appearance-none relative block w-full px-3 py-3 border rounded-xl focus:outline-none sm:text-sm" style="border-color: #F5F6F7; color: #111111;" placeholder="تأكيد كلمة المرور" onfocus="this.style.borderColor='#04c2eb'; this.style.boxShadow='0 0 0 3px rgba(4, 194, 235, 0.3)'" onblur="this.style.borderColor='#F5F6F7'; this.style.boxShadow='none'">
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center btn-primary">
                        إنشاء الحساب
                    </button>
                </div>

                <div class="text-center text-sm">
                    <span class="text-textMuted">لديك حساب بالفعل؟</span>
                    <a href="{{ route('login') }}" class="font-medium" style="color: #04c2eb;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                        تسجيل الدخول
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

