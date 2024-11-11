<template>
    <div>
        <DataTableComponent
            :initialItems="workers.items"
            :columns="workerColumns"
            :dialogFields="workerDialogFields"
            :onItemSaved="handleItemSaved"
            :onItemDeleted="handleItemDeleted"
            :newButtonSection="true"
            :isDeleteSection="true"
            :isEditSection="true"
        />
    </div>
</template>

<script setup>
import { onMounted, reactive} from 'vue';
import DataTableComponent from '../DataTable/DataTableComponent.vue';
import axios from 'axios';

const workers = reactive({items:[]});

const workerColumns = [
    { field: 'id', header: 'ID', style: 'min-width:6rem' },
    { field: 'worker_name', header: 'Name', style: 'min-width:6rem' },
    { field: 'worker_lastname', header: 'Surname', style: 'min-width:6rem' },
    { field: 'number', header: 'Number', style: 'min-width:6rem' },
    { field: 'wage', header: 'Wage', style: 'min-width:6rem' },
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
        workers.items = response.data;
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
        await fetchWorkers(); // Kayıt işlemi sonrası güncelleme
    } catch (error) {
        console.error("Kayıt işlemi sırasında hata oluştu:", error);
    }
};

// Silme işlemi
const handleItemDeleted = async (deletedItem) => {
    try {
        await axios.delete(`/api/workers/${deletedItem.id}`);
        await fetchWorkers(); // Silme işlemi sonrası güncelleme
    } catch (error) {
        console.error("Silme işlemi sırasında hata oluştu:", error);
    }
};

onMounted(async () => {
    await fetchWorkers();
});
</script>
