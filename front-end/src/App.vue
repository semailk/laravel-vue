<template>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mt-2">
      <div class="collapse navbar-collapse">
        <div class="navbar-nav">
          <router-link :to="{ name: 'home'}" :class="getActiveNavLink('secondRoute')">Home</router-link>
          <router-link  :to="{ name: 'add-employee'}" :class="getActiveNavLink('secondRoute')">Add Employee</router-link>
          <router-link  :to="{name: 'add-client'}"  :class="getActiveNavLink('secondRoute')">Add Client</router-link>
          <router-link  :to="{name: 'add-rent'}"  :class="getActiveNavLink('secondRoute')">Add Rent</router-link>
          <router-link  :to="{name: 'add-booking'}"  :class="getActiveNavLink('secondRoute')">Booking</router-link>
        </div>
      </div>
    </nav>
    <br/>
    <router-view></router-view>
  </div>
</template>
<script>
  export default {
    methods: {
      getActiveNavLink(name) {
        let classString = "nav-item nav-link "

        if (this.$route.name === name) {
          classString += "active"
        }
        return classString;
      }
    }
  }
</script>
<style>
  .nav-link {
    text-decoration: none;
    background-image: linear-gradient(currentColor, currentColor);
    background-position: 0% 100%;
    background-repeat: no-repeat;
    background-size: 0% 2px;
    transition: background-size 1.3s;
  }
  .nav-link:hover {
    background-size: 100% 2px;
  }
  .router-link-active {
    text-decoration: none;
    background-image: linear-gradient(currentColor, currentColor);
    background-position: 0% 100%;
    background-repeat: no-repeat;
    background-size: 100% 2px;
  }
</style>