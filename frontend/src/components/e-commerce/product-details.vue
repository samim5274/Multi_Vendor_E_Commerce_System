<template>
  <div :class="{ 'dark': isDark }">
    <section class="py-12 bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors duration-500 min-h-screen relative">
      
      <div class="container mx-auto px-4 mb-6 flex justify-end">
        <button 
          @click="isDark = !isDark" 
          class="flex items-center gap-2 px-4 py-2 rounded-full bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all border border-gray-200 dark:border-gray-700 shadow-sm"
        >
          <i :class="isDark ? 'fa-solid fa-sun text-yellow-400' : 'fa-solid fa-moon text-indigo-600'"></i>
          <span class="text-xs font-bold uppercase tracking-wider">
            {{ isDark ? 'Light Mode' : 'Dark Mode' }}
          </span>
        </button>
      </div>

      <div class="container mx-auto px-4">
        <nav class="flex text-sm text-gray-500 dark:text-gray-400 mb-8 overflow-x-auto whitespace-nowrap">
          <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">Home</a>
          <span class="mx-2">/</span>
          <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">Electronics</a>
          <span class="mx-2">/</span>
          <span class="text-gray-900 dark:text-white font-semibold">Premium Headphones</span>
        </nav>

        <div class="flex flex-col lg:flex-row gap-12">
          <div class="w-full lg:w-1/2">
            <div class="lg:sticky lg:top-10">
              <div class="aspect-square rounded-[2.5rem] overflow-hidden bg-gray-50 dark:bg-gray-900 mb-4 group border dark:border-gray-800 shadow-xl">
                <img :src="activeImage" alt="Product" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
              </div>
              <div class="flex gap-4 overflow-x-auto pb-4 no-scrollbar">
                <button 
                  v-for="(img, index) in product.images" :key="index"
                  @click="activeImage = img"
                  class="w-20 h-20 rounded-2xl overflow-hidden border-2 shrink-0 transition-all"
                  :class="activeImage === img ? 'border-indigo-600 scale-105' : 'border-transparent opacity-60 hover:opacity-100'"
                >
                  <img :src="img" class="w-full h-full object-cover">
                </button>
              </div>
            </div>
          </div>

          <div class="w-full lg:w-1/2 space-y-8">
            <div>
              <span class="bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest border border-indigo-100 dark:border-indigo-500/20">
                New Arrival
              </span>
              <h1 class="text-4xl md:text-5xl font-black mt-6 tracking-tight leading-tight">
                {{ product.name }}
              </h1>
              <div class="flex items-center gap-4 mt-4">
                <div class="flex text-amber-400 text-sm">
                  <i v-for="i in 5" :key="i" class="fa-solid fa-star"></i>
                </div>
                <span class="text-sm text-gray-400 font-medium border-l dark:border-gray-800 pl-4">120 Reviews</span>
              </div>
            </div>

            <div class="flex items-center gap-4">
              <span class="text-5xl font-black text-indigo-600 dark:text-indigo-500">${{ product.price }}</span>
              <span class="text-xl text-gray-400 line-through">${{ product.oldPrice }}</span>
            </div>

            <p class="text-gray-600 dark:text-gray-400 leading-relaxed text-lg italic">
              "{{ product.shortDescription }}"
            </p>

            <hr class="dark:border-gray-800">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
              <div>
                <h4 class="font-bold mb-4">Color</h4>
                <div class="flex gap-3">
                  <button 
                    v-for="color in product.colors" :key="color.name"
                    @click="selectedColor = color.name"
                    :class="['w-10 h-10 rounded-full border-2 transition-all p-1', 
                    selectedColor === color.name ? 'border-indigo-600 scale-110 shadow-lg shadow-indigo-500/20' : 'border-gray-200 dark:border-gray-800']"
                  >
                    <div :style="{ backgroundColor: color.hex }" class="w-full h-full rounded-full"></div>
                  </button>
                </div>
              </div>
              <div>
                <h4 class="font-bold mb-4">Quantity</h4>
                <div class="flex items-center bg-gray-50 dark:bg-gray-900 border dark:border-gray-800 rounded-2xl p-1 w-max">
                  <button @click="qty > 1 ? qty-- : null" class="w-10 h-10 flex items-center justify-center hover:bg-white dark:hover:bg-gray-800 rounded-xl transition">-</button>
                  <span class="px-4 font-black">{{ qty }}</span>
                  <button @click="qty++" class="w-10 h-10 flex items-center justify-center hover:bg-white dark:hover:bg-gray-800 rounded-xl transition">+</button>
                </div>
              </div>
            </div>

            <button class="w-full bg-gray-900 dark:bg-indigo-600 text-white py-5 rounded-[2rem] font-black text-xl hover:bg-indigo-700 dark:hover:bg-indigo-500 transform active:scale-95 transition-all shadow-2xl shadow-indigo-500/20">
              Add To Shopping Bag
            </button>
          </div>
        </div>

        <div class="mt-24 border-t dark:border-gray-800 pt-12">
          <div class="flex gap-10 border-b dark:border-gray-800 mb-8 overflow-x-auto no-scrollbar">
            <button 
              v-for="tab in ['Description', 'Tech Specs']" :key="tab"
              @click="activeTab = tab"
              class="pb-4 font-black uppercase text-xs tracking-widest relative transition-all"
              :class="activeTab === tab ? 'text-indigo-600 dark:text-indigo-400' : 'text-gray-400'"
            >
              {{ tab }}
              <span v-if="activeTab === tab" class="absolute bottom-0 left-0 w-full h-1 bg-indigo-600 dark:bg-indigo-400 rounded-t-full"></span>
            </button>
          </div>
          <div class="max-w-4xl text-gray-600 dark:text-gray-400 leading-loose text-lg">
            <p v-if="activeTab === 'Description'">{{ product.longDescription }}</p>
            <div v-else class="grid grid-cols-2 gap-4">
               <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-xl border dark:border-gray-800 font-medium">Bluetooth 5.2</div>
               <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-xl border dark:border-gray-800 font-medium">40h Battery</div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref } from 'vue'

// Theme Toggle State
const isDark = ref(false)

const qty = ref(1)
const activeTab = ref('Description')
const selectedColor = ref('Space Gray')

const product = {
  name: "AudioMax Pro ANC Headphones",
  price: 299,
  oldPrice: 399,
  shortDescription: "Precision engineered for sound purity. The ultimate wireless experience.",
  longDescription: "Our headphones are crafted for the ultimate listening experience. With custom-tuned 40mm drivers and premium memory foam cushions, you can listen for hours in complete comfort. Advanced Active Noise Cancellation (ANC) keeps the distractions away.",
  colors: [
    { name: 'Space Gray', hex: '#4B5563' },
    { name: 'Midnight Blue', hex: '#1E3A8A' },
    { name: 'Pure White', hex: '#F9FAFB' }
  ],
  images: [
    "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800",
    "https://images.unsplash.com/photo-1583394838336-acd977736f90?w=800",
    "https://images.unsplash.com/photo-1484704849700-f032a568e944?w=800"
  ]
}

const activeImage = ref(product.images[0])
</script>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

.no-scrollbar::-webkit-scrollbar { display: none; }

/* Smooth background transition */
section {
  transition: background-color 0.5s ease, color 0.5s ease;
}
</style>