<template>
    <div>
        <DataTableComponent
            :initialItems="workers.items"
            :columns="workerColumns"
            :dialogFields="workerDialogFields"
            :infoDialogFields="workerInfoDialog"
            :onItemSaved="handleItemSaved"
            :onItemDeleted="handleItemDeleted"
        />
    </div>
</template>

<script setup>
import { onMounted, reactive} from 'vue';
import DataTableComponent from '../DataTable/DataTableComponent.vue';
import axios from 'axios';

const workers = reactive({items:[]});

const workerColumns = [
    { field: 'id', header: 'ID', style: 'min-width:10rem' },
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

const workerInfoDialog = reactive([
    { id: 'name', label: 'Name', model: 'worker_name' },
    { id: 'lastname', label: 'Surname', model: 'worker_lastname' },
    { id: 'number', label: 'Number', model: 'number' },
    { id: 'wage', label: 'Wage', model: 'wage' },
    { id: 'title', label: 'Work Title', model: 'work_title' },
    { id: 'car', label: 'Car ID', model: 'car_id' },
    { id: 'worker', label: 'Worker ID', model: 'worker_id' },
    { id: 'description', label: 'Description', model: 'description' },
    { id: 'price', label: 'Price', model: 'price' },
]);



// İşçi verilerini al
const fetchWorkers = async () => {
    try {
        const response = await axios.get('/api/workers'); // İşçileri ve ilişkili işleri al
        workers.items = response.data.map(worker => {
            // İşçi verisi ve ilişkili işler burada kullanılabilir
            if (worker.works.length > 0) {
                const work = worker.works[0]; // Örnek olarak ilk işi alıyoruz
                return {
                    ...worker,
                    work_title: work.title, // 'title' alanı, veritabanında yer alan işin başlığı
                    car_id: work.car_id, // 'car_id', veritabanındaki ilgili alan
                    worker_id: work.worker_id, // 'worker_id'
                    description: work.description, // İşin açıklaması
                    price: work.price // İşin fiyatı
                };
            }
            return worker;
        });
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
