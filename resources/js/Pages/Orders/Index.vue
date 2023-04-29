<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Pagination from "@/Components/Pagination.vue";

const form = useForm({});

const props = defineProps({
    orders: {
        type: Object,
        default: () => ({}),
    },
    total_sales: {
        type: Number,
        default: () => (0),
    },
    avg_sales: {
        type: Number,
        default: () => (0),
    },
});

</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Orders</h2>
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

                    <div>Total of sales for all orders: ${{ Number(total_sales).toLocaleString() }}</div>
                    <div>Average sale total across all orders: ${{ Number(avg_sales).toLocaleString() }}</div>

                    <table
                        class="orders-table w-full text-sm text-left text-gray-500 dark:text-gray-400"
                    >
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                        >
                            <tr>
                                <th>id</th>
                                <th >
                                    Name
                                </th>
                                <th >
                                    Email
                                </th>
                                <th >
                                    Product Name
                                </th>
                                <th >
                                    Color
                                </th>
                                <th >
                                    Size
                                </th>
                                <th>
                                    Order Status
                                </th>
                                <th>
                                    Order Total
                                </th>
                                <th>
                                    Transaction Id
                                </th>
                                <th>
                                    Shipper
                                </th>
                                <th>
                                    Tracking #
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="order in orders.data"
                                :key="order.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                            >
                                <td>{{ order.id }}</td>
                                <td>{{ order.name }}</td>
                                <td>{{ order.email }}</td>
                                <td>{{ order.product_name }}</td>
                                <td>{{ order.color }}</td>
                                <td>{{ order.size }}</td>
                                <td>{{ order.order_status }}</td>
                                <td>${{ Number(order.total_cents / 100).toLocaleString(undefined, {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2,
                                }) }}</td>
                                <td>{{ order.transaction_id }}</td>
                                <td>{{ order.shipper_name }}</td>
                                <td>{{ order.tracking_number }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div>
                        <Pagination :links="orders.links" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style>
.orders-table th, .orders-table td {
    padding: 5px;
}
</style>
