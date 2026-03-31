<template>
  <!-- Overlay (mobile) -->
  <div
    class="fixed inset-0 z-40 lg:hidden bg-black/40 dark:bg-black/60"
    v-show="open"
    @click="$emit('close')"
  />

  <aside
    class="fixed inset-y-0 left-0 z-50 w-72
      border-r transform transition-transform duration-200
      lg:static lg:translate-x-0 lg:h-auto
      overflow-y-auto
      bg-white text-slate-900 border-slate-200
      dark:bg-slate-900 dark:text-slate-100 dark:border-white/10"
    :class="open ? 'translate-x-0' : '-translate-x-full'">
    <!-- Brand -->
    <div class="h-16 px-5 flex items-center gap-3 border-b border-slate-200 dark:border-white/10">
      <router-link to="/super-admin/dashboard">
        <span class="h-9 w-9 rounded-xl bg-emerald-500/20 flex items-center justify-center ring-1 ring-emerald-500/30">
          <span class="h-2.5 w-2.5 rounded-full bg-emerald-400"></span>
        </span>
      </router-link>

      <router-link to="/super-admin/dashboard">
        <div class="text-lg font-semibold tracking-wide">Mercuvaix</div>
      </router-link>

      <button
        class="ml-auto p-2 rounded-lg lg:hidden hover:bg-slate-100 text-slate-700
               dark:hover:bg-white/10 dark:text-slate-200"
        aria-label="Close menu"
        @click="$emit('close')">
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <!-- Menu -->
    <nav class="p-3">
      <ul class="space-y-1">
        <!-- Dashboard -->
        <li>
          <button
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-left transition
                   focus:outline-none focus:ring-2 focus:ring-slate-500/40
                   hover:bg-slate-100 dark:hover:bg-white/10"
            :class="activeKey === 'dashboard'
              ? 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200 dark:bg-white/10 dark:text-white dark:ring-white/10'
              : ''"
            @click="pick('dashboard')">
            <span class="opacity-90 w-5 text-center">
              <i class="fa-solid fa-house"></i>
            </span>
            <span class="text-sm font-medium">Dashboard</span>
          </button>
        </li>

        <!-- Profile -->
        <li>
          <button
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-left transition
                   focus:outline-none focus:ring-2 focus:ring-slate-500/40
                   hover:bg-slate-100 dark:hover:bg-white/10"
            :class="activeKey === 'profile'
              ? 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200 dark:bg-white/10 dark:text-white dark:ring-white/10'
              : ''"
            @click="pick('profile')">
            <span class="opacity-90 w-5 text-center">
              <i class="fa-regular fa-circle-user"></i>
            </span>
            <span class="text-sm font-medium">Profile</span>
          </button>
        </li>

        <!-- Product Details Dropdown -->
        <li>
          <button
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-left transition
                   focus:outline-none focus:ring-2 focus:ring-slate-500/40
                   hover:bg-slate-100 dark:hover:bg-white/10"
            :class="pagesOpen
              ? 'bg-slate-100 ring-1 ring-slate-200 dark:bg-white/10 dark:ring-white/10'
              : ''"
            @click="pagesOpen = !pagesOpen"
            type="button">
            <span class="opacity-90">
              <i class="fa-regular fa-folder-open"></i>
            </span>
            <span class="text-sm font-medium flex-1">Product Details</span>

            <svg
              class="h-4 w-4 transition-transform opacity-80"
              :class="pagesOpen ? 'rotate-180' : ''"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>

          <div v-show="pagesOpen" class="mt-1 ml-6 mr-2 rounded-xl ring-1
                   bg-slate-50 ring-slate-200
                   dark:bg-black/20 dark:ring-white/10">
            <ul class="py-2">
              <li>
                <button
                  class="w-full px-4 py-2 text-sm text-left transition
                         hover:bg-white dark:hover:bg-white/10"
                  :class="activeKey === 'myComplain'
                    ? 'bg-white text-slate-900 font-medium dark:bg-white/10 dark:text-white'
                    : 'text-slate-700 dark:text-slate-200/90'"
                  @click="pick('myComplain')">
                  Product List
                </button>
              </li>

              <li>
                <button
                  class="w-full px-4 py-2 text-sm text-left transition
                         hover:bg-white dark:hover:bg-white/10"
                  :class="activeKey === 'create'
                    ? 'bg-white text-slate-900 font-medium dark:bg-white/10 dark:text-white'
                    : 'text-slate-700 dark:text-slate-200/90'"
                  @click="pick('create')">
                  Create Product
                </button>
              </li>

              <li>
                <button
                  class="w-full px-4 py-2 text-sm text-left transition
                         hover:bg-white dark:hover:bg-white/10"
                  :class="activeKey === 'complainList'
                    ? 'bg-white text-slate-900 font-medium dark:bg-white/10 dark:text-white'
                    : 'text-slate-700 dark:text-slate-200/90'"
                  @click="pick('complainList')">
                  Settings
                </button>
              </li>
            </ul>
          </div>
        </li>

        <!-- Order -->
        <li>
          <button
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-left transition
                   focus:outline-none focus:ring-2 focus:ring-slate-500/40
                   hover:bg-slate-100 dark:hover:bg-white/10"
            :class="activeKey === 'setting'
              ? 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200 dark:bg-white/10 dark:text-white dark:ring-white/10'
              : ''"
            @click="pick('setting')">
            <span class="opacity-90 w-5 text-center">
              <i class="fa-solid fa-cart-arrow-down"></i>
            </span>
            <span class="text-sm font-medium">Order</span>
          </button>
        </li>

        <!-- Delivery -->
        <li>
          <button
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-left transition
                   focus:outline-none focus:ring-2 focus:ring-slate-500/40
                   hover:bg-slate-100 dark:hover:bg-white/10"
            :class="activeKey === 'setting'
              ? 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200 dark:bg-white/10 dark:text-white dark:ring-white/10'
              : ''"
            @click="pick('setting')">
            <span class="opacity-90 w-5 text-center">
              <i class="fa-solid fa-truck-fast"></i>
            </span>
            <span class="text-sm font-medium">Delivery</span>
          </button>
        </li>

        <!-- Payment -->
        <li>
          <button
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-left transition
                   focus:outline-none focus:ring-2 focus:ring-slate-500/40
                   hover:bg-slate-100 dark:hover:bg-white/10"
            :class="activeKey === 'setting'
              ? 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200 dark:bg-white/10 dark:text-white dark:ring-white/10'
              : ''"
            @click="pick('setting')">
            <span class="opacity-90 w-5 text-center">
              <i class="fa-solid fa-credit-card"></i>
            </span>
            <span class="text-sm font-medium">Payment</span>
          </button>
        </li>

        <!-- Setting -->
        <li>
          <button
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-left transition
                   focus:outline-none focus:ring-2 focus:ring-slate-500/40
                   hover:bg-slate-100 dark:hover:bg-white/10"
            :class="activeKey === 'setting'
              ? 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200 dark:bg-white/10 dark:text-white dark:ring-white/10'
              : ''"
            @click="pick('setting')">
            <span class="opacity-90 w-5 text-center">
              <i class="fa-solid fa-gear"></i>
            </span>
            <span class="text-sm font-medium">Setting</span>
          </button>
        </li>

        <!-- Logout -->
        <li>
          <button
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-left transition
                   focus:outline-none focus:ring-2 focus:ring-slate-500/40
                   hover:bg-slate-100 dark:hover:bg-white/10"
            :class="activeKey === 'logout'
              ? 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200 dark:bg-white/10 dark:text-white dark:ring-white/10'
              : ''"
            @click="pick('logout')">
            <span class="opacity-90 w-5 text-center">
              <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </span>
            <span class="text-sm font-medium">Logout</span>
          </button>
        </li>
      </ul>
    </nav>
  </aside>
