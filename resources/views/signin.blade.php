@extends('layouts.base')

@section('title', 'Doctor Mouse - Login')

@section('contents')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <div class="flex items-center justify-center gap-3 mb-6">
                <img src="/login/logo.png" alt="Doctor Mouse" class="w-12 h-12">
                <div class="flex flex-col leading-tight">
                    <span class="font-bold text-2xl text-primary">Doctor Mouse</span>
                    <span class="text-gray-500 text-sm -mt-1">Gaming Store</span>
                </div>
            </div>
            <h2 class="text-3xl font-bold text-gray-900">Entrar na sua conta</h2>
        </div>

        @if(session('status'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md text-center">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/signin" class="mt-8 space-y-6">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" 
                               placeholder="usuario@email.com" required
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Senha</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="password" name="password" required
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary">
                    </div>
                </div>
            </div>

            <div>
                <button type="submit" 
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition duration-150 ease-in-out">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i class="fas fa-sign-in-alt text-primary-light group-hover:text-white"></i>
                    </span>
                    ENTRAR
                </button>
            </div>

            <div class="text-center space-y-2">
                <a href="/recuperar-senha" class="text-sm text-primary hover:text-primary-dark transition duration-150 ease-in-out">
                    Recuperar Senha?
                </a>
                <div class="text-gray-500">ou</div>
                <a href="/register" class="text-sm text-primary hover:text-primary-dark transition duration-150 ease-in-out">
                    Criar Conta
                </a>
            </div>
        </form>
    </div>
</div>
@endsection