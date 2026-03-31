<template>
  <section class="relative w-full overflow-hidden bg-gray-100 dark:bg-gray-900 px-4 py-6">
    <div class="container mx-auto">
      <div class="relative h-[300px] md:h-[500px] w-full rounded-[2.5rem] overflow-hidden shadow-2xl">
        
        <div 
          class="flex h-full transition-transform duration-700 ease-in-out" 
          :style="{ transform: `translateX(-${currentSlide * 100}%)` }"
        >
          <div 
            v-for="(slide, index) in slides" 
            :key="index"
            class="min-w-full h-full relative"
          >
            <img :src="slide.image" :alt="slide.title" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/30 to-transparent flex items-center">
              <div class="px-8 md:px-16 max-w-2xl text-white">
                <span class="inline-block px-4 py-1 rounded-full bg-indigo-600 text-xs font-bold uppercase tracking-widest mb-4 animate-bounce">
                  {{ slide.tag }}
                </span>
                <h2 class="text-4xl md:text-6xl font-black mb-4 leading-tight">
                  {{ slide.title }}
                </h2>
                <p class="text-lg text-gray-200 mb-8 hidden md:block">
                  {{ slide.description }}
                </p>
                <div class="flex gap-4">
                  <button class="bg-white text-gray-900 px-8 py-3 rounded-xl font-bold hover:bg-indigo-500 hover:text-white transition-all transform hover:-translate-y-1">
                    Shop Now
                  </button>
                  <button class="border border-white/50 backdrop-blur-sm px-8 py-3 rounded-xl font-bold hover:bg-white/10 transition">
                    View Details
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <button 
          @click="prevSlide" 
          class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/20 hover:bg-white/40 backdrop-blur-md text-white flex items-center justify-center transition"
        >
          <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button 
          @click="nextSlide" 
          class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/20 hover:bg-white/40 backdrop-blur-md text-white flex items-center justify-center transition"
        >
          <i class="fa-solid fa-chevron-right"></i>
        </button>

        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-3">
          <button 
            v-for="(_, index) in slides" 
            :key="index"
            @click="currentSlide = index"
            class="h-2 rounded-full transition-all duration-300"
            :class="currentSlide === index ? 'w-8 bg-indigo-500' : 'w-2 bg-white/50'"
          ></button>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const currentSlide = ref(0)
let timer = null

const slides = [
  {
    tag: "New Arrival",
    title: "Next-Gen Wireless Audio Experience",
    description: "Immerse yourself in pure sound with our latest noise-cancelling technology. Limited edition colors available.",
    image: "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=1200"
  },
  {
    tag: "Summer Sale",
    title: "Step Up Your Lifestyle Fashion",
    description: "Get up to 50% off on all premium sneakers and sports apparel this season. Move with style.",
    image: "https://images.unsplash.com/photo-1460353581641-37baddab0fa2?w=1200"
  },
  {
    tag: "Limited Stock",
    title: "Elegance on Your Wrist",
    description: "Modern smartwatches designed for both health and luxury. Experience the future of timekeeping.",
    image: "https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=1200"
  }
]

const nextSlide = () => {
  currentSlide.value = (currentSlide.value + 1) % slides.length
}

const prevSlide = () => {
  currentSlide.value = (currentSlide.value - 1 + slides.length) % slides.length
}

// Auto-play logic
const startTimer = () => {
  timer = setInterval(nextSlide, 5000)
}

const stopTimer = () => {
  if (timer) clearInterval(timer)
}

onMounted(() => {
  startTimer()
})

onUnmounted(() => {
  stopTimer()
})
</script>

<style scoped>
/* Custom curve for smoother slide movement */
.transition-transform {
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}
</style>