<template>
  <section class="min-h-screen bg-slate-50 dark:bg-[#0f172a] text-slate-900 dark:text-slate-200 flex items-center justify-center px-4 py-10 selection:bg-[#A3D921] selection:text-black transition-colors duration-500">
    <Message
      v-if="successMsg || errorMsg"
      :successMsg="successMsg"
      :errorMsg="errorMsg"
      @update:successMsg="successMsg = $event"
      @update:errorMsg="errorMsg = $event"
    />

    <div class="w-full max-w-5xl grid md:grid-cols-2 gap-0 overflow-hidden rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-2xl bg-white dark:bg-[#111a3e]/40 backdrop-blur-sm">
      
      <div class="hidden md:flex flex-col justify-center p-12 bg-slate-100 dark:bg-gradient-to-br dark:from-[#111a3e] dark:to-[#0f172a] border-r border-slate-200 dark:border-slate-800">
        <div class="mb-10">
          <div class="h-16 w-16 bg-[#A3D921] rounded-2xl flex items-center justify-center mb-8 shadow-xl shadow-[#A3D921]/20 group hover:rotate-6 transition-all">
            <i class="fa-solid fa-shield-halved text-black text-2xl"></i>
          </div>
          <h2 class="text-4xl lg:text-5xl font-black text-slate-900 dark:text-white leading-tight">
            Elevate your <br/>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#A3D921] to-[#639d00]">Experience.</span>
          </h2>
          <p class="text-slate-600 dark:text-slate-400 mt-6 text-lg leading-relaxed">
            Secure access to your professional dashboard with encrypted authentication and real-time monitoring.
          </p>
        </div>

        <div class="space-y-5">
          <div v-for="feature in ['Encrypted Data Protection', 'Real-time Analytics', 'Multi-device Sync']" :key="feature" class="flex items-center gap-4 group">
            <div class="h-6 w-6 rounded-full bg-[#A3D921]/20 flex items-center justify-center group-hover:bg-[#A3D921] transition-all">
              <i class="fa-solid fa-check text-black text-[10px] font-bold"></i>
            </div>
            <span class="text-sm font-semibold text-slate-700 dark:text-slate-300 tracking-wide">{{ feature }}</span>
          </div>
        </div>
      </div>

      <div class="p-8 lg:p-12 bg-white/80 dark:bg-[#111a3e]/60 backdrop-blur-xl">
        
        <div class="flex flex-col items-center mb-10 text-center">
          <div class="mb-6 group">
            <div class="h-24 w-24 bg-slate-100 dark:bg-[#111a3e]/60 dark:to-transparent backdrop-blur-md rounded-[2rem] flex items-center justify-center border border-slate-200 dark:border-white/10 shadow-xl transition-all duration-500 hover:scale-105">
              <img src="/logo/logo.png" alt="Logo" class="w-16 h-16 object-contain drop-shadow-md dark:hidden" />
              <img src="/logo/white-logo.png" alt="Logo" class="hidden dark:block w-16 h-16 object-contain drop-shadow-[0_5px_15px_rgba(163,217,33,0.3)]" />
            </div>
          </div>
          <h3 class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter uppercase italic">
            Welcome <span class="text-[#A3D921]">Back</span>
          </h3>
          <p class="text-slate-500 dark:text-slate-500 text-[10px] font-bold uppercase tracking-[0.3em] mt-2">Professional Access</p>
        </div>

        <form @submit.prevent="handleLogin" class="space-y-6">
          
          <div class="space-y-2">
            <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Email Address</label>
            <div class="relative group">
              <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <i class="fa-regular fa-envelope text-slate-400 dark:text-slate-500 group-focus-within:text-[#A3D921] transition-colors"></i>
              </div>
              <input
                type="email" v-model.trim="form.email"
                placeholder="name@example.com"
                class="auth-input pl-12 pr-4"
                :class="{ 'border-red-500 bg-red-50/50 dark:bg-red-500/5': errors.email }"
              />
            </div>
            <p v-if="errors.email" class="text-[11px] text-red-500 dark:text-red-400 font-medium ml-1">{{ errors.email[0] }}</p>
          </div>

          <div class="space-y-2">
            <div class="flex justify-between items-center px-1">
              <label class="text-[10px] font-black uppercase tracking-widest text-slate-500">Password</label>
              <router-link to="/forget-password" class="text-[11px] font-bold text-[#A3D921] hover:underline">Forgot Password?</router-link>
            </div>
            <div class="relative group">
              <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <i class="fa-solid fa-lock text-slate-400 dark:text-slate-500 group-focus-within:text-[#A3D921] transition-colors"></i>
              </div>
              <input
                :type="showPassword ? 'text' : 'password'" v-model="form.password"
                placeholder="••••••••"
                class="auth-input pl-12 pr-12"
                :class="{ 'border-red-500 bg-red-50/50 dark:bg-red-500/5': errors.password }"
              />
              <button type="button" @click="showPassword = !showPassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-900 dark:hover:text-white transition">
                <i :class="showPassword ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"></i>
              </button>
            </div>
          </div>

          <div class="flex items-center gap-3 px-1">
            <label class="flex items-center gap-3 cursor-pointer group">
              <div class="relative">
                <input v-model="form.remember" type="checkbox" class="peer hidden" />
                <div class="h-5 w-5 rounded-md border-2 border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 peer-checked:bg-[#A3D921] peer-checked:border-[#A3D921] transition"></div>
                <i class="fa-solid fa-check absolute top-1 left-1 text-[12px] text-black opacity-0 peer-checked:opacity-100 transition"></i>
              </div>
              <span class="text-sm font-medium text-slate-500 dark:text-slate-400 group-hover:text-slate-900 dark:group-hover:text-slate-200 transition">Stay logged in</span>
            </label>
          </div>

          <button
            type="submit" :disabled="loading"
            class="w-full h-14 bg-[#A3D921] text-black font-black rounded-2xl hover:bg-[#b4ec2b] active:scale-[0.98] transition-all duration-200 disabled:opacity-50 shadow-xl shadow-[#A3D921]/20 flex items-center justify-center gap-3"
          >
            <i v-if="loading" class="fa-solid fa-circle-notch fa-spin"></i>
            {{ loading ? 'AUTHENTICATING...' : 'SIGN IN' }}
          </button>

          <div class="relative flex items-center gap-4 py-2">
            <div class="h-px flex-1 bg-slate-200 dark:bg-slate-800"></div>
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Or connect with</span>
            <div class="h-px flex-1 bg-slate-200 dark:bg-slate-800"></div>
          </div>

          <div class="grid grid-cols-3 gap-4">
            <button v-for="social in ['google', 'github', 'facebook']" :key="social" type="button" @click="handleSocialLogin(social)"
              class="h-12 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-[#A3D921] transition-all flex items-center justify-center group"
            >
              <i :class="`fa-brands fa-${social} text-slate-500 dark:text-slate-400 group-hover:text-slate-900 dark:group-hover:text-white transition`"></i>
            </button>
          </div>

          <p class="text-center text-slate-500 text-sm mt-6">
            New here? 
            <router-link to="/register" class="text-slate-900 dark:text-white font-bold hover:text-[#A3D921] transition underline underline-offset-4">Create account</router-link>
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
const features = ['Enterprise-grade security', 'Cloud-based dashboard', 'Real-time analytics'];

