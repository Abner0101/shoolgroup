<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-calendar"></i> 活动管理</el-breadcrumb-item>
                <el-breadcrumb-item>活动申请</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="container" v-if="showask">
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm">

                <el-form-item label="活动主题" prop="a_theme">
                    <el-input v-model="ruleForm.a_theme"></el-input>
                </el-form-item>


                <el-form-item label="活动性质" prop="a_nature">
                    <el-select v-model="ruleForm.a_nature" placeholder="请选择活动性质">
                      <el-option label="比赛" value="比赛"></el-option>
                      <el-option label="招新" value="招新"></el-option>
                      <el-option label="服务" value="服务"></el-option>
                      <el-option label="课外" value="课外"></el-option>
                    </el-select>
                </el-form-item>

                <el-form-item label="封面图片">
                    <el-upload  class="avatar-uploader" :before-upload="beforeAddImgUpload"
                        accept="image/png,image/jpeg,image/gif,image/jpg,image/webp" 
                        action="http://www.clubs.org/index.php/addAction" 
                        >
                        <img v-if="addImg" :src="addImg" class="avatar">
                        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                        <div class="el-upload__tip" slot="tip">支持上传jpg/gif/png/jpeg/webp图片</div>
                    </el-upload>
                </el-form-item>

                <el-form-item label="活动内容" prop="a_content">
                <quill-editor ref="myTextEditor" v-model="ruleForm.a_content" :options="editorOption"></quill-editor>
                </el-form-item>
                
                <el-form-item label="活动日期">
                    <!-- <el-date-picker
                      v-model="ruleForm.a_hdday"
                      type="daterange"
                      value-format="yyyy-MM-dd"
                      start-placeholder="开始日期"
                      end-placeholder="结束日期"
                      :default-time="['00:00:00', '23:59:59']">
                    </el-date-picker> -->
                    <el-date-picker
                      v-model="ruleForm.a_hdday"
                      type="date"
                      value-format="yyyy-MM-dd"
                      placeholder="选择日期">
                    </el-date-picker>
                </el-form-item>

                <el-form-item label="活动地点">
                    <el-input v-model="ruleForm.a_hdplace"></el-input>
                </el-form-item>

                <el-form-item label="承办社团" prop="a_unit">
                    <el-input v-model="ruleForm.a_unit"></el-input>
                </el-form-item>

                <el-form-item label="活动负责人">
                    <el-input v-model="ruleForm.a_manager"></el-input>
                </el-form-item>

                <el-form-item label="备注">
                    <el-input type="" v-model="ruleForm.beizhu"></el-input>
                </el-form-item>


                <el-form-item>
                    <el-button type="primary" @click="submitForm('ruleForm')">立即申请</el-button>
                    <el-button @click="resetForm('ruleForm')">重置</el-button>
                </el-form-item>
            </el-form>
        </div>

        <div class="container" v-if="showres">
            <el-button type="primary" @click="reAsk()">继续申请</el-button>
            <el-button type="primary" @click="ToActionlist()">申请详情</el-button>
            <h1 class="asksus">您已成功申请！</h1>
            
        </div>
    </div>
</template>

<script>
    import 'quill/dist/quill.core.css';
    import 'quill/dist/quill.snow.css';
    import 'quill/dist/quill.bubble.css';
    import { quillEditor } from 'vue-quill-editor';
    import http from '../../assets/js/http.js'
    export default {
        name: 'Actionask',
        data() {
          return {
            ruleForm: {
              a_theme:'',
              a_hdday:'',
              a_hdplace:'',
              a_manager:'',
              a_hdchecker:'',
              a_unit:'',
              coverimg:null,
              a_nature:'',
              a_content:'',
              beizhu:'',
              clubid:''
            },
            rules: {
              a_theme: [
                { required: true, message: '请输入活动主题', trigger: 'blur' },
                { min: 4, max: 20, message: '长度在 4 到 20 个字符', trigger: 'blur' }
              ],
              a_nature: [
                { required: true, message: '请选择活动性质', trigger: 'change' }
              ],
              a_content: [
                { required: true, message: '请填写活动内容', trigger: 'blur' }
              ],
              a_unit: [
                { required: true, message: '请填写承办社团', trigger: 'blur' }
              ],
            },
            editorOption: {
                placeholder: 'Hello World'
            },
            addImg:'',//图片路径显示
            imgUrl:'http://www.clubs.org',
            showask:true,
            showres:false
            
          };
        },
        components: {
            quillEditor
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                  if (valid) {
                    // console.log(this.ruleForm);
                    let config = {headers: {'Content-Type': 'multipart/form-data'}};
                    // const instance=this.$axios.create({
                    //   withCredentials: true
                    // });
                    let params = new FormData();
                    params.append('coverimg',this.ruleForm.coverimg);
                    params.append('clubid',this.ruleForm.clubid);
                    params.append('a_theme',this.ruleForm.a_theme);
                    params.append('a_hdday',this.ruleForm.a_hdday);
                    params.append('a_hdplace',this.ruleForm.a_hdplace);
                    params.append('a_manager',this.ruleForm.a_manager);
                    params.append('a_unit',this.ruleForm.a_unit);
                    params.append('a_nature',this.ruleForm.a_nature);
                    params.append('a_content',this.ruleForm.a_content);
                    params.append('beizhu',this.ruleForm.beizhu);
                    this.$axios
                    .post('http://www.clubs.org/index.php/' + 'addAction',params,config)
                    .then((res)=>{
                        let ret=res.data;
                        if(ret.code==200){
                            this.common.toastMsg('申请成功','success');
                            this.showask=false;
                            this.showres=true;
                        }else if(ret.code==101){
                            this.handleError();
                        }else{
                            this.common.toastMsg(ret.error,'error');
                        }
                    });
                  } else {
                    console.log('error submit!!');
                    return false;
                  }
                });
            },

            ToActionlist(){
                setTimeout(()=>{
                    // window.location.reload();
                    this.$router.push('/actionlist');
                },1500);
            },
            reAsk(){
                this.showask=true;
                this.showres=false;
                this.getClubMes();
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            },
            //图片上传前触发函数
            beforeAddImgUpload(file){
              this.addImg = window.URL.createObjectURL(file);
              this.ruleForm.coverimg = file;
              // console.log(this.ruleForm.coverimg);
              return false;
            },
            getClubMes(){
                this.$axios
                .get('http://www.clubs.org/index.php/' + 'getClub',{params:{id:localStorage.getItem('departId')}})
                .then((res)=>{
                    let ret =res.data;
                    if(ret.code==200){
                        this.ruleForm.clubid=ret.data.id;
                        this.ruleForm.a_unit=ret.data.c_name;
                    }else{
                        this.handleError();
                    }
                })
            }
        },
        mounted(){
            this.getClubMes();
        },
        mixins:[http],
    }
</script>

<style scoped>
.avatar-uploader .el-upload {
    border: 1px dashed #d9d9d9;
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    width: 350px;
    height: 180px;
}
.avatar-uploader .el-upload:hover {
    border-color: #409EFF;
}
.avatar-uploader-icon {
    font-size: 40px;
    color: #8c939d;
    width: 360px;
    height: 180px;
    line-height: 180px;
    text-align: center;
}
.avatar {
    width: 360px;
    height: 180px;
    display: block;
}
.asksus{
    color: #05A30B;
    margin-top: 20px;
    margin-bottom: 20px;
}    

</style>