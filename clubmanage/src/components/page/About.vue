<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-question"></i> 关于本协会</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="container container-H">
            <div class="home_self">
                <div class="baseCon">
                    <img :src="clubMes.c_img"/>
                </div>
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
                formLabelWidth:'120px',

                imgUrl:'http://www.clubs.org',
                editImgSrc:'',
                Header:{
                    authkey:localStorage.getItem('c_authKey'),
                    sessionid:localStorage.getItem('c_sessionId')
                },
                Image:{
                    id:localStorage.getItem('departId'),
                    c_img:'',
                },
            }
        },
        methods:{
            //头像上传前触发函数
            beforeEditImgUpload(file){
              this.editImgSrc = window.URL.createObjectURL(file);
              this.Image.c_img = file;
              // console.log(this.memberMes);
              // return false;
            },
            //头像上传成功触发函数
            handleAvatarSuccess(res, file) {
              if(res.code == 200){
                this.getMember();
                this.common.toastMsg('上传成功','success');
              }else{
                // console.log(res.code);
                this.handleError();
              }  
            },
            getClubMes(){
                this.$axios
                .get('http://www.clubs.org/index.php/' + 'getClub',{params:{id:localStorage.getItem('departId')}})
                .then((res)=>{
                    let ret =res.data;
                    if(ret.code == 200){
                        ret.data.c_img=this.imgUrl+ret.data.c_img;
                        // this.editImgSrc=this.imgUrl+ret.data.c_img;
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
    /* .avatar-uploader .el-upload {
        border: 1px dashed #d9d9d9;
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        width: 250px;
        height: 250px;
    }
    .avatar-uploader .el-upload:hover {
        border-color: #409EFF;
    }
    .avatar-uploader-icon {
        font-size: 40px;
        color: #8c939d;
        width: 250px;
        height: 250px;
        line-height: 250px;
        text-align: center;
    }
    .avatar {
        width: 250px;
        height: 250px;
        display: block;
    } */
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