<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
    product: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Head :title="product.name" />

    <AuthenticatedLayout>
        <template #header>
            <div
                class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
            >
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        Detalle del producto
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Información completa del producto.
                    </p>
                </div>

                <div class="flex gap-2">
                    <Link
                        :href="route('products.index')"
                        class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                    >
                        Regresar
                    </Link>

                    <Link
                        :href="route('products.edit', product.id)"
                        class="rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-gray-700"
                    >
                        Editar
                    </Link>
                </div>
            </div>
        </template>

        <div class="py-10">
            <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
                >
                    <div class="grid grid-cols-1 lg:grid-cols-2">
                        <!-- Imagen -->
                        <div class="bg-gray-100">
                            <img
                                v-if="product.photo"
                                :src="product.photo"
                                :alt="product.name"
                                class="h-full min-h-[400px] w-full object-cover"
                            />

                            <div
                                v-else
                                class="flex min-h-[400px] items-center justify-center text-gray-400"
                            >
                                Sin imagen
                            </div>
                        </div>

                        <!-- Información -->
                        <div class="p-6 sm:p-8">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h1
                                        class="text-3xl font-bold text-gray-900"
                                    >
                                        {{ product.name }}
                                    </h1>

                                    <p class="mt-2 text-sm text-gray-500">
                                        ID: {{ product.id }}
                                    </p>
                                </div>

                                <span
                                    class="rounded-full px-3 py-1 text-xs font-semibold"
                                    :class="
                                        product.active
                                            ? 'bg-emerald-100 text-emerald-700'
                                            : 'bg-red-100 text-red-700'
                                    "
                                >
                                    {{ product.active ? "Activo" : "Inactivo" }}
                                </span>
                            </div>

                            <div class="mt-8">
                                <p
                                    class="text-sm font-medium uppercase tracking-wide text-gray-400"
                                >
                                    Descripción
                                </p>

                                <p
                                    class="mt-2 whitespace-pre-line text-base leading-7 text-gray-700"
                                >
                                    {{
                                        product.description ||
                                        "Sin descripción."
                                    }}
                                </p>
                            </div>

                            <div
                                class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2"
                            >
                                <div
                                    class="rounded-xl border border-gray-200 bg-gray-50 p-4"
                                >
                                    <p
                                        class="text-xs font-medium uppercase tracking-wide text-gray-400"
                                    >
                                        Precio
                                    </p>

                                    <p
                                        class="mt-2 text-2xl font-bold text-gray-900"
                                    >
                                        ${{ Number(product.price).toFixed(2) }}
                                    </p>
                                </div>

                                <div
                                    class="rounded-xl border border-gray-200 bg-gray-50 p-4"
                                >
                                    <p
                                        class="text-xs font-medium uppercase tracking-wide text-gray-400"
                                    >
                                        Stock
                                    </p>

                                    <p
                                        class="mt-2 text-2xl font-bold"
                                        :class="
                                            product.stock > 0
                                                ? 'text-gray-900'
                                                : 'text-red-600'
                                        "
                                    >
                                        {{ product.stock }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-8 border-t border-gray-100 pt-6">
                                <dl class="space-y-4">
                                    <div
                                        class="flex flex-col justify-between gap-1 sm:flex-row"
                                    >
                                        <dt
                                            class="text-sm font-medium text-gray-500"
                                        >
                                            Creado
                                        </dt>

                                        <dd class="text-sm text-gray-900">
                                            {{ product.created_at }}
                                        </dd>
                                    </div>

                                    <div
                                        class="flex flex-col justify-between gap-1 sm:flex-row"
                                    >
                                        <dt
                                            class="text-sm font-medium text-gray-500"
                                        >
                                            Última actualización
                                        </dt>

                                        <dd class="text-sm text-gray-900">
                                            {{ product.updated_at }}
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
