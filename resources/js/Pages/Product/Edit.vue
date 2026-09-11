<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    product: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    name: props.product.name,
    description: props.product.description ?? "",
    price: props.product.price,
    stock: props.product.stock,
    photo: props.product.photo ?? "",
    active: Boolean(props.product.active),
});

const submit = () => {
    form.put(route("products.update", props.product.id));
};
</script>

<template>
    <Head title="Editar producto" />

    <AuthenticatedLayout>
        <template #header>
            <div
                class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
            >
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        Editar producto
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Modifica la información del producto.
                    </p>
                </div>

                <Link
                    :href="route('products.index')"
                    class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                >
                    Regresar
                </Link>
            </div>
        </template>

        <div class="py-10">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8"
                >
                    <form @submit.prevent="submit" class="space-y-6">
                        <!-- Nombre -->
                        <div>
                            <label
                                for="name"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                Nombre
                            </label>

                            <input
                                id="name"
                                v-model="form.name"
                                type="text"
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            />

                            <p
                                v-if="form.errors.name"
                                class="mt-2 text-sm text-red-600"
                            >
                                {{ form.errors.name }}
                            </p>
                        </div>

                        <!-- Descripción -->
                        <div>
                            <label
                                for="description"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                Descripción
                            </label>

                            <textarea
                                id="description"
                                v-model="form.description"
                                rows="4"
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            ></textarea>

                            <p
                                v-if="form.errors.description"
                                class="mt-2 text-sm text-red-600"
                            >
                                {{ form.errors.description }}
                            </p>
                        </div>

                        <!-- Precio / Stock -->
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label
                                    for="price"
                                    class="block text-sm font-semibold text-gray-700"
                                >
                                    Precio
                                </label>

                                <input
                                    id="price"
                                    v-model="form.price"
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                />

                                <p
                                    v-if="form.errors.price"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ form.errors.price }}
                                </p>
                            </div>

                            <div>
                                <label
                                    for="stock"
                                    class="block text-sm font-semibold text-gray-700"
                                >
                                    Stock
                                </label>

                                <input
                                    id="stock"
                                    v-model="form.stock"
                                    type="number"
                                    min="0"
                                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                />

                                <p
                                    v-if="form.errors.stock"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ form.errors.stock }}
                                </p>
                            </div>
                        </div>

                        <!-- Foto -->
                        <div>
                            <label
                                for="photo"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                URL de la foto
                            </label>

                            <input
                                id="photo"
                                v-model="form.photo"
                                type="url"
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="https://..."
                            />

                            <p
                                v-if="form.errors.photo"
                                class="mt-2 text-sm text-red-600"
                            >
                                {{ form.errors.photo }}
                            </p>

                            <div
                                v-if="form.photo"
                                class="mt-4 overflow-hidden rounded-xl border border-gray-200"
                            >
                                <img
                                    :src="form.photo"
                                    :alt="form.name"
                                    class="h-64 w-full object-cover"
                                />
                            </div>
                        </div>

                        <!-- Estado -->
                        <div class="flex items-center gap-3">
                            <input
                                id="active"
                                v-model="form.active"
                                type="checkbox"
                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                            />

                            <label
                                for="active"
                                class="text-sm font-medium text-gray-700"
                            >
                                Producto activo
                            </label>
                        </div>

                        <!-- Acciones -->
                        <div
                            class="flex justify-end gap-3 border-t border-gray-100 pt-6"
                        >
                            <Link
                                :href="route('products.index')"
                                class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                            >
                                Cancelar
                            </Link>

                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700 disabled:cursor-not-allowed disabled:opacity-50"
                            >
                                {{
                                    form.processing
                                        ? "Guardando..."
                                        : "Guardar cambios"
                                }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