</template>

<script setup>
import { computed, ref, watch } from "vue";
import { useRoute, useRouter } from "vue-router";

const props = defineProps({
  open: { type: Boolean, default: false },
  modelValue: { type: String, default: "" },
});

const emit = defineEmits(["close", "update:modelValue", "navigate"]);

const route = useRoute();
const router = useRouter();

const pagesOpen = ref(false);

const routeMap = {
  dashboard: "/super-admin/dashboard",
  profile: "/profile",
  create: "/create",
  complainList: "/complain-list",
  myComplain: "/my-complain",
  // setting: "/setting",
  logout: "/admin-login",
};

const routeMatch = [
  { key: "myComplain", prefixes: ["/complaints/view", "/my-complain"] },
  { key: "complainList", prefixes: ["/complaints", "/complain-list"] },
  { key: "create", prefixes: ["/create"] },
  { key: "dashboard", prefixes: ["/super-admin/dashboard"] },
  { key: "logout", prefixes: ["/logout"] },
  { key: "profile", prefixes: ["/profile"] },
  // { key: "setting", prefixes: ["/setting"] },
];

const activeKey = computed(() => {
  const path = route.path;
  const hit = routeMatch.find((r) =>
    r.prefixes.some((pre) => path.startsWith(pre))
  );
  return hit?.key ?? "dashboard";
});

async function pick(key) {
  emit("update:modelValue", key);
  emit("navigate", key);

  if (key === "logout") {
    try {
      // await api.post("/logout");
    } catch (e) {
      // ignore
    } finally {
      localStorage.removeItem("token");
      emit("close");
      return router.push("/admin-login");
    }
  }

  const to = routeMap[key];
  if (to && route.path !== to) {
    await router.push(to);
  }

  emit("close");
}

watch(
  () => activeKey.value,
  (k) => {
    const complainKeys = ["myComplain", "create", "complainList"];
    if (complainKeys.includes(k)) {
      pagesOpen.value = true;
    }
  },
  { immediate: true }
);
</script>