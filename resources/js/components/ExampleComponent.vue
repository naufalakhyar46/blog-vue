<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                        <br>
                        <a href="" @click.prevent="logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
        return { 
         user: null,
         isLoggedIn: null, 
        }
        },
        watch : {
            '$route':'getData',
        },
        mounted() {
        this.getData()   
        },
        methods : {  
            getData(){
                console.log(localStorage.getItem('jwt'))
                console.log(JSON.parse(localStorage.getItem('user')))
                this.isLoggedIn = localStorage.getItem('jwt') !== null; 
                this.user = JSON.parse(localStorage.getItem('user')) 
            },
            logout(){
                axios.defaults.headers.common['Content-Type'] = 'application/json'
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')
                axios.get('api/logout').then((response) => {
                        localStorage.removeItem('jwt')
                        localStorage.removeItem('user')
                            this.getData()  
                            // this.$router.push('/login')
                            window.location.href = '/login';
                            this.$noty.success(response.data.message, {
                                killer: true,
                                timeout: 6000,
                                layout: 'topRight'
                            })
                    }).catch((error) => {
                        // console.log(error)
                    })
                
            }
        }
    }
</script>
