<template>
    <nav class="navbar">
        <router-link to="/" class="navbar__brand">
            vuesplash
        </router-link>
        <div class="navbar__menu">
            <div v-if="isLogin" class="navbar__item">
                <button @click="showForm = !showForm" class="button">
                    <i class="icon ion-md-add"></i>
                    Submit a photo
                </button>
            </div>
            <span v-if="isLogin" class="navbar__item">
                {{ username }}
            </span>
            <div v-else class="navbar__item">
                <router-link class="button button--link" to="/login">
                    Login / Register
                </router-link>
            </div>
        </div>
        <PhotoForm v-model="showForm"></PhotoForm>
    </nav>
</template>

<script>
import PhotoForm from "./PhotoForm.vue";
export default {
    components: {
        PhotoForm
    },
    data() {
        return {
            showForm: false
        };
    },
    computed: {
        isLogin() {
            return this.$store.getters["auth/check"];
        },
        username() {
            return this.$store.getters["auth/username"];
        }
    }
};
</script>
