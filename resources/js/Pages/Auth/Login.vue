<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="Iniciar sesión" />

    <div class="min-h-screen bg-gray-50 lg:grid lg:grid-cols-2">
        <!-- Panel izquierdo -->
        <div
            class="relative hidden overflow-hidden bg-slate-950 lg:flex lg:flex-col lg:justify-between"
        >
            <!-- Decoración -->
            <div
                class="absolute -left-32 -top-32 h-96 w-96 rounded-full bg-indigo-500/20 blur-3xl"
            ></div>

            <div
                class="absolute -bottom-40 -right-20 h-[500px] w-[500px] rounded-full bg-blue-500/20 blur-3xl"
            ></div>

            <!-- Logo -->
            <div class="relative z-10 p-12">
                <div class="flex items-center gap-3">
                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-600 text-lg font-bold text-white shadow-lg shadow-indigo-600/30"
                    >
                        A
                    </div>

                    <span class="text-xl font-semibold text-white">
                        Admin Panel
                    </span>
                </div>
            </div>

            <!-- Texto -->
            <div class="relative z-10 max-w-xl px-12 pb-16">
                <span
                    class="mb-5 inline-flex rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm text-indigo-200"
                >
                    Plataforma de administración
                </span>

                <h1
                    class="text-4xl font-bold leading-tight tracking-tight text-white xl:text-5xl"
                >
                    Administra todo desde
                    <span class="text-indigo-400"> un solo lugar. </span>
                </h1>

                <p class="mt-6 max-w-lg text-lg leading-8 text-slate-400">
                    Accede a tu cuenta para gestionar la información, productos y
                    configuraciones de tu plataforma.
                </p>
            </div>

            <div class="relative z-10 px-12 pb-8">

            </div>
        </div>

        <!-- Panel derecho -->
        <div
            class="flex min-h-screen items-center justify-center px-6 py-12 sm:px-12"
        >
            <div class="w-full max-w-md">
                <!-- Logo móvil -->
                <div class="mb-10 flex items-center gap-3 lg:hidden">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 font-bold text-white"
                    >
                        A
                    </div>

                    <span class="text-xl font-semibold text-gray-900">
                        Admin Panel
                    </span>
                </div>

                <!-- Encabezado -->
                <div class="mb-8">
                    <p class="mb-2 text-sm font-medium text-indigo-600">
                        BIENVENIDO
                    </p>

                    <h2 class="text-3xl font-bold tracking-tight text-gray-900">
                        Inicia sesión
                    </h2>

                    <p class="mt-3 text-sm text-gray-500">
                        Ingresa tus credenciales para acceder a tu cuenta.
                    </p>
                </div>

                <!-- Status -->
                <div
                    v-if="status"
                    class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700"
                >
                    {{ status }}
                </div>

                <!-- Formulario -->
                <form @submit.prevent="submit" class="space-y-5">
                    <!-- Email -->
                    <div>
                        <label
                            for="email"
                            class="mb-2 block text-sm font-medium text-gray-700"
                        >
                            Correo electrónico
                        </label>

                        <div class="relative">
                            <div
                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4"
                            >
                                <svg
                                    class="h-5 w-5 text-gray-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M16 12H8m0 0 4-4m-4 4 4 4"
                                    />
                                </svg>
                            </div>

                            <input
                                id="email"
                                v-model="form.email"
                                type="email"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="correo@ejemplo.com"
                                class="block w-full rounded-xl border border-gray-200 bg-white py-3 pl-12 pr-4 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                            />
                        </div>

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <!-- Contraseña -->
                    <div>
                        <div class="mb-2 flex items-center justify-between">
                            <label
                                for="password"
                                class="text-sm font-medium text-gray-700"
                            >
                                Contraseña
                            </label>
                        </div>

                        <div class="relative">
                            <div
                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4"
                            >
                                <svg
                                    class="h-5 w-5 text-gray-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                                    />
                                </svg>
                            </div>

                            <input
                                id="password"
                                v-model="form.password"
                                type="password"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                                class="block w-full rounded-xl border border-gray-200 bg-white py-3 pl-12 pr-4 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                            />
                        </div>

                        <InputError
                            class="mt-2"
                            :message="form.errors.password"
                        />
                    </div>

                    <!-- Recordarme -->
                    <div class="flex items-center">
                        <label class="flex cursor-pointer items-center">
                            <Checkbox
                                name="remember"
                                v-model:checked="form.remember"
                            />

                            <span class="ml-2 text-sm text-gray-600">
                                Mantener sesión iniciada
                            </span>
                        </label>
                    </div>

                    <!-- Botón -->
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="flex w-full items-center justify-center rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                    >
                        <svg
                            v-if="form.processing"
                            class="mr-2 h-5 w-5 animate-spin"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"
                            />

                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                            />
                        </svg>

                        {{
                            form.processing ? "Ingresando..." : "Iniciar sesión"
                        }}
                    </button>
                </form>

                <!-- Footer -->
                <p class="mt-10 text-center text-xs text-gray-400">
                    Acceso seguro a la plataforma
                </p>
            </div>
        </div>
    </div>
</template>
