<template>
    <div class="bgstyle">
        <div class="login" v-if="showLogin">
            <el-form :model="LoginMessage" :rules="rules" ref="LoginMessage" label-position="left" label-width="0px" class="demo-ruleForm card-box loginform">
                    <div class="titlestyle">登录</div>
                    <el-form-item prop="m_number" >
                        <el-input type="text" placeholder="学号" v-model="LoginMessage.m_number" :disabled='IsDisabled' auto-complete="off" @keyup.enter.native = "handleSubmitLogin('LoginMessage')" suffix-icon="el-icon-star-on"></el-input>
                    </el-form-item>
                    <el-form-item prop="m_password" >
                        <el-input type="password" placeholder="密码" v-model="LoginMessage.m_password" :disabled='IsDisabled' auto-complete="off" @keyup.enter.native = "handleSubmitLogin('LoginMessage')" suffix-icon="el-icon-goods"></el-input>
                    </el-form-item>
                    <!-- <el-checkbox style="margin:0px 0px 15px 0px;" disabled>记住密码</el-checkbox> -->
                    <div class="register" @click="toPhone()" style="margin:0px 0px 15px 0px;"><a>忘记密码？短信登录——</a></div>
                    <el-form-item style="width:100%;">
                        <el-button type="primary" style="width:100%;" v-loading="loading" @click="handleSubmitLogin('LoginMessage')">登录</el-button>
                    </el-form-item>
                    <div class="register" @click="toRegister()"><a>未注册？请先注册——</a></div>
            </el-form>
        </div>

        <div class="login" v-if="showPhoneLogin">
            <el-form :model="PhoneMessage" :rules="rules" ref="PhoneMessage" label-position="left" label-width="0px" class="demo-ruleForm card-box loginform">
                    <div class="titlestyle">短信登录</div>
                    <el-form-item prop="m_phone" >
                        <el-input type="text" placeholder="手机号码" v-model="PhoneMessage.m_phone" :disabled='IsDisabled' auto-complete="off" @keyup.enter.native = "handleSubPhone('PhoneMessage')" suffix-icon="el-icon-mobile-phone"></el-input>
                    </el-form-item>
                    <el-form-item prop="code" >
                        <el-input type="text" placeholder="短信验证码" v-model="PhoneMessage.code" :disabled='IsDisabled' auto-complete="off" style="width:67%;" @keyup.enter.native = "handleSubPhone('PhoneMessage')" suffix-icon="el-icon-more-outline"></el-input>
                        <el-button type="primary" style="width:30%;" @click="getsms()" :disabled="smsDisable">{{sms}}</el-button>
                    </el-form-item>
                    <!-- <el-checkbox style="margin:0px 0px 15px 0px;" disabled>记住密码</el-checkbox> -->
                    <div class="register" @click="toLogin()" style="margin:0px 0px 15px 0px;"><a>学号登录——</a></div>
                    <el-form-item style="width:100%;">
                        <el-button type="primary" style="width:100%;" v-loading="loading" @click="handleSubPhone('PhoneMessage')">登录</el-button>
                    </el-form-item>
                    <div class="register" @click="toRegister()"><a>未注册？请先注册——</a></div>
            </el-form>
        </div>

        <div class="login" v-if="showReg">
            <el-form :model="RegMessage" :rules="rules" ref="RegMessage" label-position="left" label-width="0px" class="demo-ruleForm card-box loginform">
                    <div class="titlestyle">注册</div>
                    <el-form-item prop="m_number" >
                        <el-input type="text" placeholder="学号" v-model="RegMessage.m_number" :disabled='IsDisabled' auto-complete="off" @keyup.enter.native = "handleSubmitRegister('RegMessage')" suffix-icon="el-icon-star-on"></el-input>
                    </el-form-item>
                    <el-form-item prop="m_password" >
                        <el-input type="password" placeholder="密码" v-model="RegMessage.m_password" :disabled='IsDisabled' auto-complete="off" @keyup.enter.native = "handleSubmitRegister('RegMessage')" suffix-icon="el-icon-goods"></el-input>
                    </el-form-item>
                    <el-form-item prop="m_name" >
                        <el-input type="text" placeholder="姓名" v-model="RegMessage.m_name" :disabled='IsDisabled' auto-complete="off" @keyup.enter.native = "handleSubmitRegister('RegMessage')" suffix-icon="el-icon-edit"></el-input>
                    </el-form-item>
                    <el-form-item prop="m_phone" >
                        <el-input type="text" placeholder="手机号码" v-model="RegMessage.m_phone" :disabled='IsDisabled' auto-complete="off" @keyup.enter.native = "handleSubmitRegister('RegMessage')" suffix-icon="el-icon-mobile-phone"></el-input>
                    </el-form-item>
                    <el-form-item prop="code" >
                        <el-input type="text" placeholder="短信验证码" v-model="RegMessage.code" :disabled='IsDisabled' auto-complete="off" style="width:67%;" @keyup.enter.native = "handleSubmitRegister('RegMessage')" suffix-icon="el-icon-more-outline"></el-input>
                        <el-button type="primary" style="width:30%;" @click="getsms()" :disabled="smsDisable">{{sms}}</el-button>
                    </el-form-item>
                    <el-form-item style="width:100%;">
                        <el-button type="primary" style="width:100%;" v-loading="loading" @click="handleSubmitRegister('RegMessage')">注册</el-button>
                    </el-form-item>
                    <div class="register" @click="toLogin()"><a>——已注册？返回登录</a></div>
            </el-form>
        </div>
    </div>
