<template>
  <div :class="{ 'dark': isDark }">
    <div class="min-h-screen bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors duration-300 font-sans">
      
      <div class="bg-indigo-600 text-white text-[10px] md:text-sm py-2 px-4 flex justify-between items-center">
        <div class="truncate">🔥 Flash Sale: Get 50% Off Today!</div>
        <div class="flex gap-4 shrink-0">
          <button @click="toggleDarkMode" class="flex items-center gap-2 bg-indigo-700 px-3 py-1 rounded-full hover:bg-indigo-800 transition">
            <i :class="isDark ? 'fa-solid fa-sun' : 'fa-solid fa-moon'"></i>
            <span class="hidden sm:inline">{{ isDark ? 'Light' : 'Dark' }}</span>
          </button>
        </div>
      </div>

      <header class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b dark:border-gray-800">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
          <div class="text-2xl font-black text-indigo-600 dark:text-indigo-400 tracking-tighter">Mercuvaix</div>
          
          <div class="hidden lg:flex flex-1 mx-10 max-w-xl">
            <div class="relative w-full">
              <input type="text" placeholder="Search products..." 
                class="w-full bg-gray-100 dark:bg-gray-800 border-none rounded-full px-6 py-2.5 focus:ring-2 focus:ring-indigo-500 outline-none">
              <i class="fa-solid fa-magnifying-glass absolute right-4 top-3.5 text-gray-400"></i>
            </div>
          </div>

          <div class="flex items-center gap-4 md:gap-6">
            <button class="hover:text-indigo-600 transition"><i class="fa-regular fa-user text-xl"></i></button>
            <div class="relative cursor-pointer group">
              <i class="fa-solid fa-bag-shopping text-xl group-hover:text-indigo-600 transition"></i>
              <span class="absolute -top-2 -right-2 bg-indigo-600 text-white text-[10px] rounded-full h-5 w-5 flex items-center justify-center font-bold">2</span>
            </div>
            <button @click="mobileMenu = !mobileMenu" class="lg:hidden text-2xl">
              <i :class="mobileMenu ? 'fa-solid fa-xmark' : 'fa-solid fa-bars-staggered'"></i>
            </button>
          </div>
        </div>

        <div class="lg:hidden px-4 pb-4">
          <input type="text" placeholder="Search..." class="w-full bg-gray-100 dark:bg-gray-800 rounded-lg px-4 py-2 text-sm outline-none">
        </div>
      </header>

      <nav class="hidden lg:block border-b dark:border-gray-800 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-4">
          <ul class="flex gap-8 py-3 text-sm font-semibold uppercase tracking-wide">
            <li v-for="menu in menus" :key="menu">
              <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">{{ menu }}</a>
            </li>
          </ul>
        </div>
      </nav>

      <slider />

      <transition name="slide">
        <div v-if="mobileMenu" class="fixed inset-0 z-[60] lg:hidden">
          <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="mobileMenu = false"></div>
          <div class="absolute left-0 top-0 h-full w-64 bg-white dark:bg-gray-900 p-6 shadow-2xl">
            <h2 class="text-xl font-bold mb-6">Menu</h2>
            <ul class="space-y-4 font-medium">
              <li v-for="menu in menus" :key="menu" @click="mobileMenu = false">
                <a href="#" class="block py-2 border-b dark:border-gray-800">{{ menu }}</a>
              </li>
            </ul>
          </div>
        </div>
      </transition>

      <main class="container mx-auto px-4 py-6 md:py-10">
        <div class="flex flex-col lg:flex-row gap-8">
          
          <aside class="hidden lg:block w-64 shrink-0">
            <div class="sticky top-28 space-y-8">
              <div>
                <h3 class="font-bold text-lg mb-4 flex items-center gap-2">
                  <span class="w-1 h-6 bg-indigo-600 rounded-full"></span> Categories
                </h3>
                <ul class="space-y-2">
                  <li v-for="cat in categories" :key="cat" class="flex items-center gap-2 cursor-pointer hover:translate-x-1 transition-transform dark:text-gray-400 dark:hover:text-white">
                    <i class="fa-solid fa-chevron-right text-[10px] text-indigo-500"></i> {{ cat }}
                  </li>
                </ul>
              </div>
              <div class="p-6 bg-indigo-50 dark:bg-indigo-900/20 rounded-2xl border border-indigo-100 dark:border-indigo-800/30">
                <p class="text-xs font-bold text-indigo-600 dark:text-indigo-400 mb-2 uppercase">Promo</p>
                <h4 class="font-bold mb-2">Get Extra $20 Off!</h4>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">Use code: VUE2026</p>
                <button class="w-full bg-indigo-600 text-white py-2 rounded-lg text-sm font-bold">Copy Code</button>
              </div>
            </div>
          </aside>

          <div class="flex-1">
            <div class="flex items-center justify-between mb-8">
              <h2 class="text-2xl md:text-3xl font-black">Featured <span class="text-indigo-600">Deals</span></h2>
              <div class="flex gap-2">
                <button class="p-2 border dark:border-gray-800 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition"><i class="fa-solid fa-sliders"></i></button>
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 md:gap-8">
              <div v-for="product in products" :key="product.id" 
                class="group relative bg-white dark:bg-gray-900 rounded-[2rem] p-4 border border-gray-100 dark:border-gray-800 hover:shadow-2xl dark:hover:shadow-indigo-500/10 transition-all duration-500">
                
                <div class="relative aspect-square overflow-hidden rounded-[1.5rem] bg-gray-100 dark:bg-gray-800">
                  <img :src="product.image" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                  <button class="absolute top-4 right-4 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md p-2.5 rounded-full shadow-lg hover:text-red-500 transition">
                    <i class="fa-regular fa-heart"></i>
                  </button>
                </div>

                <div class="mt-5 px-2 pb-2">
                  <div class="flex justify-between items-start mb-1">
                    <span class="text-[10px] font-black uppercase tracking-widest text-indigo-500">{{ product.category }}</span>
                    <div class="flex items-center gap-1 text-yellow-400 text-xs">
                      <i class="fa-solid fa-star"></i>
                      <span class="text-gray-500 dark:text-gray-400 font-bold">4.8</span>
                    </div>
                  </div>
                  <h3 class="font-bold text-lg group-hover:text-indigo-600 transition truncate">{{ product.name }}</h3>
                  
                  <div class="flex items-center justify-between mt-4">
                    <div class="flex flex-col">
                      <span class="text-2xl font-black">${{ product.price }}</span>
                      <span class="text-xs text-gray-400 line-through">${{ product.oldPrice }}</span>
                    </div>
                    <button class="bg-gray-900 dark:bg-indigo-600 text-white p-3 rounded-2xl hover:scale-110 transition active:scale-95 shadow-lg">
                      <i class="fa-solid fa-plus text-lg"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div class="mt-16 bg-gray-900 dark:bg-indigo-950 rounded-[2.5rem] p-8 md:p-12 relative overflow-hidden">
                <div class="relative z-10 max-w-lg">
                    <h2 class="text-3xl md:text-4xl font-black text-white mb-4">Subscribe & Get <span class="text-indigo-400">15% Off</span></h2>
                    <p class="text-gray-400 mb-8">Join our newsletter to receive updates on new arrivals and special offers.</p>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <input type="email" placeholder="Enter your email" class="flex-1 bg-white/10 border border-white/10 rounded-2xl px-6 py-4 text-white outline-none focus:border-indigo-500">
                        <button class="bg-indigo-600 text-white font-bold px-8 py-4 rounded-2xl hover:bg-indigo-700 transition">Join Now</button>
                    </div>
                </div>
                <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl"></div>
            </div>
          </div>
        </div>
      </main>

      <footer class="bg-gray-50 dark:bg-gray-950 border-t dark:border-gray-800 py-12">
        <div class="container mx-auto px-4 text-center">
          <div class="flex justify-center gap-6 mb-6 text-xl">
            <i class="fa-brands fa-facebook hover:text-indigo-600 cursor-pointer"></i>
            <i class="fa-brands fa-instagram hover:text-indigo-600 cursor-pointer"></i>
            <i class="fa-brands fa-twitter hover:text-indigo-600 cursor-pointer"></i>
          </div>
          <p class="text-gray-500 text-sm italic">© 2026 Mercuvaix - Quality over Quantity.</p>
        </div>
      </footer>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

