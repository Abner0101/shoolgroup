<template>
    <div>
        <v-header></v-header>
        <div class="homeCen">
            <div class="homeCen_left">
                <ul>
                    <li v-bind:class="{ on: showMyhome}"><a @click="isMyhome">我的主页</a></li>
                    <li v-bind:class="{ on: showSet}"><a @click="isSet">基本设置</a></li>
                    <li v-bind:class="{ on: showPost}"><a @click="isPost">公告信息</a></li>
                    <li v-bind:class="{ on: showMessage}"><a @click="isMessage">我的消息</a></li>
                    <li v-bind:class="{ on: showAsk}"><a @click="isAsk">申请详情</a></li>
                </ul>
            </div>
            <div class="homeCen_right">
                <v-myhome v-if="showMyhome"></v-myhome>
                <v-myset v-if="showSet"></v-myset>
                <v-mypost v-if="showPost"></v-mypost>
                <v-mymessage v-if="showMessage"></v-mymessage>
                <v-myask v-if="showAsk"></v-myask>
            </div>
        </div>
        <!-- <v-footer></v-footer> -->
    </div>
</template>

<script>
    import vHeader from './common/Homeheader.vue'
    // import vFooter from './common/Homefooter.vue'
    import vMyhome from './common/usercenter/Myhome.vue'
    import vMyset from './common/usercenter/Myset.vue'
    import vMypost from './common/usercenter/Mypost.vue'
    import vMymessage from './common/usercenter/Mymessage.vue'
    import vMyask from './common/usercenter/Myask.vue'
    // import Bus from '../../assets/js/bus.js'
    export default {
        name:'Usercenter',
        data() {
            return{
                showMyhome:true,
                showSet:false,
                showPost:false,
                showMessage:false,
                showAsk:false
            }
        },
        created(){

        },
        mounted(){
            if(this.$store.state.showAsking){
                this.isAsk();
            }
        },
        methods: {
            isMyhome(){
                this.showMyhome=true;
                this.showSet=false;
                this.showPost=false;
                this.showMessage=false;
                this.showAsk=false;
            },
            isSet(){
                this.showMyhome=false;
                this.showSet=true;
                this.showPost=false;
                this.showMessage=false;
                this.showAsk=false;
            },
            isPost(){
                this.showMyhome=false;
                this.showSet=false;
                this.showPost=true;
                this.showMessage=false;
                this.showAsk=false;
            },
            isMessage(){
                this.showMyhome=false;
                this.showSet=false;
                this.showPost=false;
                this.showMessage=true;
                this.showAsk=false;
            },
            isAsk(){
                this.showMyhome=false;
                this.showSet=false;
                this.showPost=false;
                this.showMessage=false;
                this.showAsk=true; 
            },
        },
        components: {
            vHeader,
            // vFooter,
            vMyhome,
            vMyset,
            vMypost,
            vMymessage,
            vMyask
        }
    }
</script>

<style scoped>
.homeCen{
    box-sizing: border-box;
    width: 1200px;
    height: 620px;
    margin: 0 auto;
    margin-top: 14px;
    margin-bottom: 50px;
}
.homeCen_left{
    box-sizing: border-box;
    padding-top: 20px;
    width: 200px;
    height: 620px;
    background-color: #7D7F80;
    float: left;
    border-radius: 10px;
}
.homeCen_left li{
    width: 100%;
    height: 46px;
    cursor: pointer;
}
.homeCen_left li.on{
    background-color: #409EFF;
}
.homeCen_left li a{
    display: block;
    width: 100%;
    height: 46px;
    text-align: center;
    line-height: 46px;
    font-size: 14px;
    color: #fff;
    letter-spacing: 1px;
}
.homeCen_left li:nth-child(1) a{
    background: url("../../assets/images/homeIcon1.png") no-repeat 40px center;
}
.homeCen_left li:nth-child(2) a{
    background: url("../../assets/images/homeIcon2.png") no-repeat 40px center;
}
.homeCen_left li:nth-child(3) a{
    background: url("../../assets/images/homeIcon3.png") no-repeat 40px center;
}
.homeCen_left li:nth-child(4) a{
    background: url("../../assets/images/homeIcon4.png") no-repeat 40px center;
}
.homeCen_left li:nth-child(5) a{
    background: url("../../assets/images/homeIcon5.png") no-repeat 40px center;
}
.homeCen_right{
    width: 985px;
    min-height: 620px;
    border-radius: 10px;
    box-shadow: 0 0 10px #999;
    float: right;
    background-color: #fff;
}
</style>