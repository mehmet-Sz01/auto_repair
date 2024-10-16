<template>

<nav class="flex flex-col mt-4 space-y-2">
<router-link
    to="/dashboard"
    class="px-4 py-2 hover:bg-gray-700 rounded transition flex items-center space-x-2"
    active-class="bg-gray-700"
>
    <font-awesome-icon :icon="['fas', 'house']" />
    <span>Anasayfa</span>
</router-link>
<router-link
    to="/workers"
    class="px-4 py-2 hover:bg-gray-700 rounded transition flex items-center space-x-2"
    active-class="bg-gray-700"
>
    <font-awesome-icon :icon="['fas', 'user-gear']" />
    <span>Çalışanlar</span>
</router-link>
<router-link
    to="/works"
    class="px-4 py-2 hover:bg-gray-700 rounded transition flex items-center space-x-2"
    active-class="bg-gray-700"
>
    <font-awesome-icon :icon="['fas', 'briefcase']" />
    <span>Yapılan İşler</span>
</router-link>
<router-link
    to="/customers"
    class="px-4 py-2 hover:bg-gray-700 rounded transition flex items-center space-x-2"
    active-class="bg-gray-700"
>
    <font-awesome-icon :icon="['fas', 'user']" />
    <span>Müşteriler</span>
</router-link>
</nav>
</template>
