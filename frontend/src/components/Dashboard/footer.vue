<template>
    <footer class="bg-white dark:bg-[#0f172a] border-t border-slate-200 dark:border-white/10 transition-colors duration-500">
        <div class="max-w-7xl mx-auto px-4 pt-16 pb-8">
        
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                
                <div class="space-y-6">
                <router-link to="/" class="flex items-center gap-3 group">
                    <div class="relative flex items-center justify-center h-10 w-10 rounded-xl bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 transition-transform group-hover:scale-105">
                    <img src="/logo/logo.png" alt="Logo" class="w-7 h-7 object-contain dark:hidden" />
                    <img src="/logo/white-logo.png" alt="Logo" class="hidden dark:block w-7 h-7 object-contain drop-shadow-[0_4px_10px_rgba(163,217,33,0.3)]" />
                    </div>
                    <span class="text-xl font-black tracking-tighter uppercase italic text-slate-900 dark:text-white">
                    Mercuvaix <span class="text-[#A3D921]">Business</span>
                    </span>
                </router-link>
                
                <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">
                    Empowering businesses with modern digital solutions. Secure, scalable, and built for the future of enterprise management.
                </p>

                <div class="flex gap-4">
                    <a v-for="social in ['facebook', 'twitter', 'linkedin', 'github']" :key="social" href="#" 
                    class="h-9 w-9 rounded-lg bg-slate-100 dark:bg-white/5 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:bg-[#A3D921] hover:text-black transition-all">
                    <i :class="`fa-brands fa-${social}`"></i>
                    </a>
                </div>
                </div>

                <div>
                <h4 class="text-slate-900 dark:text-white font-bold uppercase tracking-widest text-xs mb-6">Platform</h4>
                <ul class="space-y-4">
                    <li v-for="link in ['Dashboard', 'Project Management', 'Team Collaboration', 'Analytics']" :key="link">
                    <router-link to="#" class="text-sm text-slate-500 dark:text-slate-400 hover:text-[#A3D921] dark:hover:text-[#A3D921] transition-colors">
                        {{ link }}
                    </router-link>
                    </li>
                </ul>
                </div>

                <div>
                <h4 class="text-slate-900 dark:text-white font-bold uppercase tracking-widest text-xs mb-6">Company</h4>
                <ul class="space-y-4">
                    <li v-for="link in ['About Us', 'Privacy Policy', 'Terms of Service', 'Cookie Policy']" :key="link">
                    <router-link to="#" class="text-sm text-slate-500 dark:text-slate-400 hover:text-[#A3D921] dark:hover:text-[#A3D921] transition-colors">
                        {{ link }}
                    </router-link>
                    </li>
                </ul>
                </div>

                <div class="space-y-6">
                <h4 class="text-slate-900 dark:text-white font-bold uppercase tracking-widest text-xs mb-2">Stay Updated</h4>
                <p class="text-sm text-slate-500 dark:text-slate-400">Subscribe to our newsletter for the latest updates.</p>
                
                <form @submit.prevent="" class="relative">
                    <input 
                    type="email" 
                    placeholder="Your email"
                    class="w-full bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-white/10 rounded-xl py-3 px-4 text-sm outline-none focus:border-[#A3D921] transition-all dark:text-white"
                    />
                    <button class="absolute right-1 top-1 bottom-1 px-4 bg-[#A3D921] text-black text-xs font-bold rounded-lg hover:bg-[#b4ec2b] transition-all">
                    JOIN
                    </button>
                </form>
                </div>

            </div>

            <div class="pt-8 border-t border-slate-200 dark:border-white/5 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-xs text-slate-500 dark:text-slate-500 font-medium">
                © {{ new Date().getFullYear() }} Mercuvaix Business. All rights reserved.
                </p>
                
                <div class="flex items-center gap-6">
                <div class="flex items-center gap-2 text-xs text-slate-400 dark:text-slate-500">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    System Status: Healthy
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