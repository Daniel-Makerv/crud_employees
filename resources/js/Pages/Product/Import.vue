<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    file: null,
});

const submit = () => {
    form.post(route("products.import.store"), {
        forceFormData: true,
    });
};
</script>

<template>
    <Head title="Importar productos" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        Importar productos
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Carga un archivo Excel para registrar productos.
                    </p>
                </div>

                <Link
                    :href="route('products.index')"
                    class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50"
                >
                    Regresar
                </Link>
            </div>
        </template>

        <div class="py-10">
            <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
                <div
                    class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"
                >
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">
                            Archivo de productos
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Utiliza nuestra plantilla para evitar errores de
                            formato.
                        </p>
                    </div>

                    <a
                        :href="route('products.import.template')"
                        class="inline-flex items-center justify-center rounded-lg border border-indigo-600 bg-white px-4 py-2.5 text-sm font-semibold text-indigo-700 transition hover:bg-indigo-50"
                    >
                        Descargar plantilla
                    </a>
                </div>
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm"
                >
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700"
                            >
                                Archivo Excel
                            </label>

                            <input
                                type="file"
                                accept=".xlsx,.xls,.csv"
                                @change="form.file = $event.target.files[0]"
                                class="mt-2 block w-full rounded-lg border border-gray-300 p-3 text-sm"
                            />

                            <p
                                v-if="form.errors.file"
                                class="mt-2 text-sm text-red-600"
                            >
                                {{ form.errors.file }}
                            </p>
                        </div>

                        <div
                            class="rounded-lg bg-gray-50 p-4 text-sm text-gray-600"
                        >
                            <p class="font-semibold text-gray-800">
                                Columnas del archivo:
                            </p>

                            <p class="mt-2">
                                Nombre, Descripción, Precio, Stock, Estado, Foto
                            </p>

                            <p class="mt-3 text-xs text-gray-500">
                                En la columna Estado utiliza
                                <span class="font-semibold text-gray-700"
                                    >Activo</span
                                >
                                o
                                <span class="font-semibold text-gray-700"
                                    >Inactivo</span
                                >.
                            </p>
                        </div>

                        <div class="flex justify-end">
                            <button
                                type="submit"
                                :disabled="form.processing || !form.file"
                                class="rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700 disabled:opacity-50"
                            >
                                {{
                                    form.processing
                                        ? "Importando..."
                                        : "Importar productos"
                                }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
