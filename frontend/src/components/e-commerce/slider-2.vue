<template>
  <div :class="{ 'dark': isDark }">
    <div class="min-h-screen bg-slate-50 dark:bg-gray-950 text-slate-900 dark:text-gray-100 transition-colors duration-500">
      
      <nav class="sticky top-0 z-[100] bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b dark:border-gray-800">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
          <div class="text-2xl font-black tracking-tighter text-indigo-600 dark:text-indigo-400">LUXE.STUDIO</div>
          <div class="flex items-center gap-6">
            <button @click="isDark = !isDark" class="p-2 rounded-xl bg-gray-100 dark:bg-gray-800 hover:scale-110 transition">
              <i :class="isDark ? 'fa-solid fa-sun text-yellow-400' : 'fa-solid fa-moon text-indigo-600'"></i>
            </button>
            <div class="relative"><i class="fa-solid fa-cart-shopping text-xl"></i><span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] rounded-full h-4 w-4 flex items-center justify-center">2</span></div>
          </div>
        </div>
      </nav>

      <section class="relative group h-[400px] md:h-[600px] overflow-hidden">
        <div class="flex h-full transition-transform duration-1000 ease-in-out" :style="{ transform: `translateX(-${activeSlide * 100}%)` }">
          <div v-for="(slide, i) in slides" :key="i" class="min-w-full h-full relative">
            <img :src="slide.img" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/20 to-transparent flex items-center">
              <div class="container mx-auto px-10">
                <h2 class="text-5xl md:text-7xl font-black text-white mb-6 animate-pulse">{{ slide.title }}</h2>
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-bold shadow-lg shadow-indigo-500/30 transition-all">Explore Collection</button>
              </div>
            </div>
          </div>
        </div>
        <button @click="prevSlide" class="absolute left-5 top-1/2 -translate-y-1/2 p-4 bg-white/10 backdrop-blur-md rounded-full text-white hover:bg-white/20"><i class="fa-solid fa-arrow-left"></i></button>
        <button @click="nextSlide" class="absolute right-5 top-1/2 -translate-y-1/2 p-4 bg-white/10 backdrop-blur-md rounded-full text-white hover:bg-white/20"><i class="fa-solid fa-arrow-right"></i></button>
      </section>

      <section class="container mx-auto px-6 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
          
          <div class="space-y-4">
            <div class="aspect-[4/5] rounded-[3rem] overflow-hidden bg-gray-200 dark:bg-gray-800 shadow-2xl">
              <img :src="product.images[activeImg]" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
            </div>
            <div class="flex gap-4">
              <img v-for="(img, i) in product.images" :key="i" :src="img" 
                   @click="activeImg = i"
                   :class="activeImg === i ? 'border-4 border-indigo-500' : 'opacity-50 hover:opacity-100'"
                   class="w-24 h-24 rounded-2xl object-cover cursor-pointer transition-all shadow-md">
            </div>
          </div>

          <div class="space-y-8">
            <div>
              <p class="text-indigo-500 font-black tracking-widest uppercase text-sm mb-2">Editor's Choice</p>
              <h1 class="text-4xl md:text-6xl font-black leading-tight">{{ product.name }}</h1>
              <div class="flex items-center gap-4 mt-4">
                <div class="flex text-yellow-400"><i v-for="n in 5" class="fa-solid fa-star"></i></div>
                <span class="text-gray-500 dark:text-gray-400 font-medium">(4.9/5 Rating)</span>
              </div>
            </div>

            <div class="flex items-center gap-6">
              <span class="text-5xl font-black text-indigo-600 dark:text-indigo-400">${{ product.price }}</span>
              <span class="text-2xl text-gray-400 line-through">${{ product.oldPrice }}</span>
            </div>

            <p class="text-lg text-gray-600 dark:text-gray-400 leading-relaxed">{{ product.desc }}</p>

            <div class="flex flex-wrap gap-8">
              <div>
                <h4 class="font-bold mb-3">Color Case</h4>
                <div class="flex gap-3">
                  <button v-for="c in ['#334155', '#1e293b', '#6366f1']" 
                          @click="selectedColor = c"
                          :style="{ background: c }"
                          :class="selectedColor === c ? 'ring-4 ring-offset-4 ring-indigo-500 dark:ring-offset-gray-950' : ''"
                          class="w-10 h-10 rounded-full border-2 border-white/20 transition-all"></button>
                </div>
              </div>
              <div>
                <h4 class="font-bold mb-3">Quantity</h4>
                <div class="flex items-center bg-gray-100 dark:bg-gray-800 rounded-2xl p-2 w-max">
                  <button @click="qty > 1 ? qty-- : null" class="w-10 h-10 flex items-center justify-center hover:bg-white dark:hover:bg-gray-700 rounded-xl transition">-</button>
                  <span class="px-6 font-black text-xl">{{ qty }}</span>
                  <button @click="qty++" class="w-10 h-10 flex items-center justify-center hover:bg-white dark:hover:bg-gray-700 rounded-xl transition">+</button>
                </div>
              </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-6">
              <button class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-5 rounded-[1.5rem] font-black text-lg transition-all flex items-center justify-center gap-3 shadow-xl shadow-indigo-500/20">
                <i class="fa-solid fa-bolt"></i> Buy Now
              </button>
              <button class="flex-1 bg-gray-900 dark:bg-white text-white dark:text-gray-900 py-5 rounded-[1.5rem] font-black text-lg transition-all hover:scale-105">
                Add To Cart
              </button>
            </div>
          </div>
        </div>
      </section>

      <footer class="bg-white dark:bg-gray-900 border-t dark:border-gray-800 py-10 mt-10">
        <div class="container mx-auto px-6 text-center text-gray-500 text-sm">
          <p>Full Responsive & Dark/Light Mood Enabled • 2026 LUXE.STUDIO</p>
        </div>
      </footer>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const isDark = ref(false)
const activeSlide = ref(0)
const activeImg = ref(0)
const qty = ref(1)
const selectedColor = ref('#334155')

const slides = [
  { title: "Summer Horizon '26", img: "https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=1200" },
  { title: "Future Audio Pro", img: "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=1200" },
  { title: "Urban Tech Wear", img: "https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=1200" }
]

const product = {
  name: "Signature ANC Wireless Headset",
  price: 249,
  oldPrice: 350,
  desc: "Crafted for pure auditory bliss. High-fidelity audio with world-class noise cancellation and up to 60 hours of wireless playback.",
  images: [
    "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800",
    "https://images.unsplash.com/photo-1583394838336-acd977736f90?w=800",
    "https://images.unsplash.com/photo-1484704849700-f032a568e944?w=800"
  ]
}

const nextSlide = () => { activeSlide.value = (activeSlide.value + 1) % slides.length }
const prevSlide = () => { activeSlide.value = (activeSlide.value - 1 + slides.length) % slides.length }

onMounted(() => { setInterval(nextSlide, 6000) })
</script>

<style>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
</style>