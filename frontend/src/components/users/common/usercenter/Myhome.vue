<template>
    <div>
        <div class="home_self"><img :src="editImgSrc" alt=""></div>
            <!--男性为male，女性为female-->
            <div class="home_name" v-if="memberMes.m_sex==='女'"><p class="female">{{memberMes.m_name}}</p></div>
            <div class="home_name" v-if="memberMes.m_sex==='男'"><p class="male">{{memberMes.m_name}}</p></div>
            <div class="home_msg">
                <ul>
                    <li>{{memberMes.m_birthday}}</li>
                    <li>{{memberMes.m_class}}</li>
                </ul>
            </div>
    </div>
</template>

<script>
    import http from '../../../../assets/js/http.js'
    export default {
        name:'Myhome',
        data() {
            return{
                imgUrl:'http://www.clubs.org',
                memberMes:{

                },
                editImgSrc:'',
            }
        },
        methods: {
            //获取会员信息
            getMember(){
                  let params={
                    id:sessionStorage.getItem('m_id')
                  };
                  // console.log(memberid);
                  this.apiGet('http://www.clubs.org/index.php/' +  'getMember',{params}).then((res) => {
                    if(res.code == 200){
                      this.memberMes=res.data;
                      console.log(this.memberMes);
                      this.editImgSrc = this.imgUrl + res.data.m_img;
                    }else{
                       this.common.toastMsg('信息出错','warn');
                    }
                  });     
            },
        },
        mounted(){
            this.getMember();
        },
        components: {

        },
        mixins:[http],
    }
</script>

<style scoped>
    .homeCen_left li:nth-child(1) a{
        background: url("../../../../assets/images/homeIcon1_hover.png") no-repeat 40px center;
    }
    .home_self{
        width: 168px;
        height: 168px;
        margin: 0 auto;
        background-color: #999;
        border-radius: 5px;
        overflow: hidden;
        margin-top: 177px;
    }
    .home_self img{
        width: 168px;
        height: 168px;
        border-radius: 5px;
    }
    .home_name{
        width: 100%;
        height: 30px;
        color: #333;
        margin-top: 10px;
        position: relative;
    }
    .home_name p{
        box-sizing: border-box;
        padding: 0 30px;
        line-height: 30px;
        font-size: 24px;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }
    .home_name p.male{
        background:url("../../../../assets/images/male.png") no-repeat right center ;
    }
    .home_name p.female{
        background:url("../../../../assets/images/female.png") no-repeat right center ;
    }
    .home_msg{
        width: 100%;
        height: 30px;
        margin-top: 10px;
        position: relative;
    }
    .home_msg ul{
        position: absolute;
        margin-left: 50%;
        transform: translateX(-50%);
    }
    .home_msg li{
        float: left;
        margin-right: 30px;
        font-size: 14px;
        color: #333;
        text-indent: 25px;
        line-height: 30px;
    }
    .home_msg li:first-of-type{
        background: url("../../../../assets/images/home_clock.png") no-repeat 0 center
    }
    .home_msg li:last-of-type{
        background: url("../../../../assets/images/home_address.png") no-repeat 0 center;
    }
</style>