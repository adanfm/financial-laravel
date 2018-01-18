<template>
    <div class="container" id="login-panel">
        <div class="row">
            <div class="card-panel col s6 offset-s3 z-depth-2">
                <h5 class="center">Efetuando logout ...</h5>

                <div class="progress">
                    <div class="indeterminate"></div>
                </div>
            </div>
        </div>
    </div>

</template>
<script type="text/javascript">
    import Auth  from "../services/auth";
    export default {
        ready() {
            setTimeout(() => {
                this.logout();
            }, 1000);
        },
        methods: {
            logout() {
                let goToLogin = () => {this.$router.go({name: 'auth.login'})};
                Auth.logout()
                    .then(goToLogin)
                    .catch(goToLogin);
            }
        }
    }
</script>