<template>
<div class="col-lg-7">
    <div class="p-5">
      <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru!</h1>
      </div>
      <form class="user" @submit.prevent="handleSubmit" method="post">
        <div class="form-group ">
            <input type="text" class="form-control form-control-user" v-model="form.name" id="exampleFirstName" name="name" placeholder="Full Name"  required="">
        </div>
        <div class="form-group">
          <input type="email" class="form-control form-control-user" id="exampleInputEmail" v-model="form.email" name="email" placeholder="Email Address"  required="">
                            </div>
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" v-model="form.password" placeholder="Password" required="">
          </div>
          <div class="col-sm-6">
            <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" name="confirm_password" v-model="form.confirm_password" placeholder="Repeat Password" required="">
          </div>
        <div class="col-md-12">
            <div id="valid">
              
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="custom-control custom-checkbox small">
            <input type="checkbox" class="custom-control-input" v-model="form.cekpassword" id="cekpassword">
            <label id="cektext" class="custom-control-label" for="cekpassword">Show Password</label>
          </div>
        </div>
            <button type="submit" id="tombol" class="btn btn-primary btn-user btn-block disabled">Register Account</button>
      </form>
      <hr>
      <div class="text-center">
        <router-link :to="{ name: 'Login' }" class="small">Already have an account? Login!</router-link>
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
                name:'',
                email:'',
                password:'',
                confirm_password:'',
                cekpassword:'',
            }
        }
    },
    created(){
        $(document).on('keyup', '#exampleRepeatPassword', function(){
            let valid = $('#valid')
            let pass = $('#exampleInputPassword').val()
            let xpass = $(this).val();
            if(pass != xpass){
            valid.attr('class','text-danger')
            valid.html('<br><i class="fa fa-times-circle"></i> Password tidak sama')
            $('#tombol').attr('class','btn btn-primary btn-user btn-block disabled')
            $('#tombol').attr('type','button')
            }else{
            valid.attr('class','text-success')
            valid.html('<br><i class="fa fa-check-circle"></i> Password sama')
            $('#tombol').attr('class','btn btn-primary btn-user btn-block')
            $('#tombol').attr('type','submit')
            }
        });
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
            axios.post('/register', this.form).then((response) => {
                console.log(response)
                let data = response.data; 
                if(data.status){
                    this.$noty.success(data.message, {
                        killer: true,
                        timeout: 6000,
                        layout: 'topRight'
                    })
                    this.$router.push({ name: 'Login' });
                }else{
                    this.form.name = ''
                    this.form.email = ''
                    this.form.password = ''
                    this.form.confirm_password = ''
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