<template>
    <div class="flex min-h-screen">
        <Sidebar /> <!-- Sidebar bileşenini burada kullanıyoruz -->
        <div class="flex flex-1 flex-col">
            <Header /> <!-- Header bileşeniniz burada olacak -->
            <div class="px-4 md:px-8 lg:px-16"> <!-- Sağdan ve soldan boşluk ekliyoruz -->
                <router-view></router-view>
            </div>
        </div>
    </div>

</template>

<script>
import Sidebar from './Sidebar/Sidebar.vue';
import Header from './Header/Header.vue';

export default {
    components: {
        Sidebar,
        Header,

    }
};
</script>
