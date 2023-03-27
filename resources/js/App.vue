<template>
  <div class="">
    <div class="bg-green-500 space-x-4 text-white font-bold p-4 flex justify-center">
      <router-link :to="{ name: 'Dashboard' }">Dashboard</router-link>
      <router-link :to="{ name: 'Main' }">Main</router-link>
    </div>
    <router-view />
  </div>
</template>