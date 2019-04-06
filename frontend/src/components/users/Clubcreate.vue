<template>
    <div>
        <v-header></v-header>
        <div class="writeCon" v-if="showRes">
            <div class="writeCon_cen">
                <div class="writeCen_res">
                    <p>已提交申请！！</p>
                    <p><a href="javascript:;" @click="toMyask">点击这里查看申请详情</a></p>
                </div>
            </div>
        </div>
        <div class="writeCon" v-if="showTable">
            <div class="writeCon_head">
                <p>创建社团申请</p>
            </div>
            <div class="writeCon_cen">
                <el-col :span="11" class="colstyle">
                    <el-input v-model="memberMes.m_name">
                        <template slot="prepend">申请人：</template>
                    </el-input>
                </el-col>
                <el-col :span="11" class="colstyle">
                    <el-input v-model="memberMes.m_sex">
                        <template slot="prepend">性    别：</template>
                    </el-input>
                </el-col>
                <el-col :span="11" class="colstyle">
                    <el-input v-model="memberMes.m_number">
                        <template slot="prepend">学 号：</template>
                    </el-input>
                </el-col>
                <el-col :span="11" class="colstyle">
                    <el-input v-model="memberMes.m_phone">
                        <template slot="prepend">手机号码：</template>
                    </el-input>
                </el-col>
                <el-col :span="11" class="colstyle" style="margin-bottom: 20px;">
                    <el-input v-model="memberMes.m_grade">
                        <template slot="prepend">年    级：</template>
                    </el-input>
                </el-col>
                <el-col :span="11" class="colstyle" style="margin-bottom: 20px;">
                    <el-input v-model="memberMes.m_class">
                        <template slot="prepend">班级：</template>
                    </el-input>
                </el-col>

                <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm">
                  
                    <el-form-item label="社团名称" prop="c_name">
                        <el-input v-model="ruleForm.c_name"></el-input>
                    </el-form-item>

                    <el-form-item label="社团性质" prop="c_nature">
                        <el-select v-model="ruleForm.c_nature" placeholder="请选择社团性质">
                            <el-option label="人文类" value="人文类"></el-option>
                            <el-option label="体育类" value="体育类"></el-option>
                            <el-option label="艺术类" value="艺术类"></el-option>
                            <el-option label="服务类" value="服务类"></el-option>
                            <el-option label="科技类" value="科技类"></el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item label="社团团徽">
                        <el-upload  class="avatar-uploader" :before-upload="beforeAddImgUpload"
                            accept="image/png,image/jpeg,image/gif,image/jpg,image/webp" 
                            action="http://www.clubs.org/index.php/addClub" >
                            <img v-if="addImg" :src="addImg" class="avatar">
                            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                            <div class="el-upload__tip" slot="tip">支持上传jpg/gif/png/jpeg/webp图片</div>
                        </el-upload>
                    </el-form-item>
                        

                    <el-form-item label="社团简介" prop="c_introduce">
                        <el-input type="textarea" v-model="ruleForm.c_introduce"></el-input>
                    </el-form-item>

                    <el-form-item label="主管单位" prop="c_manage">
                        <el-input v-model="ruleForm.c_manage"></el-input>
                    </el-form-item>

                    <el-form-item label="备注">
                        <el-input type="textarea" v-model="ruleForm.beizhu"></el-input>
                    </el-form-item>

                    <el-form-item>
                        <el-button type="primary" @click="submitForm('ruleForm')">申请</el-button>
                        <el-button @click="resetForm('ruleForm')">重置</el-button>
                    </el-form-item>
                </el-form>
            </div>
        </div>
        <v-footer></v-footer>
    </div>
</template>

