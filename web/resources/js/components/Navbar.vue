<template>
  <nav class="navbar">
      <router-link to="/" class="navbar__brand">
        vuesplash
      </router-link>
    <div class="navbar__menu">
      <div class="navbar__item">
        <button class="button">
          <i class="icon ion-md-add"></i>
          Submit a photo
        </button>
      </div>
      <span class="navbar__item">
        username
      </span>
      <div class="navbar__item">
        <router-link class="button button--link" to="/login">
          Login / Register
        </router-link> 
      </div>
    </div>
  </nav>
</template>