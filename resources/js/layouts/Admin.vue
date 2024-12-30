<template>
  <div>
    <sidebar />
    <div class="relative md:ml-64 bg-blueGray-100">

      <admin-navbar />
      <header-stats />
      <div class="w-full">
        <router-view />
        <footer-admin />
      </div>
    </div>
  </div>
</template>
<script>
import AdminNavbar from "@/views/Navbars/AdminNavbar.vue";
import Sidebar from "@/views/Sidebar/Sidebar.vue";
import HeaderStats from "@/views/Headers/HeaderStats.vue";
import FooterAdmin from "@/views/Footers/FooterAdmin.vue";
export default {
  name: "admin-layout",
  components: {
    AdminNavbar,
    Sidebar,
    HeaderStats,
    FooterAdmin,
  },
};
</script>
