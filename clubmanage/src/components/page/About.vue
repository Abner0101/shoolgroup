<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-question"></i> 关于本协会</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="container container-H">
            <div class="home_self">
                <img :src="clubMes.c_img" />
            </div>
            <div class="home_name">
                <p>{{clubMes.c_name}}</p>
            </div>
            <div>
                 <el-form  class="club-Position"> 
                    <el-form-item label="社团性质：" :label-width="formLabelWidth">
                        {{clubMes.c_nature}}
                    </el-form-item>
                    <el-form-item label="主管单位：" :label-width="formLabelWidth">
                        {{clubMes.c_manage}}
                    </el-form-item>
                    <el-form-item label="社团简介：" :label-width="formLabelWidth">
                        {{clubMes.c_introduce}}
                    </el-form-item>
                    <el-form-item label="创始人：" :label-width="formLabelWidth">
                        {{clubMes.c_boss}}
                    </el-form-item>
                </el-form>
            </div>
                

        </div>
    </div>
</template>

<script>
    import http from '../../assets/js/http.js'
    export default {
        name: 'About',
        data() {
            return{
                clubMes:'',
                imgUrl:'http://www.clubs.org',
                formLabelWidth:'120px',
            }
        },
        methods:{
            getClubMes(){
                this.$axios
                .get('http://www.clubs.org/index.php/' + 'getClub',{params:{id:localStorage.getItem('departId')}})
                .then((res)=>{
                    let ret =res.data;
                    if(ret.code == 200){
                        ret.data.c_img=this.imgUrl+ret.data.c_img;
                        this.clubMes=ret.data;
                    }else{
                        this.common.toastMsg(ret.error,'error'); 
                    }
                });
            }
        },
        mounted(){
            this.getClubMes();
        },
        mixins:[http],
    }
</script>

<style scoped>
    .home_self{
        width: 168px;
        height: 168px;
        margin: 0 auto;
        background-color: #999;
        border-radius: 5px;
        overflow: hidden;
        margin-top: 15px;
    }
    .container-H{
        min-height: 600px;
    }
    .club-Position{
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }
    .home_self img{
        width: 168px;
        height: 168px;
        border-radius: 5px;
        cursor: pointer;
    }
    .home_name{
        width: 100%;
        height: 30px;
        color: #333;
        margin-top: 10px;
        margin-bottom: 30px;
        position: relative;
    }
    .home_name p{
        box-sizing: border-box;
        padding: 0 30px;
        line-height: 30px;
        font-size: 24px;
        position: absolute;
        left: 50%;
        cursor: pointer;
        transform: translateX(-50%);
    }
</style>