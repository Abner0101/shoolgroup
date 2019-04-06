<template>
    <div class="Myask">
        <!-- 申请列表 -->
        <el-tabs type="border-card" style="border-radius: 15px;margin: 15px 25px;" v-if="showTable">
          <el-tab-pane label="创建社团">
              <el-table :data="tableData" style="width: 100%">

                <el-table-column label="申请日期" width="180">
                  <template slot-scope="scope">
                    <i class="el-icon-time"></i>
                    <span style="margin-left: 10px">{{ scope.row.c_createdate }}</span>
                  </template>
                </el-table-column>

                <el-table-column label="创建社团" width="180">
                  <template slot-scope="scope">
                    <el-popover trigger="hover" placement="top">
                      <p>社团性质: {{ scope.row.c_nature }}</p>
                      <p>社团简介: {{ scope.row.c_introduce }}</p>
                      <div slot="reference" class="name-wrapper">
                        <el-tag size="medium">{{ scope.row.c_name }}</el-tag>
                      </div>
                    </el-popover>
                  </template>
                </el-table-column>

                <el-table-column label="操作">
                  <template slot-scope="scope">
                    <el-button
                      size="mini"
                      @click="handleEdit(scope.$index, scope.row)">重新申请
                    </el-button>

                    <el-button
                      size="mini"
                      type="danger"
                      @click="handleDelete(scope.$index, scope.row)">取消申请
                    </el-button>

                    <el-popover
                    placement="bottom"
                    title="审核状态："
                    width="200"
                    trigger="click"
                    >{{contentMes}}
                        <el-button
                          size="mini"
                          type="warning"
                          @click="handleShow(scope.$index, scope.row)"
                          slot="reference">申请进度
                        </el-button>
                    </el-popover>
                  </template>
                </el-table-column>
              </el-table>
          </el-tab-pane>

          <el-tab-pane label="加入社团">加入社团</el-tab-pane>
        </el-tabs>
        <!-- 重新提交页面 -->
        <div v-if="showEdit">
            <div class="baseHead">
                <p>重新申请</p>
            </div>
            <div class="myWrite_con">
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
                        <el-button type="primary" @click="editForm('ruleForm')">重新申请</el-button>
                        <el-button @click="resetForm('ruleForm')">重置</el-button>
                    </el-form-item>
                </el-form>
            </div>
        </div>
    </div>
</template>

<script>
    import http from '../../../../assets/js/http.js'
    export default {
        name:'Myask',
        data() {
            return{
                tableData: null,
                // clubMes:'',
                showTable:true,
                showEdit:false,
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
                contentMes:'',
            }
        },
        methods: {
            handleEdit(index, row) {
                console.log(index, row);
                this.showTable=false;
                this.showEdit=true;
                this.addImg = this.imgUrl + row.c_img;
                this.getMember();
                this.ruleForm=row;
            },
            handleDelete(index, row) {
                // console.log(index, row);
                this.$confirm('此操作将取消申请, 是否继续?', '提示', {
                  confirmButtonText: '确定',
                  cancelButtonText: '取消',
                  type: 'warning'
                }).then(() => {
                    this.apiGet('http://www.clubs.org/index.php/' + 'delClub',{params:{id:row.id}})
                    .then((res) =>{
                      if(res.code == 200)
                      {
                        this.common.toastMsg("已取消申请",'success');
                        window.location.reload();
                        
                      }else if(res.code == 101){
                        this.handleError();
                      }else{
                        this.common.toastMsg(res.error,'warning');
                      }
                  })
                   
                }).catch(() => {
                  this.$message({
                    type: 'info',
                    message: '已取消删除'
                  });          
                });

            },
            handleShow(index,row) {
                // console.log(index, row);
                if(row.ispass==1){
                    this.contentMes="审核通过"
                }else if(row.ispass==0){
                    this.contentMes="审核不通过"
                }else{
                    this.contentMes="审核中"
                }
            },
            editForm(ruleForm){
                this.$confirm('是否要保存修改？', '确认信息', {
                  distinguishCancelAndClose: true,
                  confirmButtonText: '保存',
                  cancelButtonText: '放弃修改',
                   type: 'warning'
                })
                  .then(() => {
                    // let Memberform=this.memberMes;
                    // Memberform['id']=sessionStorage.getItem('m_id');
                    // console.log(Memberform);
                    this.$refs[ruleForm].validate((valid) => {
                        if (valid) {
                            this.apiPost('http://www.clubs.org/index.php/' + 'editClub',this.ruleForm)
                            .then((res) =>{
                              if(res.code == 200)
                              {
                                this.common.toastMsg(res.data,'success');
                                // this.$store.state.showAsking=true; //查看申请详情
                                // this.$router.push("/Usercenter");
                                window.location.reload();
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
                  })
                  .catch(() => {
                    this.$message({
                      type: 'info',
                      message: '已取消修改'
                    });          
                  });
            },

            resetForm(formName) {
               this.$refs[formName].resetFields();
            },
            //头像上传前触发函数
            beforeAddImgUpload(file){
              this.addImg = window.URL.createObjectURL(file);
              this.ruleForm.c_img = file;
              // console.log(this.memberMes);
              // return false;
            },
            getClubC(){ //获取创建社团的信息
                // let params={
                //     c_createrId:sessionStorage.getItem('m_id')
                // };
                  // console.log(memberid);
                this.apiGet('http://www.clubs.org/index.php/' +  'getAllClub').then((res) => {
                    if(res.code == 200){
                      // this.clubMes=res.data;
                      let temp =[];
                      res.data.forEach((val)=>{
                        if(val.c_createrId == sessionStorage.getItem('m_id')){
                            val.c_createdate=this.common.toDate(val.create_time);
                            temp.push(val);
                        }
                      });
                      this.tableData=temp;

                      // console.log(this.tableData);
                    }else{
                       this.common.toastMsg('信息出错','warn');
                    }
                });     
            },

            getMember(){
              let params={
                id:sessionStorage.getItem('m_id')
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
        },
        mounted(){
            this.getClubC();
            
        },
        mixins:[http],
    }
</script>

<style scoped>
.baseHead{
        width: 95%;
        height: 40px;
        background-color: #f2f2f2;
        border-radius: 10px;
        border: 1px solid #d7d7d7;
        margin: 15px 25px;

    }
.baseHead p{
        font-size: 14px;
        color: #838586;
        text-indent: 40px;
        line-height: 40px;
    }
.myWrite_con{
        width: 860px;
        min-height: 420px;
        border: 1px solid #e8e8e8;
        border-radius: 10px;
        margin-top: 30px;
        margin-left: 60px;
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