<template>
    <div>
        <DataTableComponent
            :initialItems="customers.items"
            :columns="customerColumns"
            :dialogFields="customerDialogFields"
            :onItemSaved="handleItemSaved"
            :onItemDeleted="handleItemDeleted"
            :isDeleteSection="true"
            :isEditSection="true"
        />
    </div>
</template>

<script setup>
import {onMounted, reactive} from 'vue';
import DataTableComponent from '../DataTable/DataTableComponent.vue';
import axios from 'axios';

const customers = reactive({items:[]});
const customerColumns = [
    {field: 'first_name', header: 'Name', style: 'min-width:6rem'},
    {field: 'last_name', header: 'Surname', style: 'min-width:6rem'},
    {field: 'email', header: 'Email', style: 'min-width:6rem'},
    {field: 'number', header: 'Number', style: 'min-width:6rem'},
];
const customerDialogFields = [
    {id: 'name', label: 'Name', model: 'first_name'},
    {id: 'lastname', label: 'Surname', model: 'last_name'},
    {id: 'email', label: 'Email', model: 'email'},
    {id: 'number', label: 'Number', model: 'number'},
];

// Müşteri verilerini al
const fetchCustomers = async () => {
    try {
        const response = await axios.get('/api/customers');
        customers.items = response.data;
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
        await fetchCustomers(); // Kayıt işlemi sonrası güncelleme
    } catch (error) {
        console.error("Kayıt işlemi sırasında hata oluştu:", error);
    }
};

// Silme işlemi
const handleItemDeleted = async (deletedItem) => {
    try {
        await axios.delete(`/api/customers/${deletedItem.id}`);
        await fetchCustomers(); // Silme işlemi sonrası güncelleme
    } catch (error) {
        console.error("Silme işlemi sırasında hata oluştu:", error);
    }
};

onMounted(async () => {
    await fetchCustomers();
});
</script>