import slider from './slider.vue'

const isDark = ref(false)
const mobileMenu = ref(false)

const toggleDarkMode = () => {
  isDark.value = !isDark.value
}

const menus = ['Home', 'New Arrivals', 'Collections', 'Limited Edition', 'Sale']
const categories = ['Casual Wear', 'Tech Gadgets', 'Smart Home', 'Sneakers', 'Luxury Watches']

const products = ref([
  {
    id: 1,
    name: "Ultra-Fast Wireless Charger",
    price: 45,
    oldPrice: 60,
    category: "Gadgets",
    image: "https://images.unsplash.com/photo-1586816829391-764539245591?w=600"
  },
  {
    id: 2,
    name: "Classic Leather Backpack",
    price: 120,
    oldPrice: 180,
    category: "Fashion",
    image: "https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=600"
  },
  {
    id: 3,
    name: "Smart Noise Cancelling Pods",
    price: 199,
    oldPrice: 249,
    category: "Audio",
    image: "https://images.unsplash.com/photo-1590658268037-6bf12165a8df?w=600"
  }
])
</script>

<style scoped>
.slide-enter-active, .slide-leave-active {
  transition: transform 0.3s ease;
}
.slide-enter-from, .slide-leave-to {
  transform: translateX(-100%);
}
</style>