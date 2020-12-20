<template>
    <footer class="footer">
        <button class="button button--link" v-if="isLogin" @click="logout">
            Logout
        </button>
        <router-link v-else class="button button--link" to="/login">
            Login / Register
        </router-link>
    </footer>
</template>

<script>
import { mapState, mapGetters } from 'vuex'

export default {
    computed: {
        ...mapState({
            apiStatus: state => state.auth.apiStatus
        }),
        ...mapGetters({
            isLogin: "auth/check"
        })
    },
    methods: {
        async logout() {
            await this.$store.dispatch("auth/logout");

            if (this.apiStatus) {
                this.$router.push("/login");
            }
        }
    }
};
</script>
