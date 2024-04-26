<script setup>
import githubIcon from '../../images/wcast.png'
import githubIconMini from '../../images/wcast-mini.png'
</script>

<template>
    <div class="navbar-brand-box">
        <a href="/" class="logo logo-dark">
           <span class="logo-sm">
               <img class="logo-app-mini" :src="githubIconMini">
           </span>
            <span class="logo-lg">
                  <img class="logo-app" :src="githubIcon">
            </span>
        </a>
        <a href="/" class="logo logo-light">
            <span class="logo-sm">
                  <img class="logo-app-mini" :src="githubIconMini">
            </span>
            <span class="logo-lg">
                  <img class="logo-app" :src="githubIcon">
            </span>
        </a>
    </div>
</template>
<style scoped>

.logo-app{
    width: 150px;
    height: auto;
}

.logo-app-mini{
    width: 50px;
    height: auto;
    padding-right: 20px;
}
</style>