</template>
<script>
    import http from '../../assets/js/http.js'
    export default {
        name:'Login',
        data() {
            return {
                showLogin:true,
                showReg:false,
                loading:false,
                IsDisabled:false,
                smsDisable:false,
                showPhoneLogin:false,
                sms:"获取验证码",
                LoginMessage:{
                    m_number:'',
                    m_password:''
                },
                PhoneMessage:{
                    m_phone:'',
                    code:''
                },
                RegMessage:{
                    m_number:'',
                    m_password:'',
                    m_name:'',
                    m_phone:'',
                    code:''
                },
                rules:{
                  m_number:[
                    {required:true,message:'请输入学号',trigger:'blur'}
                  ],
                  m_password:[
                    {required:true,message:'请输入密码',trigger:'blur'}
                  ],
                  m_phone:[
                    {required:true,message:'请输入手机号码',trigger:'blur'}
                  ],
                  code:[
                    {required:true,message:'请输入短信验证码',trigger:'blur'}
                  ],
                  m_name:[
                    {required:true,message:'请输入您的真实姓名',trigger:'blur'}
                  ]
                }
            }
        },
        created() {
          document.title = "登录";
        },
        methods:{
            //登录
            handleSubmitLogin(LoginMessage){
                // console.log(LoginMessage);
                if(this.loading) return
                this.$refs[LoginMessage].validate((valid) => {
                  if (valid) {
                    this.loading = !this.loading;
                    this.IsDisabled = !this.IsDisabled;
                    this.apiPost( 'http://www.clubs.org/index.php/' + 'login',this.LoginMessage).then((res) => {
                      if(res.code == 200){
                        sessionStorage.setItem('authKey',res.data.authKey);
                        sessionStorage.setItem('sessionId',res.data.sessionId);
                        sessionStorage.setItem('m_id',res.data.userInfo.id);
                        sessionStorage.setItem('m_name',res.data.userInfo.m_name);
                        sessionStorage.setItem('m_number',res.data.userInfo.m_number);
                        let routeData = this.$router.resolve({
                          name: "Index"
                        });
                        this.common.toastMsg('登录成功','success');
                        setTimeout(function(){
                          window.location.reload();
                          window.open(routeData.href, '_self');
                        },1500);              
         
                      }else{
                        this.common.toastMsg('账号或密码错误','error');
                        this.loading = !this.loading;
                        this.IsDisabled = !this.IsDisabled;
                      }
                    })      
                  } else {
                    return false
                  }
                })
            },

            //注册
            handleSubmitRegister(RegMessage){
                // console.log(this.RegMessage); 
                if(this.loading) return
                this.$refs[RegMessage].validate((valid) => {
                  if (valid) {
                    this.loading = !this.loading;
                    this.IsDisabled = !this.IsDisabled;
                    this.apiPost( 'http://www.clubs.org/index.php/' + 'register',this.RegMessage).then((res) => {
                      if(res.code == 200){
                        // localStorage.setItem('authKey',res.data.authKey);
                        // localStorage.setItem('sessionId',res.data.sessionId);
                        // localStorage.setItem('m_number',res.data.userInfo.m_number);
                        let routeData = this.$router.resolve({
                          name: "Login"
                        });
                        this.common.toastMsg('注册成功','success');
                        setTimeout(function(){
                          window.location.reload();
                          window.open(routeData.href, '_self');
                        },1500);              
         
                      }else{
                        this.common.toastMsg(res.error,'warning');
                        this.loading = !this.loading;
                        this.IsDisabled = !this.IsDisabled;
                      }
                    })      
                  } else {
                    return false;
                  }
                })
            },

            handleSubPhone(PhoneMessage){
                if(this.loading) return
                this.$refs[PhoneMessage].validate((valid) => {
                  if (valid) {
                    this.loading = !this.loading;
                    this.IsDisabled = !this.IsDisabled;
                    this.apiPost( 'http://www.clubs.org/index.php/' + 'phonelogin',this.PhoneMessage).then((res) => {
                      if(res.code == 200){
                        sessionStorage.setItem('authKey',res.data.authKey);
                        sessionStorage.setItem('sessionId',res.data.sessionId);
                        sessionStorage.setItem('m_id',res.data.userInfo.id);
                        sessionStorage.setItem('m_name',res.data.userInfo.m_name);
                        let routeData = this.$router.resolve({
                          name: "Index"
                        });
                        this.common.toastMsg('登录成功','success');
                        setTimeout(function(){
                          window.location.reload();
                          window.open(routeData.href, '_self');
                        },1500);              
         
                      }else{
                        this.common.toastMsg('账号或密码错误','error');
                        this.loading = !this.loading;
                        this.IsDisabled = !this.IsDisabled;
                      }
                    })      
                  } else {
                    return false
                  }
                })
            },
            //获取验证码
            getsms(){
                // console.log(this.RegMessage);
                if(this.showPhoneLogin){
                    var Message=this.PhoneMessage;
                }
                if(this.showReg){
                    var Message=this.RegMessage;
                }
                this.apiPost( 'http://www.clubs.org/index.php/' + 'getSms',Message).then((res)=>{
                        if(res.status=true){
                            this.smsDisable=true;
                            var second=60;
                            var t1=setInterval(()=>{
                                // console.log(second);
                                second--;
                                this.sms=second+'秒';
                                if(second==0){
                                    clearInterval(t1);
                                    this.smsDisable=false;
                                    this.sms='获取验证码';
                                }
                            }, 1000); 
                        }
                    }
                )
            },

            toPhone(){
                this.showPhoneLogin=true;
                this.showReg=false;
                this.showLogin=false;
                document.title = "短信登录";
            },

            toRegister(){
                this.showLogin=false;
                this.showReg=true;
                this.showPhoneLogin=false;
                document.title = "注册";
            },

            toLogin(){
                this.showLogin=true;
                this.showReg=false;
                this.showPhoneLogin=false;
                document.title = "登录";
            }


        },
        mixins:[http],
}
</script>

<style scoped>
.bgstyle{
    width: 100vw;
    height: 100vh;
    position: relative;
    background:url(../../assets/images/login_bg.jpg) no-repeat center;
    background-size: cover;
}
.login{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    min-height: 350px;
    min-width: 380px;
    padding: 20px;
    background: rgba(255,255,255, 0.95);
    border-radius: 10px;
    /* overflow-x: hidden; */
    box-sizing: border-box;
}
.titlestyle{
    height: 15%;
    padding: 5px 10px;
    text-align: center;
    color: #409EFF;
    font-size: 20px;
    font-weight: bold;
    letter-spacing:15px;
    border-bottom: 1px solid #409EFF;
    margin-bottom: 20px;
}
.register{
    color: #409EFF;
}
.register>a:hover{
    color: red;
    cursor: pointer;
}
</style>
