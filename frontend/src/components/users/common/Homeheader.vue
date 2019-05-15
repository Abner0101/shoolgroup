<template>
  <div>
    <header class="ltHead">
        <div class="ltHead_cen">
            <a><router-link to="/"><img src="../../../assets/images/logo2.png" alt="" class="headPic1"/></router-link></a>
            <ul class="headNav">
                <li>
                    <a>
                        <router-link to="/">社团中心</router-link>
                    </a>
                </li>
                <li>
                    <a href="https://720yun.com/t/67b27wbfw1i?scene_id=75929" target="_blank">
                        校园导航
                        <!-- <router-link to="/Topic">莞工论坛</router-link> -->
                    </a>
                </li>
            </ul>
            <!--未登入开始-->
            <div class="ltForm" >
                <a @click="isLogin"><img src="../../../assets/images/indexForm_bg.png" alt="" class="headPic2" title="个人中心"></a>
                <a @click="isLogin">{{loginMessage}}</a>
                <a v-if="showExit" @click="outLogin"><img src="../../../assets/images/indexTc.png" />退出</a>
                   <!--  <li><a href="">注册</a></li> -->
                
                <!-- <a href="" class="navWrite" v-if="isLogin">发新帖</a> -->
            </div>
            <!-- 未登入结束-->
            <!-- 登入开始，未登入时以下隐藏-->
            <!--<div class="lt_login appear">-->
            <!--<ul>-->
            <!--<li><a href="">花开花落</a></li>-->
            <!--<li><a href="">退出</a></li>-->
            <!--</ul>-->
            <!--</div>-->
            <!-- 登入结束-->
            <!-- <div class="navFix" v-if="isLogin"> -->
                <!--登入开始-->
                <!-- <a href="" class="navMe">{{loginMessage}}</a> -->
                <!--登入结束-->
                <!--未登入开始-->
                <!--<a href="" class="navLogin">登录</a>-->
                <!--未登入结束-->
                <!-- <a href="" class="navWrite">发新帖</a> -->
            <!-- </div> -->
        </div>
    </header>
  </div>

</template>

<script>
  import http from '../../../assets/js/http.js'

  export default {
    name:'Homeheader',
    data() {
        return{
            loginMessage:'',
            showExit:false
        }
    },
    methods: {
        getUseMessage(){
            if(sessionStorage.getItem('m_name') == null){
                this.loginMessage="登录";
            }else{
                this.showExit=true;
                this.loginMessage = sessionStorage.getItem('m_name');
            }
        },
        isLogin(){
            if(sessionStorage.getItem('authKey') == null){ 
                let routeData = this.$router.resolve({name: "Login"});     //未登录，跳转到登录页面
                window.open(routeData.href, '_self'); 
            }else{                                                                 
                let routeData = this.$router.resolve({name: "Usercenter"});    //已登录，跳转到后台管理平台 
                window.open(routeData.href, '_self'); 
            }
        },
        outLogin(){
            this.$confirm('确定退出吗?', '提示', 
                {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消'
                }).then(() => {
                    sessionStorage.removeItem('authKey');
                    sessionStorage.removeItem('sessionId');
                    sessionStorage.removeItem('m_id');
                    sessionStorage.removeItem('m_name');
                    this.common.toastMsg('退出成功','success');
                        let routeData = this.$router.resolve({
                        name: "/"
                    });
                    window.open(routeData.href, '_self');
                }).catch(() => {})
        }
    },
    mounted(){
        this.getUseMessage();
    }
  }
</script>

<style scoped>
    .ltHead{
        width: 100%;
        height: 135px;
        background-color: #409EFF;  
    }
    .ltHead_cen{
        width: 1090px;
        height: 135px;
        /* background-color: #e43e20; */
        background:url("../../../assets/images/head.png");
        margin: 0 auto;
    }
    .headPic1{
        float: left;
        margin-top: 20px;
    }
    .headNav{
        float: left;
        margin-left: 40px;
        margin-top: 70px;
    }
    .headNav li{
        float: left;
        font-size: 16px;
        line-height: 60px;
        margin-right: 20px;
    }
    .headNav li a{
        color: #fff;
    }
    .ltForm{
        width: 180px;
        height: 60px;
        float: right;
        cursor: pointer;
    }

    .headPic2{
        margin-top: 10px;
        float: left;
    }
    /* .ltForm ul{
        float: left;
        margin-left: 20px;
    }
    .ltForm ul li{
        float: left;
        margin-top: 75px;
        line-height: 60px;
        font-size: 14px;
        margin-right: 20px;
    } */
    .ltForm a{
        float: left;
        margin-top: 75px;
        line-height: 60px;
        font-size: 14px;
        margin-right: 20px;
        color: #fff;
    }

    .ltForm a:hover{
        color:#73E0FC;
    }
    .navFix{
        float: right;
        margin-top: 65px;
        display: none;
    }
    .navMe{
        display: block;
        height: 60px;
        line-height: 60px;
        float: right;
        font-size: 14px;
        color: #fff;
        text-indent: 25px;
        background: url("../../../assets/images/indexPerson.png") no-repeat 0 center;
    }
    .navWrite{
        display: block;
        box-sizing: border-box;
        width: 100px;
        height: 40px;
        border: 1px solid #fff;
        border-radius: 5px;
        float: right;
        margin-right: 20px;
        margin-top: 10px;
        font-size: 14px;
        color: #fff;
        background: rgba(14, 209, 56, 0.5);
        text-align: center;
        line-height: 36px;
    }
    .navWrite:hover{
        background: rgba(14, 209, 56, 1);
    }
    /* .lt_login{
        height: 60px;
        float: right;
        background: url("../img/loginMsg.png") no-repeat 0 center;
    }
    .lt_login ul{
        margin-left: 30px;
    }
    .lt_login li{
        float: left;
        line-height: 60px;
        font-size: 14px;
        margin-left: 20px;
        text-indent: 20px;
    }
    .lt_login li:first-of-type{
        background: url("../img/indexPerson.png") no-repeat 0 center;
    }
    .lt_login li:last-of-type{
        background: url("../img/indexTc.png") no-repeat 0 center;
    }
    .lt_login li a{
        color: #fff;
    } */
</style>