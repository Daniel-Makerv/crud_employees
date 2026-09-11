<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
defineProps({
    products: {
        type: Object,
        required: true,
    },
});

const deleteProduct = (product) => {
    if (confirm(`¿Estás seguro de eliminar "${product.name}"?`)) {
        router.delete(route("products.destroy", product.id));
    }
};
</script>

<template>
    <Head title="Productos" />

    <AuthenticatedLayout>
        <template #header>
            <div
                class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
            >
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Productos</h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Administra los productos registrados.
                    </p>
                </div>

                <Link
                    :href="route('products.create')"
                    class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Nuevo producto
                </Link>
            </div>
        </template>

        <div class="py-10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div
                    v-if="products.data.length"
                    class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
                >
                    <article
                        v-for="product in products.data"
                        :key="product.id"
                        class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg"
                    >
                        <div class="aspect-[4/3] overflow-hidden bg-gray-100">
                            <img
                                :src="product.photo"
                                :alt="product.name"
                                class="h-full w-full object-cover transition duration-300 hover:scale-105"
                            />
                        </div>

                        <div class="p-5">
                            <div class="flex items-start justify-between gap-3">
                                <h3
                                    class="line-clamp-2 text-lg font-bold text-gray-900"
                                >
                                    {{ product.name }}
                                </h3>

                                <span
                                    class="shrink-0 rounded-full px-2.5 py-1 text-xs font-semibold"
                                    :class="
                                        product.active
                                            ? 'bg-emerald-100 text-emerald-700'
                                            : 'bg-red-100 text-red-700'
                                    "
                                >
                                    {{ product.active ? "Activo" : "Inactivo" }}
                                </span>
                            </div>

                            <p
                                class="mt-3 line-clamp-2 text-sm leading-6 text-gray-500"
                            >
                                {{ product.description }}
                            </p>

                            <div class="mt-5 flex items-end justify-between">
                                <div>
                                    <p
                                        class="text-xs font-medium uppercase tracking-wide text-gray-400"
                                    >
                                        Precio
                                    </p>

                                    <p
                                        class="mt-1 text-2xl font-bold text-gray-900"
                                    >
                                        ${{ Number(product.price).toFixed(2) }}
                                    </p>
                                </div>

                                <div class="text-right">
                                    <p
                                        class="text-xs font-medium uppercase tracking-wide text-gray-400"
                                    >
                                        Stock
                                    </p>

                                    <p
                                        class="mt-1 text-sm font-semibold"
                                        :class="
                                            product.stock > 0
                                                ? 'text-gray-700'
                                                : 'text-red-600'
                                        "
                                    >
                                        {{ product.stock }}
                                    </p>
                                </div>
                            </div>

                            <div
                                class="mt-6 flex gap-2 border-t border-gray-100 pt-4"
                            >
                                <Link
                                    :href="route('products.edit', product.id)"
                                    class="flex-1 rounded-lg bg-gray-900 px-4 py-2.5 text-center text-sm font-semibold text-white transition hover:bg-gray-700"
                                >
                                    Editar
                                </Link>

                                <Link
                                    :href="route('products.show', product.id)"
                                    class="flex-1 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-center text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                                >
                                    Ver
                                </Link>

                                <button
                                    type="button"
                                    @click="deleteProduct(product)"
                                    class="flex-1 rounded-lg bg-red-600 px-4 py-2.5 text-center text-sm font-semibold text-white transition hover:bg-red-700"
                                >
                                    Eliminar
                                </button>
                            </div>
                        </div>
                    </article>
                </div>

                <div
                    v-else
                    class="rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-16 text-center"
                >
                    <h3 class="text-lg font-semibold text-gray-900">
                        No hay productos
                    </h3>

                    <p class="mt-2 text-sm text-gray-500">
                        Comienza agregando tu primer producto.
                    </p>

                    <Link
                        :href="route('products.create')"
                        class="mt-6 inline-flex rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700"
                    >
                        Crear producto
                    </Link>
                </div>
                <!-- PAGINADOR -->
                <div
                    v-if="products.last_page > 1"
                    class="mt-8 flex flex-col items-center justify-between gap-4 sm:flex-row"
                >
                    <p class="text-sm text-gray-500">
                        Mostrando
                        <span class="font-medium text-gray-700">
                            {{ products.from }}
                        </span>
                        a
                        <span class="font-medium text-gray-700">
                            {{ products.to }}
                        </span>
                        de
                        <span class="font-medium text-gray-700">
                            {{ products.total }}
                        </span>
                        productos
                    </p>

                    <div
                        class="flex flex-wrap items-center justify-center gap-1"
                    >
                        <template
                            v-for="(link, index) in products.links"
                            :key="index"
                        >
                            <span
                                v-if="!link.url"
                                v-html="link.label"
                                class="cursor-not-allowed rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-400"
                            />

                            <Link
                                v-else
                                :href="link.url"
                                preserve-scroll
                                class="rounded-lg border px-3 py-2 text-sm font-medium transition"
                                :class="
                                    link.active
                                        ? 'border-indigo-600 bg-indigo-600 text-white'
                                        : 'border-gray-300 bg-white text-gray-700 hover:bg-gray-50'
                                "
                                v-html="link.label"
                            />
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
