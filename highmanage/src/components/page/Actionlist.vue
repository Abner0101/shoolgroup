<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-group"></i> 活动管理</el-breadcrumb-item>
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
                  label="审核进度"
                  width="180">
                  <template slot-scope="scope">
                    <el-tag size="medium" type="success" v-if="scope.row.ispass==1">审核通过</el-tag>
                    <el-tag size="medium" type="info" v-if="scope.row.ispass==2">审核中</el-tag>
                    <el-tag size="medium" type="danger" v-if="scope.row.ispass==0">审核不通过</el-tag>
                  </template>
                </el-table-column>

                <el-table-column
                  label="是否轮播"
                  width="180">
                  <template slot-scope="scope">
                    <el-button type="info" icon="el-icon-arrow-right" round v-if="scope.row.isshow==0 && scope.row.ispass==1" @click="ToShow(scope.row)">
                    否
                    </el-button>
                    <el-button type="success" icon="el-icon-check" round v-if="scope.row.isshow==1 && scope.row.ispass==1" @click="ToShow(scope.row)">
                    是
                    </el-button>
                  </template>
                </el-table-column>

                <el-table-column label="操作">
                  <template slot-scope="scope">
                    <el-button
                      size="mini"
                      @click="handleMore(scope.$index, scope.row)">活动详情</el-button>
                    <el-button
                      size="mini"
                      type="danger"
                      @click="handleDelete(scope.$index, scope.row)">删除活动</el-button>
                  </template>
                </el-table-column>
            </el-table>

            <el-dialog title="活动详情" :visible.sync="dialogFormVisible">
                <el-form :model="ruleForm" ref="ruleForm" label-width="100px" class="demo-ruleForm">

                    <el-form-item label="活动主题：" prop="a_theme">
                        {{ruleForm.a_theme}}
                    </el-form-item>

                    <el-form-item label="活动性质：" >
                        {{ruleForm.a_nature}}
                    </el-form-item>

                    <el-form-item label="封面图片：">
                        <el-upload  class="avatar-uploader" 
                            accept="image/png,image/jpeg,image/gif,image/jpg,image/webp" 
                            action="http://www.clubs.org/index.php/addAction" 
                            >
                            <img v-if="addImg" :src="addImg" class="avatar">
                            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                            <div class="el-upload__tip" slot="tip">支持上传jpg/gif/png/jpeg/webp图片</div>
                        </el-upload>
                    </el-form-item>

                    <el-form-item label="活动内容：" >
                        <div class="ql-container ql-snow">
                            <div class="ql-editor">
                               <div v-html="ruleForm.a_content"></div>
                            </div>
                        </div>
                    </el-form-item>
                    
                    <el-form-item label="活动日期：">
                        {{ruleForm.a_hdday}}
                    </el-form-item>

                    <el-form-item label="活动地点：">
                        {{ruleForm.a_hdplace}}
                    </el-form-item>

                    <el-form-item label="承办社团：" >
                        {{ruleForm.a_unit}}
                    </el-form-item>

                    <el-form-item label="活动负责人：">
                        {{ruleForm.a_manager}}
                    </el-form-item>
                        
                    <el-form-item label="备注：">
                        {{ruleForm.beizhu}}
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
                  clubid:'',
                  isshow:''
            },
            addImg:'',//图片路径显示
            imgUrl:'http://www.clubs.org',
          }
        },
        // components: {
        //   quillEditor
        // },
        methods: {
            getActionMes(){
                this.$axios.get('http://www.clubs.org/index.php/getAllAction')
                .then((res)=>{
                    let ret=res.data;
                    if(ret.code == 200){
                        let temp =[];
                        ret.data.forEach((val)=>{
                            val.create_time=this.common.toDate(val.create_time);
                            temp.push(val);
                        });
                        this.tableData=temp;
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                });
            },
            ToShow(row){
              console.log(row);
              if(row.isshow==0){
                var params={
                    id:row.id,
                    isshow:1
                };
              }else{
                var params={
                    id:row.id,
                    isshow:0
                };
              }
              
              
              this.$axios
              .post('http://www.clubs.org/index.php/' + 'M_editAction',params)
              .then((res)=>{
                  let ret=res.data;
                  console.log(ret);
                  if(ret.code==200){ 
                      //清空列表重新加载
                      if(row.isshow == 0){
                        this.getActionMes();
                        this.common.toastMsg("已轮播展示！",'success');
                      }else{
                        this.getActionMes();
                        this.common.toastMsg("已取消轮播！",'normal');
                      }
                      
                  }
                  else if(ret.code == 101){
                      this.handleError();
                  }
                  else{
                      this.common.toastMsg(ret.error,'warning');
                  }
              });
            },
            // NoShow(row){

            // },
            handleMore(index, row){
                this.dialogFormVisible=true;
                this.addImg=this.imgUrl+row.coverimg;
                this.ruleForm=row;
            },
            handleDelete(index, row) {
                this.$confirm('此操作将取消该活动, 是否继续?', '提示', {
                  confirmButtonText: '确定',
                  cancelButtonText: '取消',
                  type: 'warning'
                }).then(() => {
                    this.$axios
                    .get('http://www.clubs.org/index.php/' + 'M_delAction',{params:{id:row.id}})
                    .then((res)=>{
                        let ret =res.data;
                        if(ret.code == 200){
                            this.common.toastMsg("活动取消成功",'success'); 
                            this.getActionMes();
                        }else if(ret.code ==101){
                            this.handleError();
                        }
                        else{
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