<script>
  import vHeader from './common/Homeheader.vue'
  import vFooter from './common/Homefooter.vue'
  import http from '../../assets/js/http.js'
  // import Bus from '../../assets/js/bus.js'
  export default {
    name:'Clubcreate',
    data() {
        return{
            ruleForm: {
              c_name: '',
              c_createrId: sessionStorage.getItem('m_id'),
              c_manage: '',
              c_img: '',
              c_nature: '',
              c_introduce: '',
              beizhu: '',
            },
            rules: {
              c_name: [
                { required: true, message: '请输入社团名称', trigger: 'blur' },
              ],
              c_manage: [
                { required: true, message: '请输入主管单位', trigger: 'blur' }
              ],
              c_nature: [
                { required: true, message: '请选择社团类型', trigger: 'change' }
              ],
              c_introduce: [
                { required: true, message: '请填写社团简介', trigger: 'blur' }
              ]
            },
            addImg:'',
            imgUrl:'http://www.clubs.org',
            memberMes:'',
            showRes:false,
            showTable:true,
        }
    },
    methods: {
        submitForm(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    let config = {headers: {'Content-Type': 'multipart/form-data'}};
                    // const instance=this.$axios.create({
                    //   withCredentials: true
                    // });
                    let params = new FormData();
                    params.append('c_name',this.ruleForm.c_name);
                    params.append('c_createrId',this.ruleForm.c_createrId);
                    params.append('c_manage',this.ruleForm.c_manage);
                    params.append('c_img',this.ruleForm.c_img);
                    params.append('c_nature',this.ruleForm.c_nature);
                    params.append('c_introduce',this.ruleForm.c_introduce);
                    params.append('beizhu',this.ruleForm.beizhu);
                    this.apiPost( 'http://www.clubs.org/index.php/' + 'addClub',params,config).then((res) => {
                      if(res.code == 200){
                        this.common.toastMsg('已提交申请','success'); 
                        this.showRes=true; 
                        this.showTable=false;
         
                      }else if(res.code == 101){
                        this.handleError();
                      }else{
                        this.common.toastMsg(res.error,'warning');
                      }
                    }) 
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        toMyask(){
            // Bus.$emit('showAsking',true);
            this.$store.state.showAsking=true; //查看申请详情
            this.$router.push("/Usercenter");

        },
        resetForm(formName) {
           this.$refs[formName].resetFields();
        },
        //头像上传前触发函数
        beforeAddImgUpload(file){
          this.addImg = window.URL.createObjectURL(file);
          this.ruleForm.c_img = file;
          // console.log(this.memberMes);
          return false;
        },

        //获取会员信息
        getMember(){
          let params={
            id:this.ruleForm.c_createrId
          };
          console.log(params);
          this.apiGet('http://www.clubs.org/index.php/' +  'getMember',{params}).then((res) => {
            if(res.code == 200){
              this.memberMes=res.data;
            }else{
               this.common.toastMsg('信息出错','warn');
            }
          });
          
        },

        //头像上传成功触发函数
        // handleAvatarSuccess(res, file) {
        //   if(res.code == 200){
        //     // this.getMember();
        //     this.common.toastMsg('上传成功','success');
        //   }else{
        //     // console.log(res.code);
        //     this.handleError();
        //   }  
        // },
    },
    components: {
      vHeader,
      vFooter
    },
    mounted(){
      this.getMember(); 
    },
    mixins:[http],
  }
</script>

<style>
.writeCon{
    width: 1200px;
    min-height: 840px;
    margin: 0 auto;
    margin-top: 14px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px #999;
}
.writeCon_head{
    width: 100%;
    height: 50px;
    border-radius: 10px;
    background-color: #f8f8f8;
    border-bottom: 1px solid #d7d7d7;
} 
.writeCon_head p{
    font-size: 15px;
    color: #7F8182;
    line-height: 50px;
    text-indent: 25px;
}
.writeCon_cen{
    width: 700px;
    min-height: 720px;
    margin: 0 auto;
    margin-top: 20px;
    padding-bottom: 20px;
}
.writeCen_res{
    padding-top: 40%;
}
.writeCen_res p:nth-of-type(1){
    font-size: 25px;
    color: #008837;
    font-weight: bold;
    letter-spacing: 5px;
}
.writeCen_res p:nth-of-type(2){
    font-size: 16px; 
    margin-top: 10px;
}
.colstyle
{
    margin-left: 15px;
    margin-top: 20px;
}
.avatar-uploader .el-upload {
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
}
</style>