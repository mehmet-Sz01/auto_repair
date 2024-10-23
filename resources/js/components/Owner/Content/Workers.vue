<template>
    <div>
        <DataTableComponent
            :initialItems="workers"
            :columns="workerColumns"
            :dialogFields="workerDialogFields"
            :onItemSaved="handleItemSaved"
            :onItemDeleted="handleItemDeleted"
        />
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import DataTableComponent from '../DataTable/DataTableComponent.vue';
import axios from 'axios';

const workers = ref([]);
const workerColumns = [
    { field: 'worker_name', header: 'Name', style: 'min-width:10rem' },
    { field: 'worker_lastname', header: 'Surname', style: 'min-width:10rem' },
    { field: 'number', header: 'Number', style: 'min-width:10rem' },
    { field: 'wage', header: 'Wage', style: 'min-width:10rem' },
];
const workerDialogFields = [
    { id: 'name', label: 'Name', model: 'worker_name' },
    { id: 'lastname', label: 'Surname', model: 'worker_lastname' },
    { id: 'number', label: 'Number', model: 'number' },
    { id: 'wage', label: 'Wage', model: 'wage' },
];

// İşçi verilerini al
const fetchWorkers = async () => {
    try {
        const response = await axios.get('/api/workers');
        workers.value = response.data;
    } catch (error) {
        console.error("İşçileri çekerken hata oluştu:", error);
    }
};

// Yeni kayıt işlemi
const handleItemSaved = async (savedItem) => {
    try {
        if (savedItem.id) {
            // Güncelleme işlemi
            await axios.put(`/api/workers/${savedItem.id}`, savedItem);
        } else {
            // Yeni kayıt ekleme
            await axios.post('/api/workers', savedItem);
        }
        fetchWorkers(); // Kayıt işlemi sonrası güncelleme
    } catch (error) {
        console.error("Kayıt işlemi sırasında hata oluştu:", error);
    }
};

// Silme işlemi
const handleItemDeleted = async (deletedItem) => {
    try {
        await axios.delete(`/api/workers/${deletedItem.id}`);
        fetchWorkers(); // Silme işlemi sonrası güncelleme
    } catch (error) {
        console.error("Silme işlemi sırasında hata oluştu:", error);
    }
};

onMounted(() => {
    fetchWorkers();
});
</script>
