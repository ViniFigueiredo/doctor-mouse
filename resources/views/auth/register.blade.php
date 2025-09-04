@extends('layouts.base')

@section("head")
@endsection

@section("contents")
    <div class="w-full h-full flex justify-center items-center">
        <div class="w-1/2 h-1/2 border rounded p-10">
            <div>
                <div class="flex items-start gap-x-5">
                    <img src="/login/logo.png" alt="Doctor Mouse" class="w-20">
                    <div>
                        <span class="text-primary font-bold text-3xl">Doctor Mouse</span>
                    </div>
                </div>
                
                <span>Gaming Store</span>
            </div>
            <form method="POST" action="{{ route("signup") }}">
                @csrf

                    <label for="name">Nome completo <span class="text-red-500">*</span></label>
                <div class="p-2 rounded border">
                    <span><i class="fa fa-user"></i></span>
                    <input class="p-0 border-none w-[95%] ml-2 outline-none focus:outline-none focus:ring-0 focus:border-transparent" type="text" id="name" name="name" placeholder="Nome completo" required>
                </div>
                    <label for="phone">Telefone <span class="text-gray-400 text-sm">(opcional)</span></label>
                <div class="p-2 rounded border">
                    <span><i class="fa fa-phone"></i></span>
                    <input class="p-0 border-none w-[95%] ml-2 outline-none focus:outline-none focus:ring-0 focus:border-transparent" type="text" id="phone" name="phone" placeholder="(99) 99999-9999">
                </div>
                    <label for="email">E-mail <span class="text-red-500">*</span></label>
                <div class="p-2 rounded border">
                    <span><i class="fa fa-envelope"></i></span>
                    <input class="p-0 border-none w-[95%] ml-2 outline-none focus:outline-none focus:ring-0 focus:border-transparent" type="email" id="email" name="email" placeholder="E-mail" required>
                </div>
                    <label for="cpf">CPF <span class="text-red-500">*</span></label>
                <div class="p-2 rounded border">
                    <span><i class="fa fa-id-card"></i></span>
                    <input class="p-0 border-none w-[95%] ml-2 outline-none focus:outline-none focus:ring-0 focus:border-transparent" type="text" id="cpf" name="cpf" placeholder="000.000.000-00" required>
                </div>
                    <label for="password">Senha <span class="text-red-500">*</span></label>
                <div class="p-2 rounded border">
                    <span><i class="fa fa-lock"></i></span>
                    <input class="p-0 border-none w-[95%] ml-2 outline-none focus:outline-none focus:ring-0 focus:border-transparent" type="password" id="password" name="password" placeholder="Senha" required>
                </div>
                    <label for="password_confirmation">Confirmar Senha <span class="text-red-500">*</span></label>
                <div class="p-2 rounded border">
                    <span><i class="fa fa-lock"></i></span>
                    <input class="p-0 border-none w-[95%] ml-2 outline-none focus:outline-none focus:ring-0 focus:border-transparent" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmar senha" required>
                </div>
                <div class="flex gap-1 mt-2">
                        <a href="/" class="bg-red-600 text-white flex-1 text-center no-underline rounded px-0 py-2 font-bold">CANCELAR</a>
                        <button type="submit" class="bg-primary text-white flex-1 rounded px-0 py-2 font-bold">Criar conta</button>
                </div>
            </form>
        </div>
    </div>
@endsection
