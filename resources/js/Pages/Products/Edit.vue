<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    product: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    id: props.product.id,
    product_name: props.product.product_name,
    description: props.product.description,
    style: props.product.style,
    brand: props.product.brand,
    url: props.product.url,
    product_type: props.product.product_type,
    shipping_price: Number(props.product.shipping_price / 100).toFixed(2),
    note: props.product.note,
});

const submit = () => {
    form.shipping_price = form.shipping_price * 100;
    if (props.product.id) {
        form.put(route("products.update", props.product.id));
    } else {
        form.post(route("products.store"));
    }
};

</script>

<template>
    <Head title="Product Edit" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Product Edit</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-12 sm:p-8 bg-white shadow sm:rounded-lg">
                    <pre>
                    {{ props.product }}
                    </pre>
                    <form @submit.prevent="submit">
                            <div class="mb-6">
                                <label
                                    for="product_name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                    >Name</label
                                >
                                <input
                                    type="text"
                                    v-model="form.product_name"
                                    name="product_name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder=""
                                />
                                <div
                                    v-if="form.errors.product_name"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.product_name }}
                                </div>
                            </div>
                            <div class="mb-6">
                                <label
                                    for="description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                    >description</label
                                >
                                <textarea
                                    type="text"
                                    v-model="form.description"
                                    name="description"
                                    id=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                ></textarea>

                                <div
                                    v-if="form.errors.description"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.description }}
                                </div>
                            </div>
                            <div class="mb-6">
                                <label
                                    for="style"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                    >style</label
                                >
                                <textarea
                                    type="text"
                                    v-model="form.style"
                                    name="style"
                                    id=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                ></textarea>

                                <div
                                    v-if="form.errors.style"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.style }}
                                </div>
                            </div>
                            <div class="mb-6">
                                <label
                                    for="brand"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                    >brand</label
                                >
                                <textarea
                                    type="text"
                                    v-model="form.brand"
                                    name="brand"
                                    id=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                ></textarea>

                                <div
                                    v-if="form.errors.brand"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.brand }}
                                </div>
                            </div>
                            <div class="mb-6">
                                <label
                                    for="url"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                    >url</label
                                >
                                <input
                                    type="text"
                                    v-model="form.url"
                                    name="url"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder=""
                                />
                                <div
                                    v-if="form.errors.url"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.url }}
                                </div>
                            </div>
                            <div class="mb-6">
                                <label
                                    for="product_type"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                    >product_type</label
                                >
                                <input
                                    type="text"
                                    v-model="form.product_type"
                                    name="product_type"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder=""
                                />
                                <div
                                    v-if="form.errors.product_type"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.product_type }}
                                </div>
                            </div>
                            <div class="mb-6">
                                <label
                                    for="shipping_price"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                    >shipping_price</label
                                >
                                <input
                                    type="text"
                                    v-model="form.shipping_price"
                                    name="shipping_price"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder=""
                                />
                                <div
                                    v-if="form.errors.shipping_price"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.shipping_price }}
                                </div>
                            </div>
                            <div class="mb-6">
                                <label
                                    for="note"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                    >note</label
                                >
                                <textarea
                                    type="text"
                                    v-model="form.note"
                                    name="note"
                                    id=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                ></textarea>

                                <div
                                    v-if="form.errors.note"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.note }}
                                </div>
                            </div>
                            <button
                                type="submit"
                                class="text-white bg-blue-700  focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 "
                                :disabled="form.processing"
                                :class="{ 'opacity-25': form.processing }"
                            >
                                Submit
                            </button>
                        </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
