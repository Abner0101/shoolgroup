<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-notification"></i> 活动管理</el-breadcrumb-item>
                <el-breadcrumb-item>活动列表</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="container">
            <el-table :data="tableData" style="width: 100%">
                <el-table-column
                  label="活动日期"
                  width="180">
                  <template slot-scope="scope">
                    <i class="el-icon-time"></i>
                    <span style="margin-left: 10px">{{ scope.row.a_hdday }}</span>
                  </template>
                </el-table-column>

                <el-table-column
                  label="活动主题"
                  width="180">
                  <template slot-scope="scope">
                    <el-popover trigger="hover" placement="top">
                      <p>申请时间: {{ scope.row.create_time }}</p>
                      <div slot="reference" class="name-wrapper">
                        <el-tag size="medium">{{ scope.row.a_theme}}</el-tag>
                      </div>
                    </el-popover>
                  </template>
                </el-table-column>

                <el-table-column
                  label="活动性质"
                  width="180">
                  <template slot-scope="scope">
                      <el-tag size="medium" type="warning">{{ scope.row.a_nature}}</el-tag>
                  </template>
                </el-table-column>

                <el-table-column
                  label="活动地点"
                  width="180">
                  <template slot-scope="scope">
                    <i class="el-icon-lx-location"></i>
                    <span style="margin-left: 10px">{{ scope.row.a_hdplace }}</span>
                  </template>
                </el-table-column>

                <el-table-column
                  label="负责人"
                  width="180">
                  <template slot-scope="scope">
                    <i class="el-icon-lx-profile"></i>
                    <span style="margin-left: 10px">{{ scope.row.a_manager }}</span>
                  </template>
                </el-table-column>

                <el-table-column
                  label="审核进度"
                  width="180">
                  <template slot-scope="scope">
                    <el-tag size="medium" type="success" v-if="scope.row.ispass==1">审核通过</el-tag>
                    <el-tag size="medium" type="info" v-if="scope.row.ispass==2">审核中</el-tag>
                    <el-tag size="medium" type="danger" v-if="scope.row.ispass==0">审核不通过</el-tag>
                  </template>
                </el-table-column>

                <el-table-column label="操作">
                  <template slot-scope="scope">
                    <el-button
                      size="mini"
                      @click="handleEdit(scope.$index, scope.row)">重新申请</el-button>
                    <el-button
                      size="mini"
                      type="danger"
                      @click="handleDelete(scope.$index, scope.row)">删除活动</el-button>
                  </template>
                </el-table-column>
            </el-table>

            <el-dialog title="重新申请活动" :visible.sync="dialogFormVisible">
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
                    <quill-editor ref="myTextEditor" v-model="ruleForm.a_content" :options="editorOption">
                    </quill-editor>
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
                        <el-button @click="resetForm('ruleForm')">取消</el-button>
                    </el-form-item>
                </el-form>
            </el-dialog>
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
    data() {
      return {
        tableData: [],
        dialogFormVisible:false,
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
        editorOption: {
            placeholder: 'Hello World'
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
        addImg:'',//图片路径显示
        imgUrl:'http://www.clubs.org',
      }
    },
    components: {
      quillEditor
    },
    methods: {
        handleEdit(index, row) {
            this.ruleForm=row;
            this.addImg=this.imgUrl+row.coverimg;
            this.dialogFormVisible=true;
        },
        handleDelete(index, row) {
            this.$confirm('此操作将取消该活动, 是否继续?', '提示', {
              confirmButtonText: '确定',
              cancelButtonText: '取消',
              type: 'warning'
            }).then(() => {
                this.$axios
                .get('http://www.clubs.org/index.php/' + 'delAction',{params:{id:row.id}})
                .then((res)=>{
                    let ret =res.data;
                    if(ret.code == 200){
                        this.common.toastMsg("活动取消成功",'success'); 
                        this.getActionMes();
                    }else{
                        this.common.toastMsg(ret.error,'error'); 
                    }
                });
                
            }).catch(() => {
              this.$message({
                type: 'info',
                message: '已取消删除'
              });          
            });
        },
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
                    params.append('id',this.ruleForm.id);
                    params.append('ispass',2);
                    this.$axios
                    .post('http://www.clubs.org/index.php/' + 'editAction',params,config)
                    .then((res)=>{
                        let ret=res.data;
                        if(ret.code==200){
                            this.dialogFormVisible=false;
                            this.common.toastMsg('申请成功','success');
                            this.getActionMes();
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
        getActionMes(){
            this.$axios.get('http://www.clubs.org/index.php/getAllAction')
            .then((res)=>{
                let ret=res.data;
                if(ret.code == 200){
                    let temp =[];
                    ret.data.forEach((val)=>{
                        if(val.clubid==localStorage.getItem('departId')){
                            val.create_time=this.common.toDate(val.create_time);
                            temp.push(val);
                        }
                    });
                    this.tableData=temp;
                }else{
                    this.common.toastMsg('信息出错','warn');
                }
            });
        },
        resetForm(formName) {
            this.dialogFormVisible=false;
        },
        //图片上传前触发函数
        beforeAddImgUpload(file){
          this.addImg = window.URL.createObjectURL(file);
          this.ruleForm.coverimg = file;
          // console.log(this.ruleForm.coverimg);
          return false;
        },
    },

    mounted(){
        this.getActionMes();
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
</style>