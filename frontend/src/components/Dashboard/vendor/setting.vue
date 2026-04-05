<template>
    <div class="min-h-screen bg-white dark:bg-slate-950 transition-colors duration-200">
        <Header
            @open-sidebar="sidebarOpen = true"
            @search="onSearch"
            :isDark="isDark" @toggle-theme="toggleTheme"
        />

        <div class="flex  min-h-[calc(100vh-56px)]">
            <Navbar
                v-model="active"
                :open="sidebarOpen"
                @close="sidebarOpen = false"
            />

            <Message
                :successMsg="successMsg"
                :errorMsg="errorMsg"
                @update:successMsg="successMsg = $event"
                @update:errorMsg="errorMsg = $event"
            />

            <!-- Content -->
            <div class="flex-1 min-w-0">
                <main class="min-h-screen bg-gray-50 dark:bg-[#0C1326]">
                    <div class="mx-auto px-4 sm:px-6 lg:px-8 py-5">

                        <!-- Header -->
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <h1 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-gray-100">
                                ⚙️ Settings
                                </h1>
                                <p class="text-sm text-gray-600 dark:text-slate-400">Manage all complaint and software settings</p>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="mt-6 grid grid-cols-1 lg:grid-cols-4 gap-6">

                            <!-- LEFT SIDEBAR -->
                            <aside class="lg:col-span-1">
                                <div class="rounded-2xl border border-slate-200 bg-white p-3 shadow-sm dark:border-slate-700 dark:bg-slate-900">

                                <div class="flex lg:flex-col gap-2 overflow-x-auto lg:overflow-visible">
                                    <button
                                    v-for="item in menus"
                                    :key="item.key"
                                    @click="activeTab = item.key"
                                    class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm whitespace-nowrap transition"
                                    :class="activeTab === item.key
                                        ? 'bg-indigo-600 text-white shadow'
                                        : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800'"
                                    >
                                    <span><i :class="item.icon"></i></span>
                                    <span>{{ item.label }}</span>
                                    </button>
                                </div>

                                </div>
                            </aside>

                            <!-- RIGHT CONTENT -->
                            <section class="lg:col-span-3">
                                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900 min-h-[400px]">

                                    <!-- General -->
                                    <div v-if="activeTab === 'general'">
                                        <settingGeneral />
                                    </div>

                                    <!-- Complaint -->
                                    <div v-if="activeTab === 'complaint'">
                                        <settingComplaint />
                                    </div>

                                    <!-- Division -->
                                    <div v-if="activeTab === 'division'">
                                        <settingDivision />
                                    </div>

                                    <!-- District -->
                                    <div v-if="activeTab === 'district'">
                                        <settingDistrict />
                                    </div>

                                    <!-- Upazila -->
                                    <div v-if="activeTab === 'upazila'">
                                        <settingUpazila />
                                    </div>

                                    <!-- Police Station -->
                                    <div v-if="activeTab === 'policeStation'">
                                        <settingPoliceStation />
                                    </div>

                                    <!-- Category -->
                                    <div v-if="activeTab === 'category'">
                                        <settingCategory />
                                    </div>

                                    <!-- Sub-Category -->
                                    <div v-if="activeTab === 'subCategory'">
                                        <settingSubCategory />
                                    </div>

                                    <!-- Notification -->
                                    <div v-if="activeTab === 'notification'">
                                        <h2 class="section-title">Notification</h2>

                                        <div class="space-y-4">
                                        kk
                                        </div>
                                    </div>

                                    <!-- About -->
                                    <div v-if="activeTab === 'about'">
                                        <settingAbout />
                                    </div>

                                    <!-- Security -->
                                    <div v-if="activeTab === 'security'">
                                        <h2 class="section-title">Security</h2>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <input type="number" placeholder="Password Length" class="input"/>
                                        <input type="number" placeholder="Session Timeout" class="input"/>
                                        </div>
                                    </div>

                                </div>
                            </section>

                        </div>

                    </div>
                </main>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();

import Message from '../../Message/message.vue'
import Navbar from '../Dashboard/navbar.vue'
import Header from '../Dashboard/header.vue'

const successMsg = ref("");
const errorMsg = ref("");

import settingGeneral from "./setting-general.vue";
import settingComplaint from "./setting-complaint.vue";
import settingDivision from "./setting-division.vue";
import settingDistrict from "./setting-district.vue";
import settingUpazila from "./setting-upazila.vue";
import settingPoliceStation from "./setting-police-station.vue";
import settingCategory from "./setting-category.vue";
import settingSubCategory from "./setting-sub-category.vue";

import settingAbout from "./setting-about.vue";

const sidebarOpen = ref(false);
const active = ref("dashboard");








const activeTab = ref('general')

const menus = [
    { key: 'general', label: 'General', icon: 'fa-solid fa-gear' },
    { key: 'complaint', label: 'Complaint', icon: 'fa-solid fa-envelope' },

    // -------------------------------- Complaint option setting ---------------------------------- //
    { key: 'division', label: 'Division', icon: 'fa-solid fa-code-compare' },
    { key: 'district', label: 'District', icon: 'fa-solid fa-building-circle-arrow-right' },
    { key: 'upazila', label: 'Upazila', icon: 'fa-solid fa-mask-ventilator' },
    { key: 'policeStation', label: 'Police-Station', icon: 'fa-solid fa-building-shield' },
    { key: 'category', label: 'Category', icon: 'fa-solid fa-table-cells-large' },
    { key: 'subCategory', label: 'Sub Category', icon: 'fa-solid fa-table-list' },
    // -------------------------------- Complaint option setting ---------------------------------- //

    { key: 'theme', label: 'Theme', icon: 'fa-brands fa-affiliatetheme' },
    { key: 'notification', label: 'Notification', icon: 'fa-solid fa-bell' },
    { key: 'security', label: 'Security', icon: 'fa-solid fa-lock' },
    { key: 'privacy', label: 'Privacy & Policy', icon: 'fa-solid fa-shield-halved' },
    { key: 'about', label: 'About', icon: 'fa-solid fa-info' },
]






const isDark = ref(false);

function applyTheme(dark) {
    isDark.value = dark;   // VERY IMPORTANT
    document.documentElement.classList.toggle("dark", dark);
    localStorage.setItem("theme", dark ? "dark" : "light");
}

function toggleTheme() {
    applyTheme(!isDark.value);
}

function onSearch(q) {
    console.log("search:", q);
}


/* ESC to close drawer */
onMounted(() => {
    window.addEventListener("keydown", (e) => {
        if (e.key === "Escape") sidebarOpen.value = false;
    });

    const saved = localStorage.getItem("theme");

    if (saved === "dark") applyTheme(true);
    else if (saved === "light") applyTheme(false);
    else {
        const systemDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
        applyTheme(systemDark);
    }
});
</script>


<style scoped>
.input {
    @apply w-full px-3 py-2 text-sm rounded-lg border 
    border-slate-200 dark:border-slate-700 
    bg-white dark:bg-slate-800 
    text-slate-700 dark:text-white
    focus:ring-2 focus:ring-indigo-500 outline-none;
}

.section-title {
    @apply text-lg font-semibold mb-4 text-slate-800 dark:text-white;
}

</style>