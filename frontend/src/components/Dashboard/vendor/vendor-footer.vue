<template>
    <footer class="bg-white dark:bg-[#0f172a] border-t border-slate-200 dark:border-white/10 transition-colors duration-500">
        <div class="max-w-7xl mx-auto py-4">
        
        <div class="flex flex-col md:flex-row justify-between items-center gap-8">
            
            <div class="flex flex-col md:flex-row items-center gap-4 md:gap-8">
            <router-link to="/" class="flex items-center gap-3 group">
                <div class="h-9 w-9 rounded-xl bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 flex items-center justify-center transition-transform group-hover:scale-105">
                <img src="/logo/logo.png" alt="Logo" class="w-6 h-6 object-contain dark:hidden" />
                <img src="/logo/white-logo.png" alt="Logo" class="hidden dark:block w-6 h-6 object-contain drop-shadow-[0_4px_8px_rgba(163,217,33,0.3)]" />
                </div>
                <span class="text-sm font-black tracking-tighter uppercase italic text-slate-900 dark:text-white">
                Mercuvaix <span class="text-[#A3D921]">Business</span>
                </span>
            </router-link>
            
            <div class="hidden md:block h-4 w-px bg-slate-300 dark:bg-slate-800"></div>
            
                <p class="text-[11px] text-slate-500 dark:text-slate-500 font-bold uppercase tracking-widest">
                    © {{ new Date().getFullYear() }} All Rights Reserved.
                </p>
            </div>

            <div class="flex flex-col md:flex-row items-center gap-6">
            <div class="flex items-center gap-2.5 px-4 py-2 rounded-full bg-slate-50 dark:bg-white/5 border border-slate-100 dark:border-white/5">
                <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                <span class="text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-slate-400">
                System: <span class="text-emerald-500">Healthy</span>
                </span>
            </div>

            <div class="flex items-center gap-4 text-slate-400 dark:text-slate-600">
                <a href="#" class="hover:text-[#A3D921] transition-colors"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#" class="hover:text-[#A3D921] transition-colors"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="#" class="hover:text-[#A3D921] transition-colors"><i class="fa-brands fa-github"></i></a>
            </div>
            </div>

        </div>
        </div>
    </footer>
</template>

<script setup>
// No extra logic needed for static footer
</script>

<style scoped>
/* Optional: Adding a soft glow to the footer in dark mode */
.dark footer {
    box-shadow: 0 -10px 40px -20px rgba(163, 217, 33, 0.05);
}
</style>