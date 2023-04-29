<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";




const form = useForm({});

const props = defineProps({
    products: {
        type: Object,
        default: () => ({}),
    },
});



function destroy(id) {
    if (confirm("Are you sure you want to Delete: " + id)) {
        form.delete(route('products.destroy', id));
    }
}


</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Products</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

                <div
                    v-if="$page.props.flash && $page.props.flash.message"
                    class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                    role="alert"
                >
                    <span class="font-medium">
                        {{ $page.props.flash.message }}
                    </span>
                </div>

                <div class="p-12 sm:p-8 bg-white shadow sm:rounded-lg">

                    <table
                        class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                    >
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                        >
                            <tr>
                                <th scope="col" class="px-6 py-3">#</th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Style
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Brand
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    SKUs
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Revenue
                                </th>
                                <th scope="col" class="px-6 py-3">

                                </th>
                                <th scope="col" class="px-6     ">

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="product in products.data"
                                :key="product.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                            >
                                <th
                                    scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                >
                                    {{ product.id }}
                                </th>
                                <th
                                    scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                >
                                    {{ product.product_name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ product.style }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ product.brand }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ product.skus }}
                                </td>
                                <td class="px-6 py-4">
                                    ${{ Number(product.revenue).toFixed(2) }}
                                </td>
                                <td class="px-6 py-4">
                                    <Link
                                        :href="
                                            route(
                                                'products.edit',
                                                product.id
                                            )
                                        "
                                        class="px-4 py-2 text-white bg-blue-600 rounded-lg" >Edit</Link
                                    >
                                    </td>
                                <td class="px-6 py-4">
                                    <PrimaryButton
                                        class="bg-red-700"
                                        @click="destroy(product.id)"
                                    >
                                        Delete
                                    </PrimaryButton>

                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
