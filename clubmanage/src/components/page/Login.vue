           <template>
    <div class="login-wrap">
        <div class="ms-login">
            <div class="ms-title">社团后台管理系统</div>
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="0px" class="ms-content">
                <el-form-item prop="m_numbe">
                    <el-input v-model="ruleForm.m_number" placeholder="请输入学号">
                        <el-button slot="prepend" icon="el-icon-lx-people"></el-button>
                    </el-input>
                </el-form-item>
                <el-form-item prop="m_password">
                    <el-input type="password" placeholder="请输入密码" v-model="ruleForm.m_password" @keyup.enter.native="submitForm('ruleForm')">
                        <el-button slot="prepend" icon="el-icon-lx-lock"></el-button>
                    </el-input>
                </el-form-item>
                <div class="login-btn">
                    <el-button type="primary" @click="submitForm('ruleForm')">登录</el-button>
                </div>
                <!-- <p class="login-tips">Tips : 用户名和密码随便填。</p> -->
            </el-form>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                ruleForm: {
                    m_number: '',
                    m_password: ''
                },
                rules: {
                    m_number: [
                        { required: true, message: '请输入学号', trigger: 'blur' }
                    ],
                    m_password: [
                        { required: true, message: '请输入密码', trigger: 'blur' }
                    ]
                }
            }
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.$axios
                        .post('http://www.clubs.org/index.php/' + 'C_login',this.ruleForm)
                        .then((res)=>{
                            let respose=res.data;
                            if(respose.code == 200){
                                // console.log(respose.data);
                                // return false;
                                localStorage.setItem('c_authKey',respose.data.c_authKey);
                                localStorage.setItem('c_sessionId',respose.data.c_sessionId);
                                localStorage.setItem('m_id',respose.data.userInfo.id);
                                localStorage.setItem('m_name',respose.data.userInfo.m_name);
                                localStorage.setItem('departId',respose.data.userInfo.depart);
                                localStorage.setItem('right',respose.data.userInfo.clue_right);
                                // let routeData = this.$router.resolve({
                                //   name: "Index"
                                // });
                                this.common.toastMsg('登录成功','success');
                                // localStorage.setItem('ms_username',respose.data.userInfo.m_name);
                                setTimeout(()=>{
                                    // window.location.reload();
                                    this.$router.push('/');
                                },1500);
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
        },
        created() {
          document.title = "社团后台管理系统";
        },
    }
</script>

<style scoped>
    .login-wrap{
        position: relative;
        width:100%;
        height:100%;
        background-image: url(../../assets/img/login-bg.jpg);
        background-size: 100%;
    }
    .ms-title{
        width:100%;
        line-height: 50px;
        text-align: center;
        font-size:20px;
        color: #409EFF;
        border-bottom: 1px solid #ddd;
    }
    .ms-login{
        position: absolute;
        left:50%;
        top:50%;
        transform: translate(-50%, -50%);
        width:400px;
        /* margin:-190px 0 0 -175px; */
        height: 280px;
        border-radius: 10px;
        background: rgba(255,255,255, 0.7);
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
        margin-top: 20px;
    }
    .login-tips{
        font-size:12px;
        line-height:30px;
        color:#fff;
    }
</style>