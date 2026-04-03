import { createRouter, createWebHistory } from 'vue-router';

// Auth Routes
import AdminLogin from '../components/Auth/admin-login.vue'
import customerLogin from '../components/Auth/customer-login.vue';
import Register from '../components/Auth/register.vue'
import FindAccount from '../components/Auth/find-account.vue'
import otpVerification from '../components/Auth/otp-verification.vue';
import resetPassword from '../components/Auth/reset-password.vue';
import Unauthorized from '../components/Auth/unauthorized.vue';




// super admin Routes
import SuperAdminDashboard from '../components/Dashboard/super_admin/super-admin-dashboard.vue'







// vendor Routes
import VendorDashboard from '../components/Dashboard/vendor/vendor-dashboard.vue'
import VendorProfile from '../components/Dashboard/vendor/vendor-profile.vue'






import dashboard from '../components/Dashboard/dashboard.vue'
import profile from '../components/Auth/profile.vue'












// E-commerce Routes
import Home from '../components/e-commerce/home.vue'
import ProductDetails from '../components/e-commerce/product-details.vue'












// Product Routes
import CreateProduct from '../components/Dashboard/product/create-product.vue'
import ProductList from '../components/Dashboard/product/product-list.vue'
import ProductEdit from '../components/Dashboard/product/product-edit.vue'














const routes = [
  // Public Routes
  { path: '/', component: Home, meta: {title: "Home - Mercuvaix"} },
  { path: '/product-details', component: ProductDetails, meta: {title: "Product Details"} },













  // Auth Routes
  { path: '/login', component: customerLogin, meta: {title: "Login"} },
  { path: '/admin-login', component: AdminLogin, meta: {title: "Admin Login"} },
  { path: '/register', component: Register, meta: {title: "Register"} },
  { path: '/forget-password', component: FindAccount, meta: {title: "Forget Password"} },
  { path: '/otp-verification', component: otpVerification, meta: {title: "OTP Verification", requiresEmail: true} },
  { path: '/reset-password', component: resetPassword, meta: {title: "Reset Password", requiresEmail: true} },
  { path: '/unauthorized', component: Unauthorized, meta: {title: "Unauthorized"} },










  // super admin Routes
  { path: '/super-admin/dashboard', component: SuperAdminDashboard, meta: { requiresAuth: true, roles: ['super_admin'], title: "Super Admin Dashboard" } },

  // Vendor Routes
  { path: '/vendor/dashboard', component: VendorDashboard, meta: { requiresAuth: true, roles: ['vendor_owner', 'vendor_staff'], title: "Vendor Dashboard" } },
  { path: '/vendor/profile', component: VendorProfile, meta: { requiresAuth: true, roles: ['vendor_owner', 'vendor_staff'], title: "Vendor Profile" } },

  // Product Routes
  { path: '/create-product', component: CreateProduct, meta: { requiresAuth: true, roles: ['vendor_owner', 'vendor_staff'], title: "Create Product" } },
  { path: '/products', component: ProductList, meta: { requiresAuth: true, roles: ['vendor_owner', 'vendor_staff'], title: "Product Details" } },
  { path: '/product-edit/:id', component: ProductEdit, meta: { requiresAuth: true, roles: ['vendor_owner', 'vendor_staff'], title: "Edit Product" } },

  // admin Routes
  { path: '/dashboard', component: dashboard, meta: { requiresAuth: true, title: "Dashboard" } },
  { path: '/profile', component: profile, meta: { requiresAuth: true, title: "Profile" } },
]












const router = createRouter({
  history: createWebHistory(),
  routes,
});

// security check
router.beforeEach((to, from, next) => {
  
  const token = localStorage.getItem("token");
  const user = JSON.parse(localStorage.getItem('user'));

  // Set page title
  if (to.meta.title) {
    document.title = to.meta.title;
  }

  // Check if route requires email
  if (to.meta.requiresEmail) {
    const email = localStorage.getItem('email')
    if (!email) {
      // Email not found, redirect to forget-password
      return next('/forget-password');
    }
  }

  if (to.meta.requiresAuth && !token) {
    return next('/admin-login');
  }

  if (to.meta.roles) {
    if (!user) {
      return next('/admin-login');
    }

    if (!to.meta.roles.includes(user.role)) {
      return next('/unauthorized');
    }
  }

  next();
});

export default router
