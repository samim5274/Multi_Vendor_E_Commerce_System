<template>
    <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-slate-900 rounded-xl shadow-md border border-slate-100 dark:border-slate-800">
        
        <!-- Message component -->
        <Message
            :successMsg="successMsg"
            :errorMsg="errorMsg"
            @update:successMsg="successMsg = $event"
            @update:errorMsg="errorMsg = $event"
        />

        <!-- Header -->
        <div class="flex items-center justify-between mb-8 pb-4 border-b border-slate-100 dark:border-slate-800">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Shop Settings</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400">Manage your store details and appearance</p>
            </div>
            <div class="relative group">
                <div v-if="shopLogoPreview" class="h-16 w-16 rounded-full ring-4 ring-emerald-500/20 overflow-hidden">
                    <img :src="shopLogoPreview" class="h-full w-full object-cover" />
                </div>
                <div v-else class="h-16 w-16 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center border-2 border-dashed border-slate-300">
                    <span class="text-[10px] text-slate-400 font-medium">LOGO</span>
                </div>
            </div>
        </div>

        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
            <!-- Branding Assets -->
            <div class="space-y-6">
                <div>
                    <label class="section-label">Branding Assets</label>
                    
                    <!-- Logo Upload -->
                    <div class="mt-2 flex flex-col items-center p-4 border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-xl hover:border-emerald-400 transition-colors cursor-pointer relative">
                        <input type="file" @change="onLogoChange" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" />
                        <div v-if="!shopLogoPreview" class="text-center">
                        <div class="mx-auto h-12 w-12 text-slate-400 mb-2">📁</div>
                        <span class="text-xs font-medium text-slate-500">Upload Logo</span>
                        </div>
                        <img v-else :src="shopLogoPreview" class="h-24 w-24 object-contain rounded-lg" />
                    </div>
                </div>
            </div>

            <!-- Shop Details -->
            <div class="lg:col-span-2 space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div class="md:col-span-2">
                        <label class="input-label">Shop Name</label>
                        <input v-model="form.shop_name" type="text" placeholder="e.g. Gadget Mart Pro" class="input-field" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="input-label">Slug</label>
                        <input v-model="form.shop_slug" type="text" placeholder="URL: mercuvaix.com/tech-shop-bd" class="input-field" />
                    </div>

                    <div>
                        <label class="input-label">Email</label>
                        <input v-model="form.email" type="email" placeholder="contact@shop.com" class="input-field" />
                    </div>

                    <div>
                        <label class="input-label">Phone Number</label>
                        <input v-model="form.phone" type="text" placeholder="+880 1XXX XXXXXX" class="input-field" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="input-label">Shop Description</label>
                        <textarea v-model="form.shop_description" rows="3" placeholder="Tell customers about your brand..." class="input-field resize-none"></textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label class="input-label">Physical Address</label>
                        <input v-model="form.address" type="text" placeholder="House 12, Road 5, Dhanmondi, Dhaka" class="input-field" />
                    </div>

                    <div>
                        <label class="input-label">City</label>
                        <input v-model="form.city" type="text" placeholder="Dhaka" class="input-field" />
                    </div>

                    <div>
                        <label class="input-label">State</label>
                        <input v-model="form.state" type="text" placeholder="Dhaka" class="input-field" />
                    </div>

                    <div>
                        <label class="input-label">Postal Code</label>
                        <input v-model="form.postal_code" type="text" placeholder="Bangladesh" class="input-field" />
                    </div>

                    <div>
                        <label class="input-label">Country</label>
                        <input v-model="form.country" type="text" placeholder="Bangladesh" class="input-field" />
                    </div>

                </div>

                <!-- Action Buttons -->
                <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-800 flex items-center justify-end gap-3">
                    <button class="px-6 py-2.5 border text-sm font-semibold text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-all">
                        Cancel
                    </button>
                    <button 
                        @click="saveSettings" 
                        :disabled="loading"
                        class="px-8 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold rounded-lg shadow-lg shadow-emerald-500/20 transition-all flex items-center gap-2 disabled:opacity-70">
                        <span v-if="loading" class="animate-spin text-lg">↻</span>
                        {{ loading ? 'Saving...' : 'Save' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import api, { makeImg } from "../../../services/api.js";
import Message from '../../Message/message.vue'

const loading = ref(false);
const successMsg = ref("");
const errorMsg = ref("");

const shopLogoPreview = ref(null);

const form = ref({
    shop_name: '',
    shop_slug: '',
    shopLogo: null,
    shopBanner: null,
    shop_description: '',
    email: '',
    phone: '',
    address: '',
    city: '',
    state: '',
    country: '',
    postal_code: '',
});

// Fetch vendor
const fetchVendor = async () => {
    try {
        const res = await api.get("/vendor/auth-user");
        // console.log("Vendor API:", res.data.data);
        if(res.data.success && res.data.data){
            const v = res.data.data;

            form.value.shop_name = v.shop_name ?? '';
            form.value.shop_slug = v.shop_slug ?? '';
            form.value.shop_description = v.shop_description ?? '';
            form.value.email = v.email ?? '';
            form.value.phone = v.phone ?? '';
            form.value.address = v.address ?? '';
            form.value.city = v.city ?? '';
            form.value.state = v.state ?? '';
            form.value.country = v.country ?? '';
            form.value.postal_code = v.postal_code ?? '';

            shopLogoPreview.value = v.shop_logo ? makeImg(v.shop_logo) : null;
        }
    } catch(err){
        console.log("Vendor fetch error:", err);
        errorMsg.value = "Failed to fetch vendor data!";
    }
};

// Image Handlers
const onLogoChange = (e) => {
    const file = e.target.files[0];
    if(file){
        form.value.shopLogo = file;
        shopLogoPreview.value = URL.createObjectURL(file);
    }
};

// Save Settings (dummy)
const saveSettings = async () => {
    loading.value = true;
    
    setTimeout(() => {
        loading.value = false;
        successMsg.value = "Settings updated successfully!";
    }, 1500);
};

onMounted(() => {
    fetchVendor();
});
</script>

<style scoped>
.input-label {
    @apply block mb-1.5 text-sm font-semibold text-slate-700 dark:text-slate-300;
}

.section-label {
    @apply block mb-3 text-sm font-bold uppercase tracking-widest text-emerald-600 dark:text-emerald-400;
}

.input-field {
    @apply w-full px-4 py-2.5 text-sm rounded-xl border 
    border-slate-200 dark:border-slate-700 
    bg-white dark:bg-slate-800/50 
    text-slate-700 dark:text-slate-100
    placeholder:text-slate-400
    focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 
    outline-none transition-all duration-200;
}
</style>