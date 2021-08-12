<template>
    <div class="col-lg-6">
    <div class="p-5">
      <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Halo, Selamat Datang!</h1>
      </div>
      <form id="form-login" @submit.prevent="handleSubmit">
        <input type="hidden" name="next" value="#">
        <div class="form-group">
          <input type="text" class="form-control form-control-user " id="exampleInputEmail" aria-describedby="emailHelp" name="username" placeholder="Enter Email.." value="" v-model="form.username" required autocomplete="off" autofocus>
                            </div>
        <div class="form-group">
          <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" v-model="form.password" placeholder="Password">
                            </div>
        <div class="form-group">
          <div class="custom-control custom-checkbox small">
            <input type="checkbox" class="custom-control-input" v-model="form.cekpassword" id="cekpassword" >
            <label id="cektext" class="custom-control-label" for="cekpassword">Show Password</label>
          </div>
        </div>
        <div class="form-group">
          <div class="custom-control custom-checkbox small">
            <input type="checkbox" class="custom-control-input" id="customCheck" v-model="form.remember" name="remember" >
            <label class="custom-control-label" for="customCheck">Remember Me</label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
       
      </form>
      <hr>
      <div class="text-center">
        <router-link :to="{ name: 'Register' }" class="small">Create an Account!</router-link>
      </div>
      <div class="text-center">
        <a class="small" href="/"><b>>> Back to Home</b></a>
      </div>
      
    </div>
  </div>
</template>
<script>

export default {
    data() {
        return {
            form : {
                username:'',
                password:'',
                remember:'',
                cekpassword:'',
            }
        }
    },
    created(){
       
        $(document).on('change', '#cekpassword', function(){
            let pass = $('#exampleInputPassword')
            let xpass = $('#exampleRepeatPassword')
            if($(this).is(':checked')){
            pass.attr('type','text')
            xpass.attr('type','text')
            $('#cektext').html('Hide Password')
            }else{
            pass.attr('type','password')
            xpass.attr('type','password')
            $('#cektext').html('Show Password')
            }
        })
    },
    methods:{
        handleSubmit() {
            axios.post('/login', this.form).then((response) => {
                console.log(response)
                let data = response.data; 
                if(data.status){
                    localStorage.setItem('user',JSON.stringify(data.data))
                    localStorage.setItem('jwt',data.token)
                    this.$noty.success(data.message, {
                        killer: true,
                        timeout: 6000,
                        layout: 'topRight'
                    })
                    window.location.href = '/panel/dashboard';
                }else{
                    this.form.username = ''
                    this.form.password = ''
                    this.form.remember = ''
                    this.form.cekpassword = ''
                    this.$noty.error(data.message, {
                        killer: true,
                        timeout: 6000,
                        layout: 'topRight'
                    })
                }
            }).catch((error) => {
                console.log(error)
            })

        }
    }
}
</script>