// States
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

// Helper: Get redirect config based on role
const getRoleRedirect = (role) => {
  const configs = {
    'super_admin':  { path: "/super-admin/dashboard", name: "Super Admin" },
    'admin':        { path: "/admin/dashboard",       name: "Admin" },
    'vendor_owner': { path: "/vendor/dashboard",      name: "Vendor Owner" },
    'vendor_staff': { path: "/vendor/dashboard",      name: "Vendor Staff" },
  };
  return configs[role] || { path: "/dashboard", name: "User" };
};

const handleLogin = async () => {
  // Reset previous state
  Object.keys(errors).forEach(key => delete errors[key]);
  successMsg.value = errorMsg.value = "";

  if (!form.email || !form.password) {
    errorMsg.value = "Email and password are required.";
    return;
  }

  loading.value = true;

  try {
    const { data } = await api.post("auth/login", {
      ...form,
      device_name: "web"
    });

    if (!data?.token) throw new Error("Invalid response from server.");

    // Storage persistence
    localStorage.setItem("token", data.token);
    localStorage.setItem("user", JSON.stringify(data.user));

    // Role-based Navigation
    const { path, name } = getRoleRedirect(data.user?.role);
    successMsg.value = `Welcome back! Redirecting to ${name} dashboard...`;

    setTimeout(() => router.push(path), 600);

  } catch (err) {
    const response = err.response;
    
    if (response?.status === 422) {
      Object.assign(errors, response.data?.errors || {});
      errorMsg.value = "Please validate your inputs.";
    } else {
      errorMsg.value = response?.data?.message || "Authentication failed. Please try again.";
    }
  } finally {
    loading.value = false;
  }
};

const handleSocialLogin = (provider) => {
  console.log(`Initializing ${provider} auth...`);
};
</script>

<style scoped>
/* Custom Utility for Inputs with Light/Dark support */
.auth-input {
  @apply w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl py-3.5 pr-4 outline-none transition-all
         text-slate-900 dark:text-slate-100 placeholder:text-slate-400 dark:placeholder:text-slate-600 
         focus:ring-2 focus:ring-[#A3D921]/20 focus:border-[#A3D921] focus:bg-white dark:focus:bg-slate-900;
}

/* Animations */
section {
  animation: fadeIn 0.6s ease-out;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(5px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>