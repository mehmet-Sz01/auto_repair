<template>
    <div>
        <DataTableComponent
            :initialItems="works"
            :columns="workColumns"
            :dialogFields="workDialogFields"
            :onItemSaved="handleItemSaved"
            :onItemDeleted="handleItemDeleted"
        />
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import DataTableComponent from '../DataTable/DataTableComponent.vue';
import axios from 'axios';

const works = ref([]);
const workColumns = [
    {field: 'work_title', header: 'Work Title', style: 'min-width:10rem'},
    {field: 'car_id', header: 'Car ID', style: 'min-width:10rem'},
    {field: 'worker_id', header: 'Worker ID', style: 'min-width:10rem'},
    {field: 'description', header: 'Description', style: 'min-width:10rem'},
    {field: 'price', header: 'Price', style: 'min-width:10rem'},
];
const workDialogFields = [
    {id: 'title', label: 'Work Title', model: 'work_title'},
    {id: 'car', label: 'Car ID', model: 'car_id'},
    {id: 'worker', label: 'Worker ID', model: 'worker_id'},
    {id: 'description', label: 'Description', model: 'description'},
    {id: 'price', label: 'Price', model: 'price'},
];

// İş verilerini al
const fetchWorks = async () => {
    try {
        const response = await axios.get('/api/works');
        works.value = response.data;
    } catch (error) {
        console.error("İş verilerini çekerken hata oluştu:", error);
    }
};

// Yeni kayıt işlemi
const handleItemSaved = async (savedItem) => {
    try {
        if (savedItem.id) {
            // Güncelleme işlemi
            await axios.put(`/api/works/${savedItem.id}`, savedItem);
        } else {
            // Yeni kayıt işlemi
            await axios.post('/api/works', savedItem);
        }
        fetchWorks(); // Kayıt işlemi sonrası güncelleme
    } catch (error) {
        console.error("Kayıt işlemi sırasında hata oluştu:", error);
    }
};

// Silme işlemi
const handleItemDeleted = async (deletedItem) => {
    try {
        await axios.delete(`/api/works/${deletedItem.id}`);
        fetchWorks(); // Silme işlemi sonrası güncelleme
    } catch (error) {
        console.error("Silme işlemi sırasında hata oluştu:", error);
    }
};

onMounted(() => {
    fetchWorks();
});
</script>
