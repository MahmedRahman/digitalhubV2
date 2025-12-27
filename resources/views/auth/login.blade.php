@extends('layouts.app')

@section('title', 'تسجيل الدخول')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-bgSoft py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-heading font-bold text-textDark">
                    تسجيل الدخول
                </h2>
            </div>
            <form class="mt-8 space-y-6" action="#" method="POST">
                @csrf
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email" class="sr-only">البريد الإلكتروني</label>
                        <input id="email" name="email" type="email" required class="appearance-none rounded-t-xl relative block w-full px-3 py-3 border focus:outline-none focus:z-10 sm:text-sm" style="border-color: #F5F6F7; color: #111111;" placeholder="البريد الإلكتروني" onfocus="this.style.borderColor='#04c2eb'; this.style.boxShadow='0 0 0 3px rgba(4, 194, 235, 0.3)'" onblur="this.style.borderColor='#F5F6F7'; this.style.boxShadow='none'">
                    </div>
                    <div>
                        <label for="password" class="sr-only">كلمة المرور</label>
                        <input id="password" name="password" type="password" required class="appearance-none rounded-b-xl relative block w-full px-3 py-3 border focus:outline-none focus:z-10 sm:text-sm" style="border-color: #F5F6F7; color: #111111;" placeholder="كلمة المرور" onfocus="this.style.borderColor='#04c2eb'; this.style.boxShadow='0 0 0 3px rgba(4, 194, 235, 0.3)'" onblur="this.style.borderColor='#F5F6F7'; this.style.boxShadow='none'">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded" style="accent-color: #04c2eb; border-color: #F5F6F7;">
                        <label for="remember-me" class="mr-2 block text-sm text-textDark">
                            تذكرني
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium" style="color: #04c2eb;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                            نسيت كلمة المرور؟
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center btn-primary">
                        تسجيل الدخول
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

