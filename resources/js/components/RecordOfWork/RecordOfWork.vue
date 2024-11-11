<template>
    <div class="flex min-h-screen">
        <Sidebar /> <!-- Sidebar bileşenini burada kullanıyoruz -->
        <div class="flex flex-1 flex-col">
            <Header /> <!-- Header bileşeniniz burada olacak -->
            <div class="px-4 md:px-8 lg:px-16"> <!-- Sağdan ve soldan boşluk ekliyoruz -->
                <MultiStepForm/>
            </div>
        </div>
    </div>

</template>

<script>
import Sidebar from '../Owner/Sidebar/Sidebar.vue';
import Header from '../Owner/Header/Header.vue';
import MultiStepForm from "../RecordOfWork/MultiStepForm.vue";

export default {
    components: {
        MultiStepForm,
        Sidebar,
        Header,
    }
};
</script>
