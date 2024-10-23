<template>
    <div>
        <DataTableComponent
            :initialItems="customers"
            :columns="customerColumns"
            :dialogFields="customerDialogFields"
            :onItemSaved="handleItemSaved"
            :onItemDeleted="handleItemDeleted"
        />
    </div>
</template>

<script setup>
import {ref, onMounted} from 'vue';
import DataTableComponent from '../DataTable/DataTableComponent.vue';
import axios from 'axios';

const customers = ref([]);
const customerColumns = [
    {field: 'customer_name', header: 'Name', style: 'min-width:10rem'},
    {field: 'customer_lastname', header: 'Surname', style: 'min-width:10rem'},
    {field: 'email', header: 'Email', style: 'min-width:10rem'},
    {field: 'phone', header: 'Phone', style: 'min-width:10rem'},
];
const customerDialogFields = [
    {id: 'name', label: 'Name', model: 'customer_name'},
    {id: 'lastname', label: 'Surname', model: 'customer_lastname'},
    {id: 'email', label: 'Email', model: 'email'},
    {id: 'phone', label: 'Phone', model: 'phone'},
];

// Müşteri verilerini al
const fetchCustomers = async () => {
    try {
        const response = await axios.get('/api/customers');
        customers.value = response.data;
    } catch (error) {
        console.error("Müşterileri çekerken hata oluştu:", error);
    }
};

// Yeni kayıt işlemi
const handleItemSaved = async (savedItem) => {
    try {
        if (savedItem.id) {
            // Güncelleme işlemi
            await axios.put(`/api/customers/${savedItem.id}`, savedItem);
        } else {
            // Yeni kayıt işlemi
            await axios.post('/api/customers', savedItem);
        }
        fetchCustomers(); // Kayıt işlemi sonrası güncelleme
    } catch (error) {
        console.error("Kayıt işlemi sırasında hata oluştu:", error);
    }
};

// Silme işlemi
const handleItemDeleted = async (deletedItem) => {
    try {
        await axios.delete(`/api/customers/${deletedItem.id}`);
        fetchCustomers(); // Silme işlemi sonrası güncelleme
    } catch (error) {
        console.error("Silme işlemi sırasında hata oluştu:", error);
    }
};

onMounted(() => {
    fetchCustomers();
});
</script>
