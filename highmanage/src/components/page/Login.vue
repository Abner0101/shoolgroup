<template>
    <div class="login-wrap">
        <div class="ms-login">
            <div class="ms-title">管理员后台系统</div>
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="0px" class="ms-content">
                <el-form-item prop="username">
                    <el-input v-model="ruleForm.username" placeholder="用户名">
                        <el-button slot="prepend" icon="el-icon-lx-people"></el-button>
                    </el-input>
                </el-form-item>
                <el-form-item prop="password">
                    <el-input type="password" placeholder="请输入密码" v-model="ruleForm.password" @keyup.enter.native="submitForm('ruleForm')">
                        <el-button slot="prepend" icon="el-icon-lx-lock"></el-button>
                    </el-input>
                </el-form-item>
                <div class="login-btn">
                    <el-button type="primary" @click="submitForm('ruleForm')">登录</el-button>
                </div>
                <p class="login-tips">Tips : 请输入用户名和密码。</p>
            </el-form>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                ruleForm: {
                    username: '',
                    password: ''
                },
                rules: {
                    username: [
                        { required: true, message: '请输入用户名', trigger: 'blur' }
                    ],
                    password: [
                        { required: true, message: '请输入密码', trigger: 'blur' }
                    ]
                }
            }
        },
        methods: {
            submitForm(formName) {
                // console.log(this.ruleForm);
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.$axios
                        .post('http://www.clubs.org/index.php/' + 'm_login',this.ruleForm)
                        .then((res)=>{
                            let respose=res.data;
                            if(respose.code == 200){
                                // console.log(respose.data);
                                // return false;
                                localStorage.setItem('m_authKey',respose.data.m_authKey);
                                localStorage.setItem('m_sessionId',respose.data.m_sessionId);
                                localStorage.setItem('id',respose.data.userInfo.id);
                                localStorage.setItem('username',respose.data.userInfo.username);
                                localStorage.setItem('status',respose.data.userInfo.status);
                                // let routeData = this.$router.resolve({
                                //   name: "Index"
                                // });
                                this.common.toastMsg('登录成功','success');
                                // localStorage.setItem('ms_username',respose.data.userInfo.m_name);
                                setTimeout(()=>{
                                    // window.location.reload();
                                    this.$router.push('/dashboard');
                                },1000);
                            }else{
                                this.common.toastMsg(respose.error,'error');
                            }
                        })    
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            }
        }
    }
</script>

<style scoped>
    .login-wrap{
        position: relative;
        width:100%;
        height:100%;
        background-image: url(../../assets/img/login-bg1.jpg);
        background-size: 100%;
    }
    .ms-title{
        width:100%;
        line-height: 50px;
        text-align: center;
        letter-spacing: 2px;
        font-size:20px;
        font-weight: bold;
        color: #409EFF;
        border-bottom: 1px solid #ddd;
    }
    .ms-login{
        position: absolute;
        left:50%;
        top:50%;
        width:380px;
        margin:-190px 0 0 -175px;
        border-radius: 5px;
        background: rgba(255,255,255, 0.8);
        overflow: hidden;
    }
    .ms-content{
        padding: 30px 30px;
    }
    .login-btn{
        text-align: center;
    }
    .login-btn button{
        width:100%;
        height:36px;
        margin-bottom: 10px;
        margin-top: 15px;
    }
    .login-tips{
        font-size:12px;
        line-height:30px;
        color:#409EFF;
    }
</style>