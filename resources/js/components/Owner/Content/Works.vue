<template>
    <div>
        <DataTableComponent
            :initialItems="works.items"
            :columns="workColumns"
            :dialogFields="workDialogFields"
            :onItemSaved="handleItemSaved"
            :onItemDeleted="handleItemDeleted"
            :infoDialogFields="workInfoDialog"
            :isWorkSection="true"
            :isDeleteSection="true"
            :isEditSection="true"
        />
    </div>
</template>

<script setup>
import { onMounted, reactive } from 'vue';
import DataTableComponent from '../DataTable/DataTableComponent.vue';
import axios from 'axios';

const works = reactive({ items: [] });
const workColumns = [
    { field: 'work_title', header: 'Work Title', style: 'min-width:6rem' },
    { field: 'car_id', header: 'Car ID', style: 'min-width:6rem' },
    { field: 'worker_id', header: 'Worker ID', style: 'min-width:6rem' },
    { field: 'description', header: 'Description', style: 'min-width:6rem' },
    { field: 'price', header: 'Price', style: 'min-width:6rem' },
    { field: 'customer_id', header: 'Customer ID', style: 'min-width:6rem' },
];

const workDialogFields = [
    { id: 'title', label: 'Work Title', model: 'work_title' },
    { id: 'car', label: 'Car ID', model: 'car_id' },
    { id: 'worker', label: 'Worker ID', model: 'worker_id' },
    { id: 'description', label: 'Description', model: 'description' },
    { id: 'price', label: 'Price', model: 'price' },
    { id: 'customer', label: 'Customer ID', model: 'customer_id' },
];

const workInfoDialog = reactive([
    // İş bilgileri
    { id: 'title', label: 'Work Title', model: 'work_title' },
    { id: 'description', label: 'Description', model: 'description' },
    { id: 'price', label: 'Price', model: 'price' },
    // Araç bilgileri
    { id: 'plate', label: 'Plate', model: 'plate' },
    { id: 'brand', label: 'Brand', model: 'brand' },
    { id: 'model', label: 'Model', model: 'model' },
    { id: 'color', label: 'Color', model: 'color' },
    { id: 'year', label: 'Year', model: 'year' },
    { id: 'maintenance_date', label: 'Maintenance Date', model: 'maintenance_date' },
    { id: 'inspection_date', label: 'Inspection Date', model: 'inspection_date' },
    // Müşteri bilgileri
    { id: 'name', label: 'Customer Name', model: 'first_name' },
    { id: 'lastname', label: 'Customer Surname', model: 'last_name' },
    // İşçi bilgileri
    { id: 'worker_name', label: 'Worker Name', model: 'worker_name' },
    { id: 'worker_lastname', label: 'Worker Surname', model: 'worker_lastname' },
]);

// İş verilerini al
const fetchWorks = async () => {
    try {
        const response = await axios.get('/api/works');
        works.items = response.data.map(work => {
            const car = work.car || {};
            const customer = work.customer || {};
            const worker = work.worker || {};
            return {
                ...work,
                work_title: work.work_title,
                description: work.description,
                price: work.price,
                plate: car.plate,
                brand: car.brand,
                model: car.model,
                color: car.color,
                year: car.year,
                maintenance_date: car.maintenance_date,
                inspection_date: car.inspection_date,
                first_name: customer.first_name,
                last_name: customer.last_name,
                worker_name: worker.worker_name,
                worker_lastname: worker.worker_lastname,
            };
        });
    } catch (error) {
        console.error("İşleri çekerken hata oluştu:", error);
    }
};

// Yeni kayıt işlemi
const handleItemSaved = async (savedItem) => {
    try {
        if (savedItem.id) {
            await axios.put(`/api/works/${savedItem.id}`, savedItem);
        } else {
            await axios.post('/api/works', savedItem);
        }
        await fetchWorks();
    } catch (error) {
        console.error("Kayıt işlemi sırasında hata oluştu:", error);
    }
};

// Silme işlemi
const handleItemDeleted = async (deletedItem) => {
    try {
        await axios.delete(`/api/works/${deletedItem.id}`);
        await fetchWorks();
    } catch (error) {
        console.error("Silme işlemi sırasında hata oluştu:", error);
    }
};

onMounted(async () => {
    await fetchWorks();
});
</script>
