<template>
    <section class="min-h-screen bg-[#0f172a] text-slate-200 flex items-center justify-center px-4 py-12 selection:bg-[#A3D921] selection:text-black">
        <Message
        v-if="successMsg || errorMsg"
        :successMsg="successMsg"
        :errorMsg="errorMsg"
        @update:successMsg="successMsg = $event"
        @update:errorMsg="errorMsg = $event"
        />

        <div class="w-full max-w-5xl grid md:grid-cols-2 gap-0 overflow-hidden rounded-3xl border border-slate-800 shadow-2xl bg-[#111a3e]/40 backdrop-blur-sm">
        
            <div class="hidden md:flex flex-col justify-center p-12 bg-gradient-to-br from-[#111a3e] to-[#0f172a] border-r border-slate-800">
                <div class="mb-10">
                <div class="h-16 w-16 bg-[#A3D921] rounded-2xl flex items-center justify-center mb-8 shadow-xl shadow-[#A3D921]/20 group hover:rotate-6 transition-all">
                    <i class="fa-solid fa-bag-shopping text-black text-2xl"></i>
                </div>
                <h2 class="text-4xl lg:text-5xl font-black text-white leading-tight">
                    Shop with <br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#A3D921] to-[#639d00]">Confidence.</span>
                </h2>
                <p class="text-slate-400 mt-6 text-lg leading-relaxed">
                    Access your orders, wishlist, and personalized recommendations. Experience the future of seamless shopping.
                </p>
                </div>

                <div class="space-y-5">
                    <div v-for="item in ['Track Orders in Real-time', 'Exclusive Member Discounts', 'Secure One-tap Payments']" :key="item" class="flex items-center gap-4 group">
                        <div class="h-6 w-6 rounded-full bg-[#A3D921]/10 flex items-center justify-center group-hover:bg-[#A3D921]/20 transition">
                        <i class="fa-solid fa-check text-[#A3D921] text-xs"></i>
                        </div>
                        <span class="text-sm font-semibold text-slate-300 tracking-wide">{{ item }}</span>
                    </div>
                </div>
            </div>

            <div class="p-8 lg:p-12 bg-[#111a3e]/60 backdrop-blur-xl">
                
                <div class="flex flex-col items-center mb-10 text-center">
                <div class="mb-6 group">
                    <div class="h-24 w-24 bg-gradient-to-br from-white/10 to-transparent backdrop-blur-md rounded-[2rem] flex items-center justify-center border border-white/10 shadow-2xl transition-all duration-500 hover:scale-105">
                    <img src="/logo/white-logo.png" alt="Logo" class="w-16 h-16 object-contain drop-shadow-[0_5px_15px_rgba(163,217,33,0.3)]" />
                    </div>
                </div>
                
                <h3 class="text-3xl md:text-4xl font-black text-white tracking-tighter uppercase italic">
                    Welcome <span class="text-[#A3D921]">Back</span>
                </h3>
                <div class="mt-2 flex items-center justify-center gap-2">
                    <span class="h-px w-8 bg-[#A3D921]/50"></span>
                    <p class="text-slate-500 text-xs md:text-sm font-bold uppercase tracking-[0.2em]">
                        Personal Account Access
                    </p>
                    <span class="h-px w-8 bg-[#A3D921]/50"></span>
                </div>
                </div>

                <form @submit.prevent="handleLogin" class="space-y-6">
                
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Email Address</label>
                    <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fa-regular fa-envelope text-slate-500 group-focus-within:text-[#A3D921] transition-colors"></i>
                    </div>
                    <input
                        type="email"
                        v-model.trim="form.email"
                        placeholder="name@example.com"
                        class="auth-input pl-12 pr-4"
                        :class="{ 'border-red-500/50 bg-red-500/5': errors.email }"
                    />
                    </div>
                    <p v-if="errors.email" class="text-[11px] text-red-400 font-medium ml-1">{{ errors.email[0] }}</p>
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center px-1">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500">Password</label>
                    <router-link to="/forget-password" class="text-[11px] font-bold text-[#A3D921] hover:underline">Forgot password?</router-link>
                    </div>
                    <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fa-solid fa-lock text-slate-500 group-focus-within:text-[#A3D921] transition-colors"></i>
                    </div>
                    <input
                        :type="showPassword ? 'text' : 'password'"
                        v-model="form.password"
                        placeholder="••••••••"
                        class="auth-input pl-12 pr-12"
                        :class="{ 'border-red-500/50 bg-red-500/5': errors.password }"
                    />
                    <button type="button" @click="showPassword = !showPassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 hover:text-white transition">
                        <i :class="showPassword ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"></i>
                    </button>
                    </div>
                </div>

                <div class="flex items-center gap-3 px-1">
                    <label class="flex items-center gap-3 cursor-pointer group">
                    <div class="relative">
                        <input v-model="form.remember" type="checkbox" class="peer hidden" />
                        <div class="h-5 w-5 rounded-md border-2 border-slate-700 bg-slate-900 peer-checked:bg-[#A3D921] peer-checked:border-[#A3D921] transition"></div>
                        <i class="fa-solid fa-check absolute top-1 left-1 text-[12px] text-black opacity-0 peer-checked:opacity-100 transition"></i>
                    </div>
                    <span class="text-sm font-medium text-slate-400 group-hover:text-slate-200 transition">Stay logged in</span>
                    </label>
                </div>

                <button
                    type="submit"
                    :disabled="loading"
                    class="w-full h-14 bg-[#A3D921] text-black font-black rounded-2xl hover:bg-[#b4ec2b] active:scale-[0.98] transition-all duration-200 disabled:opacity-50 shadow-xl shadow-[#A3D921]/10 flex items-center justify-center gap-3"
                >
                    <i v-if="loading" class="fa-solid fa-circle-notch fa-spin"></i>
                    {{ loading ? 'AUTHENTICATING...' : 'SIGN IN' }}
                </button>

                <div class="relative flex items-center gap-4 py-4">
                    <div class="h-px flex-1 bg-slate-800"></div>
                    <span class="text-[10px] font-bold text-slate-600 uppercase tracking-widest">Connect with</span>
                    <div class="h-px flex-1 bg-slate-800"></div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <button v-for="social in ['google', 'github', 'facebook']" :key="social" type="button" @click="socialLogin(social)"
                    class="h-12 rounded-xl bg-slate-900 border border-slate-800 hover:border-[#A3D921] transition-all flex items-center justify-center group"
                    >
                    <i :class="`fa-brands fa-${social} text-slate-400 group-hover:text-white transition`"></i>
                    </button>
                </div>

                <p class="text-center text-slate-500 text-sm mt-8">
                    Don't have an account? 
                    <router-link to="/register" class="text-white font-bold hover:text-[#A3D921] transition underline underline-offset-4">Create one</router-link>
                </p>
                </form>
            </div>
        </div>
    </section>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';
import api from '../../services/api';
import Message from '../Message/message.vue';

const router = useRouter();
const showPassword = ref(false);
const loading = ref(false);
const successMsg = ref("");
const errorMsg = ref("");
const errors = reactive({});

const form = reactive({
    email: "",
    password: "",
    remember: false
});

const handleLogin = async () => {
    Object.keys(errors).forEach(k => delete errors[k]);
    successMsg.value = errorMsg.value = "";
    
    if (!form.email || !form.password) {
        errorMsg.value = "Credentials are required.";
        return;
    }

    loading.value = true;
    try {
        const { data } = await api.post("auth/login", { ...form, device_name: "web" });
        
        localStorage.setItem("token", data.token);
        localStorage.setItem("user", JSON.stringify(data.user));

        successMsg.value = "Login successful! Redirecting...";
        setTimeout(() => router.push("/dashboard"), 1000);
    } catch (err) {
        if (err.response?.status === 422) {
        Object.assign(errors, err.response.data.errors);
        } else {
        errorMsg.value = err.response?.data?.message || "Login failed.";
        }
    } finally {
        loading.value = false;
    }
};

const socialLogin = (p) => console.log(p);
</script>

<style scoped>
.auth-input {
    @apply w-full bg-slate-900/50 border border-slate-800 rounded-2xl py-4 pr-4 text-slate-100 
        placeholder:text-slate-600 outline-none transition-all duration-300
        focus:ring-2 focus:ring-[#A3D921]/10 focus:border-[#A3D921] focus:bg-slate-900;
}

section {
    animation: fadeIn 0.8s ease-out;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>